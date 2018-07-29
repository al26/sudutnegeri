<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Volunteer;
use App\Additional_question as Question;
use App\Additional_answer as Answer;
use Validator;

class VolunteerController extends Controller
{
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
        $data['project'] = Project::where('project_slug', $slug)->first();
        $data['questions'] = Question::where('project_id', $data['project']->id)->get();        
        return view('member.create_volunteer', $data);
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
            "motivation" => "required",
            "eligibility" => "required",
        ];

        $messages = [
            "motivation.required" => "Kolom diatas tidak boleh kosong",
            "eligibility.required" => "Kolom diatas tidak boleh kosong",
        ];

        $data = $request->data;

        foreach ($request->questions as $key => $question) {
            $rules["$key"] = "required";
            $messages["$key.required"] = "Kolom diatas tidak boleh kosong";  
            $data["$key"] = $question;
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $return = redirect()->back()->withErrors($validator)->withInput($data);
        } else {
            $ansCreate = [];
            foreach ($request->questions as $key => $answer) {
                $ans["question_id"] = substr($key, 8);
                $ans["answer"] = $answer;
                array_push($ansCreate, $ans);
            }

            $pid = Project::where('project_slug', $request->data['project_slug'])->pluck('id')[0];
            $create = [
                "user_id" => $request->data['user_id'],
                "project_id" => $pid,
                "motivation" => $request->data['motivation'],
                "eligibility" => $request->data['eligibility'],
                "status" => "ditinjau",
            ];

            // dd($ansCreate);

            $store = Volunteer::create($create);
            $store->answers->insert($ansCreate);

            if($store) {
                $return = redirect()->back()->with('success', 'sukses daftar');
            } else {
                $return = redirect()->back()->with('error', 'Terjadi kesalahan. Silahkan coba lagi')->withInput($data);
            }
        }

        return $return;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
