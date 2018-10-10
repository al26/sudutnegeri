<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Bank;

class BankController extends Controller
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
        return view('admin.partials.modal.bank-create');
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
            'bank_code' => 'required|numeric',
            'bank_name' => 'required',
            'logo' => 'required|images|mimes:jpg,jpeg,png,svg'
        ];

        $messages = [
            'bank_code.required' => ':attribute tidak boleh kosong',
            'bank_code.numeric' => ':attribute harus berupa angka',
            'bank_name.required' => ':attribute tidak boleh kosong',
            'logo.required' => ':attribute tidak boleh kosong',
            'logo.images' => ':attribute harus berupa gambar dengan format .jpg, .jpeg, .png, atau .svg',
            'logo.mimes' => ':attribute harus berupa gambar dengan format .jpg, .jpeg, .png, atau .svg',
        ];

        $attributes = [
            'bank_code' => 'Kode bank',
            'bank_name' => 'Nama bank',
            'logo' => 'Logo bank'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            $store = Bank::create($data);

            if($store) {
                $return = ['success' => 'Berhasil menambah bank baru ke daftar bank'];
            } else {
                $return = ['error' => 'Gagal menambah bank baru'];
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
