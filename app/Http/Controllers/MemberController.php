<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use Validator;

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
        
        return view('member.dashboard', ['menu' => $menu, 'section' => $section], $data);
    }

    public function editProfile(Request $request, $id) {
        $rules = [
            "name"          => "required",
            "gender"        => "required",
            "dob"           => "required|date",
            "address"       => "required",
            "phone_number"  => "required",
            "biography"     => "required",
            "profession"    => "required",
            "institution"   => "required",
            "interest"      => "required",
            "skils"         => "required",
        ];

        $messages = [
            "name.required"          => "Kolom :attribute tidak boleh kosong",
            "gender.required"        => "Kolom :attribute tidak boleh kosong",
            "dob.required"           => "Kolom :attribute tidak boleh kosong",
            "address.required"       => "Kolom :attribute tidak boleh kosong",
            "phone_number.required"  => "Isikan :attribute Anda yang dapat dihubungi",
            "biography.required"     => "Tuliskan :attribute Anda",
            "profession.required"    => "Kolom :attribute tidak boleh kosong",
            "institution.required"   => "Mohon isikan :attribute Anda saat ini",
            "interest.required"      => "Kolom :attribute tidak boleh kosong",
            "skils.required"         => "Mohin isikan minimal satu :attribute Anda",
        ];

        $attributes = [
            "name"          => "nama",
            "gender"        => "jenis kelamin",
            "dob"           => "tanggal lahir",
            "address"       => "alamat",
            "phone_number"  => "nomor hp",
            "biography"     => "biografi",
            "profession"    => "profesi",
            "institution"   => "institusi",
            "interest"      => "minat",
            "skils"         => "keahlian",
        ];

        $data = $request->data;
        // die(var_dump($email));

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            // $password = Hash::make($request->data['new_pass']);
            // $email = $request->data['email'];

            // $store = User::where('email', $email)->update(['password' => $password]);
            // if($store) {
            //     $return = ["success" => "Password baru berhasil dibuat"];
            // } else {
            //     $return = ["errors" => "Terjadi Kesalahan. Gagal membuat password baru."];
            // }

            dd($request->data);
        }

        return response()->json($return);
    }
}
