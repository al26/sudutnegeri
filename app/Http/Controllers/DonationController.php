<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Bank_account;
use App\Donation;
use App\Project;
use Validator;
use Notification;
use App\Notifications\DonationInvoice;
use App\Notifications\VerifyDonation;
use App\Notifications\RejectDonation;
use Nexmo;
use Storage;

class DonationController extends Controller
{
    public function __construct(){
        $this->middleware(['auth'])->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug, Request $request)
    {
        $data['project'] = Project::where('project_slug', $slug)->first();
        if($request->user()->id === $data['project']->user_id) {
            return redirect()->back();
        }
        $data['banks'] = Bank_account::with('bank')->get();
        return view('member.create_donation', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "amount"    => "required|digits_between:5, 10",
            "bank_id"   => "required",
            // "phone_number" => "required"
        ];

        $messages = [
            "amount.required"   => "Kolom :attribute tidak boleh kosong",
            // "phone_number.required"   => "Kolom :attribute tidak boleh kosong",
            // "amount.numeric"    => "Mohon isikan dengan jumlah yang valid (berupa angka)",
            // "amount.digits"        => "Isikan dengan minimal 10.000 dan kelipatan ribuan, maksimal 4.000.000.000",
            "bank_id.required"  => "Mohon pilih salah satu dari :attribute yang tersedia",
            "digits_between"    => "Isikan dengan minimal 10.000 dan kelipatan ribuan, maksimal 4.000.000.000"
        ];

        $attributes = [
            "amount"    => "jumlah donasi",
            "bank_id"   => "metode pembayaran",
            // "phone_number" => "nomor hp"
        ];

        $data = $request->data;
        // dd(intval($data['amount']));
        $validator = Validator::make($data, $rules, $messages, $attributes);
        
        $validator->after(function ($validator) use ($data) {
            if (intval($data['amount']) > 4000000000) {
                $validator->errors()->add('amount', 'Isikan dengan minimal 10.000 dan kelipatan ribuan, maksimal 4.000.000.000');
            }
        });
        if ($validator->fails()) {
            $return = redirect()->back()->withErrors($validator)->withInput();
        } else {
            $anonymouse = !empty($request->data['anonymouse']) ? true : false;
            $project_id = Project::where('project_slug', $request->data['project_slug'])->pluck('id')[0];
            $create = [
                "user_id"    => (int)base64_decode(urldecode($request->data['user_id'])),
                "project_id" => $project_id,
                "amount"     => $request->data['amount'],
                "bank_id"    => $request->data['bank_id'],
                "anonymouse" => $anonymouse,
                "payment_code" => rand(10,999),
                "status"     => "pending"
            ];

            $store = Donation::create($create);
            if($store) {
                $return = redirect()->route('donation.invoice', ['slug' => $request->data['project_slug']]);
            } else {
                $return = redirect()->back()->with('error', 'Terjadi kesalahan. Silahkan coba lagi')->withInput();
            }
        }
        
        return $return;
    }

    public function confirmDonation(Request $request) {
        $confirm = Donation::findOrFail($request->donation_id)->update('status', 'confirmed');

        if ($confirm) {
            $where = [
                'project_id' => $request->project_id,
                'status' => 'confirmed'
            ];

            $progress = [
                "funding_progress" => Donation::where($where)->sum('amount')
            ];
            
            $up = Project::find($request->project_id)->update($progress);
            if($up) {
                $return = ['success' => 'Donasi berhasil dikonfirmasi'];
            }    
        } else {
            $return = ['error' => 'Terjadi kesalahan. Konfirmasi donasi gagal'];
        }

        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showReceipt($id)
    {
        $donation = Donation::findOrFail($id);
        return $donation->transfer_receipt;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadReceipt(Request $request, $id)
    {
        $data['user_profile']  = $request->user()->profile;
        // $data['donation'] = Donation::findOrFail((int)base64_decode(urldecode($id)));
        $data['donation'] = Donation::findOrFail(decrypt($id));
        return view('member.dashboard', ['menu' => 'negeri', 'section' => 'upload-transfer-receipt'], $data);
        // return view('member.partials.main-content.upload-transfer-receipt', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveReceipt(Request $request, $id)
    {
        $path = "";
        $filename = "";

        $donation = Donation::findOrFail($id);
        $old = $donation->transfer_receipt !== null ? substr($donation->transfer_receipt, 7) : null;

        if($request->hasFile('receipt')) {
            $filename = md5($id.time()).'.'.$request->receipt->getClientOriginalExtension();
            $file = $request->file('receipt');
            $path = $file->storeAs('transfer_receipts', $filename);
        }

        if($path) {
            $update = $donation->update([
                'transfer_receipt' => "storage/transfer_receipts/$filename",
                'status' => 'pending'
            ]);
            if($update) {
                if($old !== null){
                    Storage::delete($old); 
                }
                $return = ['success' => "Bukti transfer berhasil diunggah"];
            } else {
                if(Storage::exists($path)) {
                    Storage::deleteDirectory($path);
                }
                $return = ['error' => "Terjadi kesalahan. Gagal mengunggah bukti transfer"];
            }
        }

        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoice(Request $request, $slug) {
        $project_id = Project::where('project_slug', $slug)->firstOrFail()->id;
        $where = [
            "user_id" => $request->user()->id,
            "project_id" => $project_id
        ];
        $donation = Donation::where($where)->orderBy('id', 'desc')->first();
        $data['donation'] = $donation;
        $when = now()->addSeconds(10);
        $request->user()->notify((new DonationInvoice($request->user(), $slug, $donation))->delay($when));
        // Nexmo::message()->send([
        //     'to'   => '+6285868444101',
        //     'from' => '+6281392531719',
        //     'text' => 'Using the facade to send a message.'
        // ]);
        // dd($data);
        return view('member.invoice', $data);
    }
}
