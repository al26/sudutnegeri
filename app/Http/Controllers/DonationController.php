<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Donation;
use App\Project;
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
    public function create($slug)
    {
        $data['project'] = Project::where('project_slug', $slug)->first();
        $data['banks'] = Bank::all();
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
            "amount"    => "required|min:5",
            "bank_id"   => "required",
            // "phone_number" => "required"
        ];

        $messages = [
            "amount.required"   => "Kolom :attribute tidak boleh kosong",
            // "phone_number.required"   => "Kolom :attribute tidak boleh kosong",
            // "amount.numeric"    => "Mohon isikan dengan jumlah yang valid (berupa angka)",
            "amount.min"        => "Isikan dengan minimal 10000 dan kelipatan ribuan",
            "bank_id.required"  => "Mohon pilih salah satu dari :attribute yang tersedia",
        ];

        $attributes = [
            "amount"    => "jumlah donasi",
            "bank_id"   => "metode pembayaran",
            // "phone_number" => "nomor hp"
        ];

        $data = $request->data;
        
        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = redirect()->back()->withErrors($validator)->withInput();
        } else {
            $anonymouse = !empty($request->data['anonymouse']) ? 'yes' : 'no';
            $project_id = Project::where('project_slug', $request->data['project_slug'])->pluck('id')[0];
            $create = [
                "user_id"    => $request->data['user_id'],
                "project_id" => $project_id,
                "amount"     => $request->data['amount'],
                "bank_id"    => $request->data['bank_id'],
                "anonymouse" => $anonymouse,
                "payment_code" => rand(10,999),
                "status"     => "Pending"
            ];

            $store = Donation::create($create);
            if($store) {
                $pid = Project::where('project_slug', $request->data['project_slug'])->pluck('id')[0];
                $progress = [
                    "funding_progress" => Donation::where('project_id', $pid)->sum('amount')
                ];
                
                Project::where('project_slug', $request->data['project_slug'])->update($progress);

                $return = redirect()->route('donation.invoice', ['slug' => $request->data['project_slug']]);
            } else {
                $return = redirect()->back()->with('error', 'Terjadi kesalahan. Silahkan coba lagi')->withInput();
            }
        }
        
        return $return;
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

    public function invoice(Request $request, $slug) {
        $project_id = Project::where('project_slug', $slug)->pluck('id')[0];
        $where = [
            "user_id" => $request->user()->id,
            "project_id" => $project_id
        ];
        $data['donation'] = Donation::where($where)->orderBy('id', 'desc')->first();

        // dd($data);
        return view('member.invoice', $data);
    }
}
