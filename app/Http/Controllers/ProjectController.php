<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('explore');
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
        
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $data["project_slug"] = md5($request->data['project_name']);
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
    public function show($slug)
    {
        return view('details');
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
