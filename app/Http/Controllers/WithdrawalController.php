<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Withdrawal;
use App\Helpers\Idnme;

class WithdrawalController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:admin'])->only(['show', 'confirm', 'reject']);
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
    public function create(Request $request)
    {
        $credits = $request->user()->withdrawals()->where('status', 'pending')->pluck('project_id')->toArray();
        $data['projects'] = $request->user()->projects->whereNotIn('id', $credits)->where('collected_funds', '>', 0);
        $data['banks'] = \App\Bank::all();
        return view('member.dashboard', ['menu' => 'sudut', 'section' => 'create-withdrawal'], $data);
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
            "account_number" => 'required|numeric',
            "bank_id" => 'required',
            // "account_name" => 'required',
            "amount" => ['required','digits_between:5, 10',
                            function($attribute, $value, $fail) use ($request) {
                                $saldo = \App\Project::where('id', decrypt($request->data['project_id']))->pluck('collected_funds')[0];
                                
                                if($value > $saldo) {
                                    return $fail('Mohon masukan jumlah penarikan lebih kecil dari saldo. Saldo : '. Idnme::print_rupiah($saldo, false, true));
                                }
                            }
                        ],
            // "attachment" => 'image|mimes:jpg,jpeg,png,svg'
        ];

        $messages = [
            'account_number.required' => 'Nomor rekening tidak boleh kosong',
            'account_number.numeric' => 'Nomor rekening harus berupa angka',
            'bank_id.required' => 'Mohon pilih bank tujuan transfer pencairan dana',
            // 'account_name.required' => 'Atas nama tidak boleh kosong',
            'ammount.required' => 'Mohon isi jumlah penarikan',
            'ammount.digits_between' => 'Jumlah minimal penarikan adalah 10.000 maksimal 4.000.000.000',
            // 'attachment.image' => 'Mohon upload scan/foto KTP dalam format .jpg, .png, atau .svg',
            // 'attachment.mimes' => 'Mohon upload scan/foto KTP dalam format .jpg, .png, atau .svg',
        ];

        $attributes = [
            'account_number' => 'nomor rekening',
            'bank_id' => 'bank',
            // 'account_name' => 'atas nama',
            'amount' => 'jumlah penarikan',
            // 'attachment' => 'scan/foto KTP'
        ];

        $data = $request->data;
        // dd($data);
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $data['user_id'] = $request->user()->id;
            $data['project_id'] = decrypt($request->data['project_id']);
            $data['account_name'] = ucwords($request->user()->profile->name);
            // $data['bank_id'] = App\Bank::where('bank_code', $request->data['bank_code'])->pluck('id');
            
            // $path = "";
            // $filename = "";

            // if($request->hasFile('data.attachment')) {
            //     $filename = md5($request->data['attachment']->getClientOriginalName().time()).'.'.$request->data['attachment']->getClientOriginalExtension();
            //     $file = $request->file('data.attachment');
            //     $path = $file->storeAs('withdrawal_attachments', $filename);
            // }

            // if($path) {
            //     $data['attachment'] = "storage/withdrawal_attachments/".$filename;
            // }

            $withdrawal = Withdrawal::create($data);

            if($withdrawal) {
                $return = ["success" => "Permohonan pencairan dana berhasil dilakukan"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal membuat permohonan penairan dana."];
            }
        }

        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['withdrawal'] = Withdrawal::find(decrypt($id));
        return view('admin.partials.modal.proceed-withdrawal', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function confirm(Request $request, $id) {       
        $rules = array(
            'receipt' => 'required|image|mimes:jpg,jpeg,png,svg'
        );

        $messages = array(
            'receipt.required' => 'Bukti transfer tidak boleh kosong',
            "receipt.image"    => "Mohon upload foto bukti transfer",
            "receipt.mimes"    => "Jenis file yang diperbolehkan hanya .jpg, .png, atau .svg"
        );

        $attributes = array('receipt' => 'Bukti transfer');

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $id = decrypt($id);
            $withdrawal = Withdrawal::find($id);
            $old = !empty($withdrawal->withdrawal_receipt) ? substr($withdrawal->withdrawal_receipt, 7) : "";

            if($request->hasFile('receipt')) {
                $filename = md5($id.time()).'.'.$request->receipt->getClientOriginalExtension();
                $file = $request->file('receipt');
                $path = $file->storeAs('withdrawal_receipt', $filename);
            }

            if($path) {
                $data['status'] = 'processed';
                $data['receipt'] = "storage/withdrawal_receipt/$filename";
                
                $update = $withdrawal->update($data);
                if($update) {
                    if($old !== ""){
                        Storage::delete('public'.$old); 
                    }
                    $return = ['success' => "Pencairan dana berhasil diproses"];
                } else {
                    $return = ['error' => "Terjadi kesalahan. Memproses pencairan Dana"];
                }
            }

        }
        return response()->json($return);
    }

    public function reject($id) {

    }
}
