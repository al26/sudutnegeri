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
use App\Withdrawal;

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
        $data['users'] = User::where('role', 'member')->get();
        $data['withdrawals'] = Withdrawal::all();
        return view('admin.dashboard', $data);
    }

    public function showLoginForm() {
        return view('admin.login');
    }

    public function login (Request $request) {
        $this->validate($request, [
            'email' => ['required','email','exists:users,email', new CheckRole('users', 'admin')],
            'password' => 'required|min:6',
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
            default:
                $status = 'rejected';
                break;
        }

        $project->project_status = $status;
        $update = $project->save();

        if ($update) {
            if($status === 'published') {
                $return = ['success' => "Proyek $project->project_name telah disetujui dan dipublikasi"];
            } else {
                $return = ['error' => "Proyek $project->project_name ditolak"];
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
        $donationUpdate = Donation::find(decrypt($id))->update($status);

        if($donationUpdate) {
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
                } else {
                    $return = ['error' => 'Gagal verifikasi donasi'];
                }
            } else {
                $return = ['success' => 'Berhasil menolak donasi'];
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
