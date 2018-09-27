<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Data_historis As History;

class DataHistorisController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($projectId = null)
    {
        $data['project_id'] = $projectId;
        return view('member.partials.modal.create_history', $data);
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
            "title"      => 'required',
            "body"       => 'required|min:10',
        ];
        $messages = [
            "title.required"     => ":attribute tidak boleh kosong",
            "body.min"           => "Mohon tulis :attribute setidaknya :min karakter",
            "body.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
        ];
        $attributes = [
            "title"      => 'Judul Update',
            "body"       => 'detail update',
        ];
        $data = $request->data;
        
        // die(var_dump($data["deadline"]));

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            // date_default_timezone_set('Asia/Jakarta');
            
            $store = History::create($data);
            if($store) {
                $return = ["success" => "Cerita proyek berhasil dibuat"];
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = History::find($id);
        return view('member.partials.modal.edit_history', $data);
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
            "title"      => 'required',
            "body"       => 'required|min:10',
        ];
        $messages = [
            "title.required"     => ":attribute tidak boleh kosong",
            "body.min"           => "Mohon tulis :attribute setidaknya :min karakter",
            "body.required"      => "Mohon isi :attribute untuk menjelaskan detai proyek Anda",
        ];
        $attributes = [
            "title"      => 'Judul Update',
            "body"       => 'detail update',
        ];
        $data = $request->data;
        
        // die(var_dump($data["deadline"]));

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            // date_default_timezone_set('Asia/Jakarta');
            
            $store = History::where('id', $id)->update($data);
            if($store) {
                $return = ["success" => "History berhasil diubah"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal mengubah history."];
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
        $delete = History::find($id)->delete();
        if($delete) {
            $return = ["success" => "History berhasil dihapus"];
        } else {
            $return = ["errors" => "Terjadi Kesalahan. Gagal menghapus history."];
        }
        return response()->json($return);
    }
}
