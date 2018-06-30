<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;

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
    public function index($menu = null, $section = null)
    {
        // dd($request->query('section'));
        return view('member.dashboard', ['menu' => $menu, 'section' => $section]);
    }

    public function manageCampaign($id) {
        $data = Project::find($id)->first();
        // dd($data['id']);
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'manage-campaign', 'data' => $data]);
    }
}
