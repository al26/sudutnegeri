<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
}
