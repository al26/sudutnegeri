<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Withdrawal;
use App\Helpers\Idnme;

class WithdrawalController extends Controller
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
    public function create(Request $request)
    {
        $credits = $request->user()->withdrawals()->where('status', 'pending')->pluck('project_id')->toArray();
        $data['projects'] = $request->user()->projects->whereNotIn('id', $credits);
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
            "bank_code" => 'required',
            "account_name" => 'required',
            "amount" => ['required','digits_between:5, 10',
                            function($attribute, $value, $fail) use ($request) {
                                $saldo = \App\Project::where('id', decrypt($request->data['project_id']))->pluck('collected_funds')[0];
                                
                                if($value > $saldo) {
                                    return $fail('Mohon masukan jumlah penarikan lebih kecil dari saldo. Saldo : '. Idnme::print_rupiah($saldo, false, true));
                                }
                            }
                        ],
            "attachment" => 'image|mimes:jpg,jpeg,png,svg'
        ];

        $messages = [
            'account_number.required' => 'Nomor rekening tidak boleh kosong',
            'account_number.numeric' => 'Nomor rekening harus berupa angka',
            'bank_code.required' => 'Mohon pilih bank tujuan transfer pencairan dana',
            'account_name.required' => 'Atas nama tidak boleh kosong',
            'ammount.required' => 'Mohon isi jumlah penarikan',
            'ammount.digits_between' => 'Jumlah minimal penarikan adalah 10.000 maksimal 4.000.000.000',
            'attachment.image' => 'Mohon upload scan/foto KTP dalam format .jpg, .png, atau .svg',
            'attachment.mimes' => 'Mohon upload scan/foto KTP dalam format .jpg, .png, atau .svg',
        ];

        $attributes = [
            'account_number' => 'nomor rekening',
            'bank_code' => 'bank',
            'account_name' => 'atas nama',
            'amount' => 'jumlah penarikan',
            'attachment' => 'scan/foto KTP'
        ];

        $data = $request->data;
        // dd($data);
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $data['user_id'] = $request->user()->id;
            $data['project_id'] = decrypt($request->data['project_id']);
            
            $path = "";
            $filename = "";

            if($request->hasFile('data.attachment')) {
                $filename = md5($request->data['attachment']->getClientOriginalName().time()).'.'.$request->data['attachment']->getClientOriginalExtension();
                $file = $request->file('data.attachment');
                $path = $file->storeAs('public/withdrawal_attachments', $filename);
            }

            if($path) {
                $data['attachment'] = "storage/withdrawal_attachments/".$filename;
            }

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
        //
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
}
