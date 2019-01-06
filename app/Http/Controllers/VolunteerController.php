<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Volunteer;
use App\Additional_question as Question;
use App\Additional_answer as Answer;
use App\Notifications\PostRegNotification;
use App\Notifications\AcceptVolunteer;
use App\Notifications\RejectVolunteer;
use Validator;

class VolunteerController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->except(['index']);
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
    public function create($slug, Request $request)
    {
        $data['project'] = Project::where('project_slug', $slug)->first();
        if($request->user()->id === $data['project']->user_id) {
            return redirect()->back();
        }
        $data['current_activity'] = Volunteer::where(function($clause) {
            $clause->where('status','pending')->orWhere('status', 'accepted');
        })->where('user_id', $request->user()->id )->first();
        $data['existing_volunteers'] = Volunteer::where('project_id', $data['project']->id)->pluck('user_id')->toArray();
        $data['questions'] = Question::where('project_id', $data['project']->id)->get();        
        return view('member.create_volunteer', $data);
    }

    public function postmsg(Request $request, $slug) 
    {
        $data['project'] = Project::where('project_slug', $slug)->first();
        return view('member.post_reg_msg', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = $request->data['project_slug'];

        $rules = [
            "motivation" => "required",
            "eligibility" => "required",
        ];

        $messages = [
            "motivation.required" => "Kolom diatas tidak boleh kosong",
            "eligibility.required" => "Kolom diatas tidak boleh kosong",
        ];

        $data = $request->data;
        
        if ($request->questions) {
            foreach ($request->questions as $key => $question) {
                $rules["$key"] = "required";
                $messages["$key.required"] = "Kolom diatas tidak boleh kosong";  
                $data["$key"] = $question;
            }
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            $return = redirect()->back()->withErrors($validator)->withInput($data);
        } else {
            $pid = Project::where('project_slug', $request->data['project_slug'])->pluck('id')[0];
            $create = [
                "user_id" => $request->data['user_id'],
                "project_id" => $pid,
                "motivation" => $request->data['motivation'],
                "eligibility" => $request->data['eligibility'],
                "status" => "pending",
            ];

            // dd($ansCreate);

            $volunteer = Volunteer::create($create);
            $ansCreate = [];
            if ($request->questions) {
                foreach ($request->questions as $key => $answer) {
                    $ans["question_id"] = substr($key, 8);
                    $ans["answer"] = $answer;
                    $ans["volunteer_id"] = $volunteer->id;
                    array_push($ansCreate, $ans);
                }
                
                $store = Answer::insert($ansCreate);
            } else {
                $store = $volunteer;
            }

            if($store) {
                $return = redirect()->route('volunteer.postmsg', ['slug' => $slug]);
                $when = now()->addSeconds(10);
                $request->user()->notify((new PostRegNotification(Project::where('project_slug', $slug)->first(), $request->user()))->delay($when));
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
        $data['volunteer'] = Volunteer::find(decrypt($id));
        // $data['questions'] = Question::where('project_id', $data['volunteer']->project_id)->get();
        $data['answers'] = Answer::with('question')->where('volunteer_id', $data['volunteer']->id)->get();
        return view('member.partials.modal.show_volunteer_application', $data);
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
    public function update(Request $request, $id, $code) {
        $accept = null;
        $reject = null;
        $v = Volunteer::find(decrypt($id));
        $project = $v->project()->get()[0];
        $registered_volunteer = $project->registered_volunteer;
        $when = now()->addSeconds(10);
        
        if ($request->code === 'yes') {
            $v->status = "accepted";
            $accept = $v->save();
        } else {
            $v->status = "rejected";
            $reject = $v->save();
        }

        if($accept){
            $registered_volunteer += 1;
            $project->registered_volunteer = $registered_volunteer;
            $upp = $project->save();
            if($upp) {
                $return = ["success" => $v->user->profile->name." berhasil didaftarkan sebagai relawan proyek "]; 
                $v->user->notify((new AcceptVolunteer($v))->delay($when));
            }
        } elseif($reject){
            $registered_volunteer -= 1;
            $project->registered_volunteer = $registered_volunteer;
            $upp = $project->save();
            if($upp) {
                $return = ["success" => $v->user->profile->name." ditolak sebagai relawan proyek "]; 
                $v->user->notify((new RejectVolunteer($v))->delay($when));
            }
        } else {
            $return = ["erorr" => "Terjadi kesalahan. Silahkan coba lagi atau hubingi administrator"];
        }

        return response()->json($return);
    }

    public function accept(Request $request, $id)
    {   
        $v = Volunteer::find($id);
        $v->status = "accepted";
        $accept = $v->save();

        if($accept){
            $return = ["success" => $v->user->profile->name." berhasil didaftarkan sebagai relawan proyek "]; 
        } else {
            $return = ["erorr" => "Terjadi kesalahan. Silahkan coba lagi atau hubingi administrator"];
        }

        return response()->json($return);
    }

    public function reject(Request $request, $id)
    {   
        $v = Volunteer::find($id);
        $v->status = "rejected";
        $reject = $v->save();

        if($reject){
            $return = ["success" => $v->user->profile->name." ditolak sebagai relawan proyek "]; 
        } else {
            $return = ["erorr" => "Terjadi kesalahan. Silahkan coba lagi atau hubingi administrator"];
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
        //
    }
}
