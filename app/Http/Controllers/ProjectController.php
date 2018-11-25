<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Project;
use App\Regency;
use App\Donation;
use App\Category;
use App\Data_historis As History;
use Storage;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = Project::where(function($clause) {
            $clause->where('project_status','published')
                   ->orWhere('project_status', 'finished');
        });

        if (!empty($request->location) && $request->location !== 'all') {
            $project = $project->where('regency_id', $request->location);
            $data['lokasi'] = $request->location;
        }

        if (!empty($request->category) && $request->category !== 'all') {
            $category = Category::where('slug', $request->category)->pluck('id')->toArray();
            $project = $project->whereIn('category_id', $category);
            $data['category'] = $request->category;
        }

        if ($request->sort) {
            if ($request->sort === 'latest') {
                $project = $project->latest();
            } else {
                $project = $project->oldest();
            }  

            $data['sort'] = $request->sort;
        }

        $data['projects'] = $project->paginate(6);
        
        // dd($data);

        $data['categories'] = Category::all();

        return view('explore', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['user_profile']  = $request->user()->profile;
        $data['regencies'] = Regency::all();
        $data['categories'] = Category::all();
        // dd($data);
        // return view('member.partials.modal.create_project', $data);
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'project_create'], $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "project_name"          => 'required|between:10,50',
            "project_description"   => 'required',
            "project_location"      => 'required',
            "funding_target"        => 'required|numeric',
            "volunteer_quota"       => 'required|numeric',
            "category_id"           => 'required',
            "close_donation"        => 'required|after_or_equal:today',
            "close_reg"             => 'required|after_or_equal:today',
            "project_banner"        => 'required|image|mimes:jpg,jpeg,png,svg',
            "attachments"           => 'image|mimes:jpg,jpeg,png,svg'
        ];
        $messages = [
            "project_name.required"             => ":attribute tidak boleh kosong",
            "project_name.between"              => "Mohon isi judul proyek setidaknya 10 karakter dan maksimal 50 karakter",
            "project_description.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
            "project_location.required"         => "Mohon diisi. Calon relawan perlu informasi :attribute proyek Anda",
            "close_donation.required"           => "Mohon untuk mengisi :attribute untuk proyek Anda",
            "close_donation.after_or_equal"     => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "close_reg.required"                => "Mohon untuk mengisi :attribute untuk proyek Anda",
            "close_reg.after_or_equal"          => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "funding_target.required"           => "Mohon isikan :attribute",
            "funding_target.numeric"            => "Harap isikan dengan angka",
            "volunteer_quota.required"          => "Mohon isikan :attribute",
            "volunteer_quota.numeric"           => "Harap isikan dengan angka",
            "category_id.required"              => "Mohon pilih :attribute yang sesuai atau paling mendekati",
            "project_banner.required"           => "Mohon sertakan sebuah foto sebagai :attribute proyek anda",
            "project_banner.image"              => "Mohon sertakan sebuah foto sebagai :attribute proyek anda",
            "project_banner.mimes"              => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg",
            "attachments.image"                 => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg",
            "attachments.mimes"                 => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg"
        ];
        $attributes = [
            "project_name"          => 'Judul Proyek',
            "project_description"   => 'deskripsi proyek',
            "project_location"      => 'lokasi',
            "close_donation"        => 'batas waktu donasi',
            "close_reg"             => 'batas waktu registrasi',
            "funding_target"        => 'nominal target dana',
            "volunteer_quota"       => 'jumlah target relawan',
            "category_id"           => 'kategori',
            "project_banner"        => 'spanduk',
            "attachments"           => 'dokumen verifikasi'
        ];
                
        // dd($request->data['attachments']);

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        }

        $data = $request->data;
        $data["project_slug"] = md5($request->data['project_name']);
        $data["close_donation"] = date_create_from_format('Y-m-d', $request->data['close_donation'])->format('Y-m-d H:i:s');
        $data["close_reg"] = date_create_from_format('Y-m-d', $request->data['close_reg'])->format('Y-m-d H:i:s');
        
        $path = "";
        $filename = "";

        if($request->hasFile('data.project_banner')) {
            $filename = md5($request->data['project_banner']->getClientOriginalName().time()).'.'.$request->data['project_banner']->getClientOriginalExtension();
            $file = $request->file('data.project_banner');
            $path = $file->storeAs('project_banner', $filename);
        }

        if($path) {
            $data['project_banner'] = "storage/project_banner/".$filename;
        }
        
        $attachment_name = [];
        $attachment_path = [];
        $attachment_link = [];
        if($request->hasFile('data.attachments')){
            $attachments = $request->data['attachments'];
            $attachment_folder = $data['project_slug'].time();
            if(count($attachments) >= 1) {
                foreach ($attachments as $key => $a) {
                    $attachment_name[$key] = md5($a->getClientOriginalName().time()).'.'.$a->getClientOriginalExtension();
                    $attachment_path[$key] = $a->storeAs("project_verification/$attachment_folder", $attachment_name[$key]);
                    $attachment_link[$key] = "storage/project_verification/$attachment_folder/$attachment_name[$key]";
                }
            }
        }

        if(!empty($attachment_path)){
            $data['attachments'] = json_encode($attachment_link, JSON_FORCE_OBJECT);
        }

        // dd($data);

        $project = Project::create($data);
        if(!empty($request->questions)){
            $questions = json_decode($request->questions);
            $qt = array();
            foreach ($questions as $key => $q) {
                $qt[$key]['question'] = $q;
            }
            $project->questions()->createMany($qt);
        }


        if($project) {
            $return = ["success" => "Proyek baru berhasil dibuat"];
        } else {
            $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
        }
        
        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $menu = null)
    {
        $project = Project::where('project_slug', $slug)->first();
        $data['slug'] = $slug;
        $data['menu'] = $menu;
        $data['project'] = $project;
        $data['donators'] = Donation::where('project_id', $project->id)->get();

        return view('details', $data);
    }

    public function manage(Request $request, $slug) {
        $data['project'] = Project::where("project_slug", $slug)->first();
        $data['historis'] = History::where('project_id', $data['project']->id)->get(); 
        // dd($data['project']->);
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'manage-project'], $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['project'] = Project::where('id', decrypt($id))->firstOrFail();
        $data['categories'] = Category::all();
        // dd($data['deadline']);
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'project_edit'], $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            "project_name"          => 'required|min:10',
            "project_description"   => 'required',
            "project_location"      => 'required',
            "funding_target"        => 'required|numeric',
            "volunteer_quota"       => 'required|numeric',
            "category_id"           => 'required',
            "close_donation"        => 'required|after_or_equal:today',
            "close_reg"             => 'required|after_or_equal:today',
            "project_banner"        => 'required|image|mimes:jpg,jpeg,png,svg',
        ];
        $messages = [
            "project_name.required"             => ":attribute tidak boleh kosong",
            "project_name.min"                  => "Mohon isi judul proyek setidaknya :min karakter",
            "project_description.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
            "project_location.required"         => "Mohon diisi. Calon relawan perlu informasi :attribute proyek Anda",
            "close_donation.required"           => "Mohon untuk mengisi :attribute untuk proyek Anda",
            "close_donation.after_or_equal"     => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "close_reg.required"                => "Mohon untuk mengisi :attribute untuk proyek Anda",
            "close_reg.after_or_equal"          => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "funding_target.required"           => "Mohon isikan :attribute",
            "funding_target.numeric"            => "Harap isikan dengan angka",
            "volunteer_quota.required"          => "Mohon isikan :attribute",
            "volunteer_quota.numeric"           => "Harap isikan dengan angka",
            "category_id.required"              => "Mohon pilih :attribute yang sesuai atau paling mendekati",
            "project_banner.required"           => "Mohon sertakan sebuah foto sebagai :attribute proyek anda",
            "project_banner.image"              => "Mohon sertakan sebuah foto sebagai :attribute proyek anda",
            "project_banner.mimes"              => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg",
        ];
        $attributes = [
            "project_name"          => 'Judul Proyek',
            "project_description"   => 'deskripsi proyek',
            "project_location"      => 'lokasi',
            "close_donation"        => 'batas waktu donasi',
            "close_reg"             => 'batas waktu registrasi',
            "funding_target"        => 'nominal target dana',
            "volunteer_quota"       => 'jumlah target relawan',
            "category_id"           => 'kategori',
            "project_banner"        => 'spanduk',
        ];
                
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        }

        $data = $request->data;
        $data["project_slug"] = md5($request->data['project_name']);
        $data["close_donation"] = date_create_from_format('Y-m-d', $request->data['close_donation'])->format('Y-m-d H:i:s');
        $data["close_reg"] = date_create_from_format('Y-m-d', $request->data['close_reg'])->format('Y-m-d H:i:s');
        
        $path = "";
        $filename = "";

        if($request->hasFile('data.project_banner')) {
            $filename = md5($request->data['project_banner']->getClientOriginalName().time()).'.'.$request->data['project_banner']->getClientOriginalExtension();
            $file = $request->file('data.project_banner');
            $path = $file->storeAs('project_banner', $filename);
        }

        if($path) {
            $data['project_banner'] = "storage/project_banner/".$filename;
        }
        
        $project = Project::where('id', decrypt($id))->update($data);
        $oldBanner = !empty($project->project_banner) ? substr($project->project_banner, 7) : "";

        if($project) {
            if ($oldBanner !== "") {
                Storage::delete($oldBanner);
            }
            $return = ["success" => "Proyek berhasil diubah"];
        } else {
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
        }
        
        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Project::find(decrypt($id))->delete();
        if($delete) {
            $return = ["success" => "Proyek berhasil dihapus"];
        } else {
            $return = ["errors" => "Terjadi Kesalahan. Gagal menghapus proyek."];
        }
        return response()->json($return);
    }

    public function filter() {
        return view('guest.modal.project_filter', $data);
    }

    public function finish($id) {
        $project = Project::find(decrypt($id));
        $finished = $project->update(['project_status' => 'finished']);
        $finished .= $project->volunteers()->where('project_id', decrypt($id))->update(['status' => 'finished']);

        if($finished) {
            $return = ['success' => 'Berhasil mengakhiri Proyek'];
        } else {
            $return = ['error' => 'Terjadi kesalahan. Gagal mengakhiri proyek'];
        }

        return response()->json($return);
    }

    public function edit_doc($id) {
        $data['id'] = $id;
        return view('member.partials.modal.edit_project_doc', $data);
    }

    public function update_doc($id, Request $request) {
        $rules = ['attachments' => 'required|mimes:jpg,png,jpeg,svg,doc,docx,pdf'];
        $messages = [
            'attachments.required' => 'Dokumen verifikasi tidak boleh kosong',
            'attachments.mimes' => 'Format dokumen yang diijinkan hanya .jpg, .png, .svg, .doc, .docx, dan .pdf'
        ];
        $attributes = ['attachments' => 'dokumen verifikasi'];
        
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()]);
        }

        $project = Project::find(decrypt($id));
        $oldPath = "";
        
        if (!empty($project->attachments)) {
            $docs = json_decode($project->attachments);
            foreach ($docs as $key => $doc) {
                $segment = explode('/', $doc);
            }
            $oldPath = $segment[1]."/".$segment[2];
        }
        
        $attachment_name = [];
        $attachment_path = [];
        $attachment_link = [];
        if($request->hasFile('data.attachments')){
            $attachments = $request->data['attachments'];
            $attachment_folder = str_shuffle($project->project_slug.time());
            if(count($attachments) > 0) {
                foreach ($attachments as $key => $a) {
                    $attachment_name[$key] = md5($a->getClientOriginalName().time()).'.'.$a->getClientOriginalExtension();
                    $attachment_path[$key] = $a->storeAs("project_verification/$attachment_folder", $attachment_name[$key]);
                    $attachment_link[$key] = "storage/project_verification/$attachment_folder/$attachment_name[$key]";
                }
            }

            if(!empty($attachment_path)){
                $data['attachments'] = json_encode($attachment_link, JSON_FORCE_OBJECT);
            }
    
            $update = $project->update($data);
    
            if($update) {
                if ($oldPath !== "") {
                    Storage::deleteDirectory($oldPath);
                }
                $return = ['success' => 'Berhasil memperbarui dokumen verifikasi proyek'];
            } else {
                $return = ['errors' => 'Terjadi kesalahan. Gagal memperbarui dokumen verifikasi proyek'];
            }
        } else {
            $return = ['error' => 'Tidak ada file dipilih. Mohon pilih file terlebih dahulu'];
        }


        return response()->json($return);
    }
}
