<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Project;
use Validator;
use App\Category;
use App\Province;
use App\User_profile as Profile;
use App\User_address as Address;
use App\User_verification as Verification;
use App\Donation;
use App\Volunteer;
use App\Regency;
use App\User;
use App\User_cv as CV;
use Hash;
use App\Data_historis as History;
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
        $data['user_projects_all'] = Project::where('user_id', $request->user()->id)->get();
        $data['user_activity'] = Volunteer::where('user_id', $request->user()->id)->get();
        $data['current_activity'] = Volunteer::where('user_id', $request->user()->id)->where('status', '!=' ,'finished')->first();
        $data['user_projects'] = Project::where('user_id', $request->user()->id)->paginate(5);
        $data['user_profile']  = $request->user()->profile;
        $data['categories'] = Category::all();
        $data['provinces'] = Province::all();
        $data['investments'] = Donation::where('user_id', $request->user()->id)->get();
        $data['verified_investments'] = Donation::where('user_id', $request->user()->id)->where('status', 'verified')->get();
        $projects_id = Project::where('user_id', $request->user()->id)->pluck('id')->toArray();
        $data['volunteers'] = Volunteer::whereIn('project_id', $projects_id)->get();
        $user_around = Regency::where('province_id', $request->user()->profile->address->province_id)->pluck('id')->toArray();
        $data['featured'] = Project::where('user_id', '!=', $request->user()->id)
                                    ->where(function ($query) use ($request, $user_around) {
                                        $query->whereIn('category_id', explode(",",$request->user()->profile->interest))
                                              ->orWhereIn('regency_id', $user_around);
                                    })->latest()->limit(6)->get();
        $data['updates'] = History::whereIn('project_id', 
                                        Donation::where('user_id', $request->user()->id)
                                                ->where('status', 'verified')
                                                ->pluck('project_id')->toArray()
                                    )
                                    ->orWhereIn('project_id', 
                                        Volunteer::where('user_id', $request->user()->id)
                                                ->where('status', 'accepted')
                                                ->latest()
                                                ->pluck('project_id')
                                                ->toArray()
                                    )
                                    ->orWhereIn('project_id',
                                        Project::where('user_id', $request->user()->id)
                                                ->pluck('id')
                                                ->toArray()
                                    )->orderBy('created_at', 'desc')->take(3)->get();

        // dd($data['update']);

        return view('member.dashboard', ['menu' => $menu, 'section' => $section], $data);
    }

    public function editProfile(Request $request, $id) {
        $rules = [
            "name"          => "required",
            "gender"        => "required",
            "dob"           => "required|date",
            "phone_number"  => "required|numeric",
            "biography"     => "required",
            "profession"    => "required",
            "institution"   => "required",
            "interest"      => "required",
            "skills"        => "required",
            "province_id"   => "required",
            "regency_id"    => "required",
            "district_id"   => "required",
            "exact_location"=> "required",
            "zip_code"      => "required",
            "identity_card" => "required",
            "identity_number" => "required|numeric", 
        ];

        $messages = [
            "name.required"          => "Kolom :attribute tidak boleh kosong",
            "gender.required"        => "Kolom :attribute tidak boleh kosong",
            "dob.required"           => "Kolom :attribute tidak boleh kosong",
            "province_id.required"   => "Kolom :attribute tidak boleh kosong",
            "regency_id.required"    => "Kolom :attribute tidak boleh kosong",
            "district_id.required"   => "Kolom :attribute tidak boleh kosong",
            "phone_number.required"  => "Isikan :attribute Anda yang dapat dihubungi",
            "phone_number.numeric"    => ":attribute harus berupa angka",
            "biography.required"     => "Tuliskan :attribute Anda",
            "profession.required"    => "Kolom :attribute tidak boleh kosong",
            "institution.required"   => "Mohon isikan :attribute Anda saat ini",
            "interest.required"      => "Kolom :attribute tidak boleh kosong",
            "skills.required"        => "Mohon isikan minimal satu :attribute Anda",
            "exact_location.required"=> "Kolom :attribute tidak boleh kosong",
            "zip_code.required"      => "Kolom :attribute tidak boleh kosong",
            "identity_card.required"        => "Kolom :attribute tidak boleh kosong",
            "identity_number.required"      => "Kolom :attribute tidak boleh kosong",
            "identity_number.numeric"    => ":attribute harus berupa angka",
        ];

        $attributes = [
            "name"          => "nama",
            "gender"        => "jenis kelamin",
            "dob"           => "tanggal lahir",
            "phone_number"  => "nomor hp",
            "biography"     => "biografi",
            "profession"    => "profesi",
            "institution"   => "institusi",
            "interest"      => "minat",
            "skills"        => "keahlian",
            "province_id"   => "provinsi",
            "regency_id"    => "kabupaten/kota",
            "district_id"   => "kecamatan",
            "exact_location"=> "alamat lengkap",
            "zip_code"      => "kode pos",
            "identity_card" => "kartu identitas",
            "identity_number" => "nomor identitas"
        ];

        $data = $request->data;
        // dd($data['interest'][0]);

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $profile = [
                "name" => $request->data['name'],
                "gender" => $request->data['gender'],
                "dob" => $request->data['dob'],
                "biography" => $request->data['biography'],
                "interest" => implode(', ', $request->data['interest']),
                "skills" => $request->data['skills'],
                "profession" => $request->data['profession'],
                "institution" => $request->data['institution'],
                "phone_number" => $request->data['phone_number'],
                "identity_card" => $request->data['identity_card'],
                "identity_number" => $request->data['identity_number'],
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
                $return = ["error" => "Terjadi Kesalahan. Gagal edit profil."];
            }

            // $return = ["success" => $request->data];
        }

        return response()->json($return);
    }

    public function editProfilePicture($id) {
        $data['id'] = decrypt($id);
        return view('member.partials.modal.edit_profile_pic', $data);
    }

    public function updateProfilePicture(Request $request, $id) {
        $id = decrypt($id);
        $path = "";
        $filename = "";

        $profile = Profile::findOrFail($id);
        $old = substr($profile->profile_picture, 7);

        if($request->hasFile('avatar')) {
            $filename = md5($id.time()).'.'.$request->avatar->getClientOriginalExtension();
            $file = $request->file('avatar');
            $path = $file->storeAs('profile_pictures', $filename);
        }

        if($path) {
            $update = $profile->update(['profile_picture' => "storage/profile_pictures/$filename"]);
            if($update) {
                if($old !== '/profile_pictures/avatar.jpg'){
                    Storage::delete('public'.$old); 
                }
                $return = ['success' => "Foto profil berhasil diubah"];
            } else {
                $return = ['error' => "Terjadi kesalahan. Gagal mengubah foto profil"];
            }
        }

        return response()->json($return);
    }

    public function changePassword(Request $request) {
        $rules = [
            "old_pass" => 'required|string|min:6',
            "new_pass_change" => 'required|string|min:6|confirmed',
            "new_pass_change_confirmation" => 'required',
        ];

        $messages = [
            "old_pass.required" => "Kolom :attribute tidak boleh kosong",
            "old_pass.string"   => "Password lama yang Anda masukkan salah",
            "old_pass.min"      => "Password lama yang Anda masukkan salah",
            "new_pass_change.required" => "Kolom :attribute tidak boleh kosong",
            "new_pass_change.string"   => "Isikan kolom :attribute dengan huruf, angka, dan karakter apapun (boleh termasuk spasi)",
            "new_pass_change.min"      => "Password minimal tidak kurang dari :min karakter",
            "new_pass_change.confirmed"=> "Password konfirmasi harus sama",
            "new_pass_change_confirmation.required" => "Kolom :attribute tidak boleh kosong",
        ];

        $attributes = [
            "old_pass" => 'password lama',
            "new_pass_change" => 'password baru',
            "new_pass_change_confirmation" => 'konfirmasi password',        
        ];

        $data = $request->data;
        // die(var_dump($email));

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $hashedPassword = User::where('email', $request->data['email'])->pluck('password')->first();
            
            if(Hash::check($request->data['old_pass'], $hashedPassword)) {
                $password = Hash::make($request->data['new_pass_change']);
                $email = $request->data['email'];
    
                $store = User::where('email', $email)->update(['password' => $password]);
                if($store) {
                    $return = ["success" => "Password Anda berhasil diubah"];
                } else {
                    $return = ["error" => "Terjadi Kesalahan. Gagal membuat password baru."];
                }
            } else {
                $return = ["error" => "Password lama yang Anda masukkan salah !"];
            }
        } 


        return response()->json($return);
    }

    public function verifyAccount(Request $request) {
        $sicpath = "";
        $sicname = "";
        $vppath = "";
        $vpname = "";

        $rules = [
            "sic" => "required|image|mimes:jpg,jpeg,png,svg",
            "vp"  => "required|image|mimes:jpg,jpeg,png,svg"
        ];
        
        $messages = [
            "sic.required"           => ":attribute tidak boleh kosong",
            "sic.image"              => ":attribute harus berupa gambar",
            "sic.mimes"              => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg",
            "vp.required"           => ":attribute tidak boleh kosong",
            "vp.image"              => ":attribute harus berupa gambar",
            "vp.mimes"              => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg"
        ];

        $attributes = [
            "sic" => "foto/scan kartu identitas",
            "vp"  => "foto verifikasi"
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $verify = Verification::where('user_profile_id', $request->user()->profile->id)->firstOrFail();
            $data['status'] = 'pending';
            // $old_sic = substr($verify->scan_id_card, 7) ?? null;
            // $old_vp = substr($verify->verification_picture, 7) ?? null;
    
            if($request->hasFile('sic') && $request->hasFile('vp')) {
                $folder = md5($verify->id.time()*26);
                
                $sicfile = $request->file('sic');
                $sicname = md5("sic".$verify->id.time()).'.'.$sicfile->getClientOriginalExtension();
                $sicpath = $sicfile->storeAs("user_verification/$folder", $sicname);
    
                $vpfile = $request->file('vp');
                $vpname = md5("vp_".$verify->id.time()).'.'.$vpfile->getClientOriginalExtension();
                $vppath = $vpfile->storeAs("user_verification/$folder", $vpname);
            }
    
            if($sicpath !== null) {
                $data['scan_id_card'] = "storage/user_verification/$folder/$sicname";
    
                if ($vppath !== null) {
                    $data['verification_picture'] = "storage/user_verification/$folder/$vpname";
    
                    $update = $verify->update($data);
    
                    if($update) {
                        $return = ['success' => "Foto verifikasi akun berhasil diunggah. Permintaan verifikasi akun Anda akan segera diproses oleh Sudut Negeri."];
                    } else {
                        if (Storage::exists($sicpath)) {
                            Storage::delete($sicpath);
                        }
    
                        if (Storage::exists($vppath)) {
                            Storage::delete($vppath);
                        }
    
                        $return = ['error' => "Terjadi kesalahan. Gagal mengubah foto profil"];
                    }
    
                } else {
                    if (Storage::exists($sicpath)) {
                        Storage::delete($sicpath);
                    }
    
                    $return = ['error' => "Terjadi kesalahan. Silahkan coba lagi"];
                }
            }
        }


        return response()->json($return);
    }

    public function editCV (Request $request, $profile) {
        $rules = [
            "institution" => "required",
            "major" => "required",
            "year" => "required|digits:4",
            "foreign_lang" => "required",
            "org_exp" => "required",
            "pro_exp" => "required"
        ];

        $messages = [
            "institution.required" => "Kolom :attribute tidak boleh kososng",
            "major.required" => "Kolom :attribute tidak boleh kososng",
            "year.required" => "Kolom :attribute tidak boleh kososng",
            "year.digits" => "Bukan format tahun yang valid. Kolom :attribute harus terdiri dari 4 karakter angka",
            "foreign_lang.required" => "Kolom :attribute tidak boleh kososng",
            "org_exp.required" => "Kolom :attribute tidak boleh kososng",
            "pro_exp.required" => "Kolom :attribute tidak boleh kososng",
        ];

        $attributes = [
            "institution" => "institusi / universitas",
            "major" => "jurusan",
            "year" => "tahun kelulusan",
            "foreign_lang" => "bahasa asing",
            "org_exp" => "pengalaman organisasi",
            "pro_exp" => "pengalaman profesional"
        ];

        $data = $request->data;
        // dd($data['interest'][0]);

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else { 
            $cv['education'] = $data['major'].", ".$data['institution'].", ".$data['year'];
            $cv['foreign_lang'] = $data['foreign_lang'];
            $cv['org_exp'] = $data['org_exp'];
            $cv['pro_exp'] = $data['pro_exp'];
            $update = CV::where('user_profile_id', decrypt($profile))->update($cv);

            if($update) {
                $return = ['success' => 'Berhasil membuat CV'];
            } else {
                $return = ['error' => 'Terjadi Kesalahan. Gagal membuat CV'];
            }
        }

        return response()->json($return);
    }

    public function viewModalCV($id) {
        $data['user'] = User::where('id', decrypt($id))->firstOrFail();
        // dd($data);
        return view('member.partials.modal.cv', $data);
    }
}
