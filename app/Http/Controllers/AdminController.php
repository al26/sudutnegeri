<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\CheckRole;
use App\Donation;
use App\Project;
use App\Category;
use App\Bank;
use App\Bank_account as Account;
use App\User;
use App\User_verification;
use App\User_profile;
use App\Withdrawal;
use App\Notifications\VerifyDonation;
use App\Notifications\RejectDonation;
use App\Notifications\AcceptProject;
use App\Notifications\RejectProject;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:admin'])->except(['showLoginForm', 'login']);
    }

    public function index($menu = null) {
        $data['menu'] = $menu;
        $data['donations'] = Donation::all();
        $data['projects'] = Project::all();
        $data['categories'] = Category::all();
        $data['banks'] = Bank::all();
        $data['bank_accounts'] = Account::all();
        $data['users'] = User_profile::where('updated_at', '!=', 'created_at')->whereNotNull('identity_card')->get();
        $data['withdrawals'] = Withdrawal::all();
        return view('admin.dashboard', $data);
    }

    public function showLoginForm() {
        return view('admin.login');
    }

    public function login (Request $request) {
        $this->validate($request, [
            'email' => [
                'required','email',
                Rule::exists('users')->where(function($q){
                    $q->where('active', true)
                      ->where('role', 'admin');
                })
            ],
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Kolom email tidak boleh kkosong',
            'email.email' => 'Mohon masukkan email yang valid',
            'email.exists' => 'Akun yang Anda masukkan tidak terdaftar',
            'password.required' => 'Kolom password tidak boleh kosong',
            'password.min' => 'Panjang password minimal 6 karakter' 
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ]; 

        if ( Auth::guard('admin')->attempt($credential, $request->remember) ) {
            // dd('masuk');
            return redirect()->intended(route('admin.dashboard'));
        }
        
        // dd($credential);
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function projectVerification(Request $request, $id) {
        $project = Project::findOrFail(decrypt($id));
        $status = "";
        switch ($request->action) {
            case 'verify':
                $status = 'published';
                break;
            case 'reject':
                $status = 'rejected';
                break;
            case 'freeze':
                $status = 'freeze';
                break;
            default:
                $status = 'submitted';
                break;
        }

        $project->project_status = $status;
        $update = $project->save();
        $when = now()->addSeconds(10);

        if ($update) {
            if($status === 'published') {
                $return = ['success' => "Proyek $project->project_name berhasil dipublikasi"];
                $project->user->notify((new AcceptProject($project))->delay($when));
            } 
            if ($status === 'rejected') {
                $return = ['error' => "Proyek $project->project_name ditolak"];
                $project->user->notify((new RejectProject($project))->delay($when));
            } 
            if($status === 'freeze') {
                $return = ['success' => "Proyek $project->project_name berhasil dibekukan"];
            }
        } else {
            $return = ['error' => "Terjadi kesalahan. Silahkan Coba lagi"];
        }

        return response()->json($return);
    }

    public function showVerifyDonationForm($id){
        $data['donation'] = Donation::findOrFail(decrypt($id));
        //return $data;
        return view('admin.partials.modal.verify-donation',$data);
    }
    public function showVerifiedDonationForm($id, $code){

        $status = array(
            'status'=> $code
        );
        $donation = Donation::find(decrypt($id));
        $donationUpdate = $donation->update($status);
        
        if($donationUpdate) {
            $when = now()->addSeconds(10);
            if($code === "verified"){
                $dataAmount = Donation::select('amount')->where('id', decrypt($id))->get();
                $dataIdProject = Donation::select('project_id')->where('id', decrypt($id))->get();
                $projectCollectedFund=Project::select('collected_funds')->where('id',$dataIdProject[0]->project_id)->get();
                $afterSum = $dataAmount[0]->amount + $projectCollectedFund[0]->collected_funds;
                $data = array(
                    'collected_funds'=> $afterSum
                );
                $update = Project::find($dataIdProject[0]->project_id)->update($data);

                if($update) {
                    $return = ['success' => 'Berhasil memverifikasi donasi'];
                    $donation->user->notify((new VerifyDonation($donation))->delay($when));
                } else {
                    $return = ['error' => 'Gagal verifikasi donasi'];
                    Donation::find(decrypt($id))->update(['status' => 'pending']);
                }
            } else {
                $return = ['success' => 'Berhasil menolak donasi'];
                $donation->user->notify((new RejectDonation($donation))->delay($when));
            }
        } else {
            $return = ['error' => 'Gagal verifikasi donasi'];
        }

        return response()->json($return);
    }

    public function userVerification($id) {
        $data['verification'] = User_verification::findOrFail(decrypt($id));
        // dd($data);
        return view('admin.partials.modal.user-verify', $data);
    }

    public function userVerify(Request $request, $id) {
        if($request->action && $request->action === 'verify') {
            $data['status'] = 'verified';
        } else {
            $data['status'] = 'unverified';
        }

        $v = User_verification::find(decrypt($id));
        $update = $v->update($data);

        if($update) {
            $return = ['success' => "Pengguna ".$v->profile->name." berhasil diverifikasi"];
        } else {
            $return = ['error' => "Gagal memverifikasi pengguna"];
        }

        return response()->json($return);
    }
}
