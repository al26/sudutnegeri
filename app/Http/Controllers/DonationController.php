<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Donation;
use Validator;

class DonationController extends Controller
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
    public function create($projectId = null)
    {
        $data['project_id'] = $projectId;
        $data['banks'] = Bank::all();
        return view('member.partials.modal.create_donation', $data);
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
            "amount"    => "required|min:5",
            "bank_id"   => "required",
        ];

        $messages = [
            "amount.required"   => "Kolom :attribute tidak boleh kosong",
            // "amount.numeric"    => "Mohon isikan dengan jumlah yang valid (berupa angka)",
            "amount.min"        => "Isikan dengan minimal 10000 dan kelipatan ribuan",
            "bank_id.required"  => "Mohon pilih salah satu dari :attribute yang tersedia",
        ];

        $attributes = [
            "amount"    => "jumlah donasi",
            "bank_id"   => "metode pembayaran",
        ];

        $data = $request->data;
        
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $create = [
                "amount"     => $request->data['amount'],
                "bank_id"    => $request->data['bank_id'],
                "anonymouse" => $anonymouse,
                "status"     => "Pending"
            ];

            $store = Donation::create($data);
            if($store) {
                $return = ["success" => "Cerita proyek berhasil dibuat"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal membuat proyek baru."];
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
