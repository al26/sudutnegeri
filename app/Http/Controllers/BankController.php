<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Bank;
use Illuminate\Support\Facades\Storage;

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
            'logo' => 'required|image|mimes:jpg,jpeg,png,svg'
        ];

        $messages = [
            'bank_code.required' => ':attribute tidak boleh kosong',
            'bank_code.numeric' => ':attribute harus berupa angka',
            'bank_name.required' => ':attribute tidak boleh kosong',
            'logo.required' => ':attribute tidak boleh kosong',
            'logo.image' => ':attribute harus berupa gambar dengan format .jpg, .jpeg, .png, atau .svg',
            'logo.mimes' => ':attribute harus berupa gambar dengan format .jpg, .jpeg, .png, atau .svg',
        ];

        $attributes = [
            'bank_code' => 'Kode bank',
            'bank_name' => 'Nama bank',
            'logo' => 'Logo bank'
        ];

        $data = $request->data;

        // $return = ['errors' => $data];
        
        $validator = Validator::make($data, $rules, $messages, $attributes);
        $path = "";
        $filename = "";

        if ($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            if ($request->hasFile('data.logo')) {
                $filename = str_slug($data['bank_name'].time()).'.'.$request->data['logo']->getClientOriginalExtension();
                $file = $request->file('data.logo');
                $path = $file->storeAs('bank_logo', $filename);
            }
            
            if ($path !== "") {
                $data['logo'] = "storage/bank_logo/".$filename;
                $store = Bank::create($data);
    
                if($store) {
                    $return = ['success' => 'Berhasil menambah bank baru ke daftar bank'];
                } else {
                    $return = ['error' => 'Gagal menambah bank baru'];
                }
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
        $data['bank'] = Bank::find(decrypt($id));

        return view('admin.partials.modal.bank-edit', $data);
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
            'bank_code' => 'required|numeric',
            'bank_name' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,svg'
        ];

        $messages = [
            'bank_code.required' => ':attribute tidak boleh kosong',
            'bank_code.numeric' => ':attribute harus berupa angka',
            'bank_name.required' => ':attribute tidak boleh kosong',
            // 'logo.required' => ':attribute tidak boleh kosong',
            'logo.image' => ':attribute harus berupa gambar dengan format .jpg, .jpeg, .png, atau .svg',
            'logo.mimes' => ':attribute harus berupa gambar dengan format .jpg, .jpeg, .png, atau .svg',
        ];

        $attributes = [
            'bank_code' => 'Kode bank',
            'bank_name' => 'Nama bank',
            'logo' => 'Logo bank'
        ];

        $data = $request->data;

        $validator = Validator::make($data, $rules, $messages, $attributes);
        $path = "";
        $filename = "";
        $old = "";

        $bank = Bank::find(decrypt($id));
        
        if ($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            if ($request->hasFile('data.logo')) {
                $old = !empty($bank->logo) ? substr($bank->logo, 7) : null;
                $filename = str_slug($data['bank_name'].time()).'.'.$request->data['logo']->getClientOriginalExtension();
                $file = $request->file('data.logo');
                $path = $file->storeAs('bank_logo', $filename);

                if ($path !== "") {
                    $data['logo'] = "storage/bank_logo/".$filename;
                }
            }
            
            $update = $bank->update($data);

            if($update) {
                if($old !== "") {
                    Storage::delete('public'.$old);
                }
                $return = ['success' => "Berhasil merubah data bank"];
            } else {
                $return = ['error' => "Gagal merubah data bank"];
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
        $bank = Bank::find(decrypt($id));
        $old = !empty($bank->logo) ? substr($bank->logo, 7) : null;
        $bank_name = $bank->bank_name;

        $del = $bank->delete();
        if ($del) {
            if ($old !== null) {
                Storage::delete('public'.$old);
            }
            $return = ['success' => "Berhasil hapus bank $bank_name dari daftar bank"];
        } else {
            $return = ['error' => "Gagal menghapus bank $bank_name dari daftar bank"];
        }

        return response()->json($return);
    }
}
