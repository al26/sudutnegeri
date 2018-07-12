<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\Data_historis As History;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $menu = null, $section = null)
    {
        $data['user_projects'] = Project::where('user_id', $request->user()->id)->paginate(5);
        $data['user_profile']  = $request->user()->profile;
        // dd($request->query);
        // die(var_dump()) ;
        // if($request->ajax() && !empty($request->get('page'))){
        //     return view('member.partials.main-content.projects', $data);
        // }
        
        return view('member.dashboard', ['menu' => $menu, 'section' => $section], $data);
    }

    public function manageProject(Request $request, $slug) {
        $data['user_profile']  = $request->user()->profile;
        $data['data'] = Project::where("project_slug",$slug)->first();
        $project_id = $data['data']['id'];
        $data['historis'] = History::where('project_id', $project_id)->get(); 
        // dd($data);
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'manage-project'], $data);
    }
}
