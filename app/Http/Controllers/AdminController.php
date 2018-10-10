<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\CheckRole;
use App\Donation;
use App\Bank;
use App\Project;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:admin'])->except(['showLoginForm', 'login']);
    }

    public function index($menu = null) {
        $data['menu'] = $menu;
        $data['donations'] = Donation::all();
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































































































    public function showVerifyDonationForm($id){
       $data['donation'] = Donation::findOrFail(decrypt($id));
       //return $data;
       return view('admin.partials.modal_view.verify_donation',$data);
    }
    public function showVerifiedDonationForm($id, $code){

      $status = array(
        'status'=> $code
      );
      $donationUpdate = Donation::find(decrypt($id))->update($status);

      if($code === "verified"){
        $dataAmount = Donation::select('amount')->where('id', decrypt($id))->get();
        $dataIdProject = Donation::select('project_id')->where('id', decrypt($id))->get();
        $projectCollectedFund=Project::select('collected_funds')->where('id',$dataIdProject[0]->project_id)->get();
        $afterSum = $dataAmount[0]->amount + $projectCollectedFund[0]->collected_funds;
        $data = array(
          'collected_funds'=>$afterSum
        );
        $donationUpdate = Project::find($dataIdProject[0]->project_id)->update($data);
        //return $afterSum;
      }
      return $this->index('donations');
    }
}
