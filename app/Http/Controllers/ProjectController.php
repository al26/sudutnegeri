<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Project;

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
    public function index()
    {
        $data['projects'] = Project::paginate(6); 
        return view('explore', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.partials.modal.create_project');
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
            "project_name"      => 'required|min:10',
            "description"       => 'required',
            "location"          => 'required',
            "deadline"          => 'required|after_or_equal:today',
            "funding_target"    => 'required|numeric',
            "volunteer_spot"    => 'required|numeric'
        ];
        $messages = [
            "project_name.required"     => ":attribute tidak boleh kosong",
            "project_name.min"          => "Mohon isi judul proyek setidaknya :min karakter",
            "description.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
            "location.required"         => "Mohon diisi. Calon relawan perlu informasi :attribute proyek Anda",
            "deadline.required"         => "Mohon untuk mengisi :attribute proyek Anda",
            "deadline.after_or_equal"   => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "funding_target.required"   => "Mohon isikan :attribute",
            "funding_target.numeric"    => "Harap isikan dengan angka",
            "volunteer_spot.required"   => "Mohon isikan :attribute",
            "volunteer_spot.numeric"    => "Harap isikan dengan angka",
        ];
        $attributes = [
            "project_name"      => 'Judul Proyek',
            "description"       => 'deskripsi proyek',
            "location"          => 'lokasi',
            "deadline"          => 'tenggat waktu',
            "funding_target"    => 'nominal target dana',
            "volunteer_spot"    => 'jumlah target relawan'
        ];
        $data = $request->data;
        
        // die(var_dump($data["deadline"]));

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $data["project_slug"] = md5($request->data['project_name']);
            date_default_timezone_set('Asia/Jakarta');
            $data["deadline"] = date_create_from_format('Y-m-d', $request->data['deadline'])->format('Y-m-d H:i:s');
            
            $store = Project::create($data);
            if($store) {
                $return = ["success" => "Proyek baru berhasil dibuat"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
            }
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
        $data['slug'] = $slug;
        $data['menu'] = $menu;
        $data['project'] = Project::where('project_slug', $slug)->first();
        
        // dd($data['project']->historis);
        return view('details', $data);
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
            "project_name"      => 'required|min:10',
            "description"       => 'required',
            "location"          => 'required',
            "deadline"          => 'required|after_or_equal:today',
            "funding_target"    => 'required|numeric',
            "volunteer_spot"    => 'required|numeric'
        ];
        $messages = [
            "project_name.required"     => ":attribute tidak boleh kosong",
            "project_name.min"          => "Mohon isi judul proyek setidaknya :min karakter",
            "description.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
            "location.required"         => "Mohon diisi. Calon relawan perlu informasi :attribute proyek Anda",
            "deadline.required"         => "Mohon untuk mengisi :attribute proyek Anda",
            "deadline.after_or_equal"   => "Mohon isikan :attribute setidaknya tanggal hari ini",
            "funding_target.required"   => "Mohon isikan :attribute",
            "funding_target.numeric"    => "Harap isikan dengan angka",
            "volunteer_spot.required"   => "Mohon isikan :attribute",
            "volunteer_spot.numeric"    => "Harap isikan dengan angka",
        ];
        $attributes = [
            "project_name"      => 'Judul Proyek',
            "description"       => 'deskripsi proyek',
            "location"          => 'lokasi',
            "deadline"          => 'tenggat waktu',
            "funding_target"    => 'nominal target dana',
            "volunteer_spot"    => 'jumlah target relawan'
        ];
        $data = $request->data;
        
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
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
