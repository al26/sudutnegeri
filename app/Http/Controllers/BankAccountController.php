<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank_account as Ba;
use App\Bank;
use Validator;

class BankAccountController extends Controller
{
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
    public function create()
    {
        $data['banks'] = Bank::all();
        return view('admin.partials.modal.bank-account-create', $data);
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
            'bank_id' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|numeric',
            'bank_address' => 'required'
        ];

        $messages = [
            'bank_id.required' => ':attribute tidak boleh kosong',
            'account_name.required' => ':attribute tidak boleh kosong',
            'account_number.required' => ':attribute tidak boleh kosong',
            'account_number.numeric' => ':attribute harus berupa angka',
            'bank_address.required' => ':attribute tidak boleh kosong' 
        ];

        $attributes = [
            'bank_id' => 'Nama bank',
            'account_name' => 'Nama akun',
            'account_number' => 'Nomor rekening',
            'bank_address' => 'Alamat bank'
        ];

        $data = $request->data;
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            $store = Ba::create($data);
            
            if ($store) {
                $return = ['success' => 'Berhasil menambah akun bank baru'];
            } else {
                $return = ['error' => 'Gagal menambah akun bank baru'];
            }

            return response()->json($return);
            
        }
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
        $data['banks'] = Bank::all();
        $data['bank_account'] = Ba::find(decrypt($id));

        return view('admin.partials.modal.bank-account-edit', $data);
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
        $rules = [
            'bank_id' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|numeric',
            'bank_address' => 'required'
        ];

        $messages = [
            'bank_id.required' => ':attribute tidak boleh kosong',
            'account_name.required' => ':attribute tidak boleh kosong',
            'account_number.required' => ':attribute tidak boleh kosong',
            'account_number.numeric' => ':attribute harus berupa angka',
            'bank_address.required' => ':attribute tidak boleh kosong' 
        ];

        $attributes = [
            'bank_id' => 'Nama bank',
            'account_name' => 'Nama akun',
            'account_number' => 'Nomor rekening',
            'bank_address' => 'Alamat bank'
        ];

        $data = $request->data;
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            $update = Ba::find(decrypt($id))->update($data);
            
            if ($update) {
                $return = ['success' => 'Berhasil mengubah akun bank'];
            } else {
                $return = ['error' => 'Gagal mengubah akun bank'];
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
        $del = Ba::find(decrypt($id))->delete();

        if($del) {
            $return = ['success' => 'Berhasil hapus akun bank'];
        } else {
            $return = ['error' => 'Gagal menghapus akun bank'];
        }

        return response()->json($return);
    }
}
