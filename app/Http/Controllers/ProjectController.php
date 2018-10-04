<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Project;
use App\Regency;
use App\Donation;
use App\Category;
use App\Data_historis As History;

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
        if ($request->category && strtolower($request->category) !== 'all') {
            $category = Category::where('slug', $request->category)->pluck('id')->toArray();
            $data['projects'] = Project::whereIn('category_id', $category)->paginate(6);
        } else {
            $data['projects'] = Project::paginate(6); 
        }
        
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
            "project_name"          => 'required|min:10',
            "project_description"   => 'required',
            "project_location"      => 'required',
            "funding_target"        => 'required|numeric',
            "volunteer_quota"       => 'required|numeric',
            "category_id"           => 'required',
            "close_donation"        => 'required|after_or_equal:today',
            "close_reg"             => 'required|after_or_equal:today',
            "project_banner"        => 'required|image|mimes:jpg,jpeg,png,svg'
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
            "project_banner.mimes"              => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg"
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
            "project_banner"        => 'spanduk'
        ];
                
        // dd($request->data);

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        }



      
        // dd($request->data);

        // $data = $request->data;
        // $data["project_slug"] = md5($request->data['project_name']);
        // date_default_timezone_set('Asia/Jakarta');
        // $data["close_donation"] = date_create_from_format('Y-m-d', $request->data['close_donation'])->format('Y-m-d H:i:s');
        // $data["close_reg"] = date_create_from_format('Y-m-d', $request->data['close_reg'])->format('Y-m-d H:i:s');
        
        // $path = "";
        // $filename = "";

        // if($request->hasFile('data.project_banner')) {
        //     $filename = md5($request->data['project_banner']->getClientOriginalName().time()).'.'.$request->data['project_banner']->getClientOriginalExtension();
        //     $file = $request->file('data.project_banner');
        //     $path = $file->storeAs('public/project_banner', $filename);
        // }

        // if($path) {
        //     $data['project_banner'] = "storage/project_banner/".$filename;
        // }

        if($request->hasFile('data.attachments')){
            $actual_upload = explode(",", $request->data['han']);
            $actual_upload = array_filter($actual_upload);

            return $actual_upload;
        }

        // $project = Project::create($data);
        // if(!empty($request->questions)){
        //     $questions = explode(",",$request->questions);
        //     $qt = array();
        //     foreach ($questions as $key => $q) {
        //         $qt[$key]['question'] = $q;
        //     }
        //     $project->questions()->createMany($qt);
        // }


        // if($project) {
        //     $return = ["success" => "Proyek baru berhasil dibuat"];
        // } else {
        //     $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
        // }
        
        // return response()->json($return);
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
        $data['user_profile']  = $request->user()->profile;
        $data['data'] = Project::where("project_slug",$slug)->first();
        $project_id = $data['data']['id'];
        $data['historis'] = History::where('project_id', $project_id)->get(); 
        // dd($data);
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
        $data = Project::where('id', $id)->first();
        // die(var_dump($data));
        // dd($data['deadline']);
        return view('member.partials.modal.edit_project', $data);
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
            "project_deadline"      => 'required|after_or_equal:today',
            "funding_target"        => 'required|numeric',
            "volunteer_quota"       => 'required|numeric'
        ];
        $messages = [
            "project_name.required"             => ":attribute tidak boleh kosong",
            "project_name.min"                  => "Mohon isi judul proyek setidaknya :min karakter",
            "project_description.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
            "project_location.required"         => "Mohon diisi. Calon relawan perlu informasi :attribute proyek Anda",
            "project_deadline.required"         => "Mohon untuk mengisi :attribute proyek Anda",
            "project_deadline.after_or_equal"   => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "funding_target.required"           => "Mohon isikan :attribute",
            "funding_target.numeric"            => "Harap isikan dengan angka",
            "volunteer_quota.required"          => "Mohon isikan :attribute",
            "volunteer_quota.numeric"           => "Harap isikan dengan angka",
        ];
        $attributes = [
            "project_name"          => 'Judul Proyek',
            "project_description"   => 'deskripsi proyek',
            "project_location"      => 'lokasi',
            "project_deadline"      => 'tenggat waktu',
            "funding_target"        => 'nominal target dana',
            "volunteer_quota"       => 'jumlah target relawan'
        ];
        $data = $request->data;

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            date_default_timezone_set('Asia/Jakarta');
            $data["project_deadline"] = date_create_from_format('Y-m-d', $request->data['project_deadline'])->format('Y-m-d H:i:s');
            
            $store = Project::where('id', $id)->update($data);
            if($store) {
                $return = ["success" => "Data proyek berhasil diubah"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
            }
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
        $delete = Project::find($id)->delete();
        if($delete) {
            $return = ["success" => "Proyek berhasil dihapus"];
        } else {
            $return = ["errors" => "Terjadi Kesalahan. Gagal menghapus proyek."];
        }
        return response()->json($return);
    }

    
}
