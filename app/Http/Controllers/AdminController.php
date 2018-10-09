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
}
