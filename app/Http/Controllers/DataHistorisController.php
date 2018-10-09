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
    public function create($slug)
    {
        $data['project'] = \App\Project::where('project_slug', $slug)->firstOrFail();
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'create-history'], $data);
    }

    public function createFromVolunteer($slug)
    {
        $data['project'] = \App\Project::where('project_slug', $slug)->firstOrFail();
        return view('member.dashboard', ['menu' => 'negeri', 'section' => 'create-history'], $data);
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
            $data['user_id'] = decrypt($request->data['user_id']);
            $data['project_id'] = decrypt($request->data['project_id']);
            
            $store = History::create($data);
            if($store) {
                $return = ["success" => "Data historis proyek berhasil dibuat"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
            }
        }
        
        return response()->json($return);
    }

    public function manage(Request $request, $slug)
    {
        $data['project'] = \App\Project::where('project_slug', $slug)->firstOrFail();
        $data['historis'] = History::where('project_id', $data['project']->id)->orderBy('created_at', 'desc')->get();

        return view('member.dashboard', ['menu' => 'negeri', 'section' => 'manage-history'], $data);
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
    public function edit($slug, $id)
    {
        $data['history'] = History::findOrFail(decrypt($id));
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'edit-history'], $data);
    }

    public function editFromVolunteer($slug, $id)
    {
        $data['history'] = History::findOrFail(decrypt($id));
        return view('member.dashboard', ['menu' => 'negeri', 'section' => 'edit-history'], $data);
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
            
            $store = History::where('id', decrypt($id))->update($data);
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
        $delete = History::find(decrypt($id))->delete();
        if($delete) {
            $return = ["success" => "History berhasil dihapus"];
        } else {
            $return = ["errors" => "Terjadi Kesalahan. Gagal menghapus history."];
        }
        return response()->json($return);
    }
}
