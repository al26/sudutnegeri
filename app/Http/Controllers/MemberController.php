<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use Validator;
use App\Education_sector as Sector;
use App\Province;
use App\User_profile as Profile;
use App\User_address as Address;
use App\Donation;
use App\Volunteer;
use Hash;
use Illuminate\Support\Facades\Storage;

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
        $data['sectors'] = Sector::all();
        $data['provinces'] = Province::all();
        $data['investments'] = Donation::where('user_id', $request->user()->id)->get();
        $projects_id = Project::where('user_id', $request->user()->id)->pluck('id')->toArray();
        $data['volunteers'] = Volunteer::whereIn('project_id', $projects_id)->get();
        
        return view('member.dashboard', ['menu' => $menu, 'section' => $section], $data);
    }

    public function editProfile(Request $request, $id) {
        $rules = [
            "name"          => "required",
            "gender"        => "required",
            "dob"           => "required|date",
            "phone_number"  => "required",
            "biography"     => "required",
            "profession"    => "required",
            "institution"   => "required",
            // "interest"      => "required",
            "skills"        => "required",
            "province_id"   => "required",
            "regency_id"    => "required",
            "district_id"   => "required",
            "exact_location"=> "required",
            "zip_code"      => "required",
        ];

        $messages = [
            "name.required"          => "Kolom :attribute tidak boleh kosong",
            "gender.required"        => "Kolom :attribute tidak boleh kosong",
            "dob.required"           => "Kolom :attribute tidak boleh kosong",
            "province_id.required"   => "Kolom :attribute tidak boleh kosong",
            "regency_id.required"    => "Kolom :attribute tidak boleh kosong",
            "district_id.required"   => "Kolom :attribute tidak boleh kosong",
            "phone_number.required"  => "Isikan :attribute Anda yang dapat dihubungi",
            "biography.required"     => "Tuliskan :attribute Anda",
            "profession.required"    => "Kolom :attribute tidak boleh kosong",
            "institution.required"   => "Mohon isikan :attribute Anda saat ini",
            // "interest.required"      => "Kolom :attribute tidak boleh kosong",
            "skills.required"        => "Mohon isikan minimal satu :attribute Anda",
            "exact_location.required"=> "Kolom :attribute tidak boleh kosong",
            "zip_code.required"      => "Kolom :attribute tidak boleh kosong",
        ];

        $attributes = [
            "name"          => "nama",
            "gender"        => "jenis kelamin",
            "dob"           => "tanggal lahir",
            "phone_number"  => "nomor hp",
            "biography"     => "biografi",
            "profession"    => "profesi",
            "institution"   => "institusi",
            // "interest"      => "minat",
            "skills"        => "keahlian",
            "province_id"   => "provinsi",
            "regency_id"    => "kabupaten/kota",
            "district_id"   => "kecamatan",
            "exact_location"=> "alamat lengkap",
            "zip_code"      => "kode pos",
        ];

        $data = $request->data;
        // dd($data);

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $profile = [
                "name" => $request->data['name'],
                "gender" => $request->data['gender'],
                "dob" => $request->data['dob'],
                "biography" => $request->data['biography'],
                // "interest" => implode(', ', $request->data['interest']),
                "skills" => $request->data['skills'],
                "profession" => $request->data['profession'],
                "institution" => $request->data['institution'],
                "phone_number" => $request->data['phone_number'],
            ];

            $address = [
                "user_profile_id" => $id,
                "province_id" => $request->data['province_id'],
                "regency_id" => $request->data['regency_id'],
                "district_id" => $request->data['district_id'],
                "exact_location" => $request->data['exact_location'],
                "zip_code" => $request->data['zip_code'],
            ];


            $store = Profile::find($id)->update($profile);
            $store .= Address::where('user_profile_id', $id)->update($address);

            if($store) {
                $return = [
                    "success" => "Profile berhasil di ubah",
                    "profile" => $profile,
                    "address" => $address,
                ];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal edit profil."];
            }

            // $return = ["success" => $request->data];
        }

        return response()->json($return);
    }

    public function editProfilePicture($id) {
        $data['id'] = $id;
        return view('member.partials.modal.edit_profile_pic', $data);
    }

    public function updateProfilePicture(Request $request, $id) {
        $path = "";
        $filename = "";

        $profile = Profile::findOrFail($id);
        $old = substr($profile->profile_picture, 7);

        if($request->hasFile('avatar')) {
            $filename = Hash::make($id).time().'.'.$request->avatar->getClientOriginalExtension();
            $file = $request->file('avatar');
            $path = $file->storeAs('public/profile_pictures', $filename);
        }

        if($path) {
            $update = $profile->update(['profile_picture' => "storage/profile_pictures/$filename"]);
            if($update) {
                Storage::delete('public'.$old); 
                $return = ['success' => "Foto profil berhasil diubah"];
            } else {
                $return = ['error' => "Terjadi kesalahan. Gagal mengubah foto profil"];
            }
        }

        return response()->json($return);
    }
}
