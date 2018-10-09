<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Validator;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
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
    public function create()
    {
        return view('admin.partials.modal.category-create');
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
            'category' => 'required',
        ];

        $messages = [
            'category.required' => 'Nama kategori tidak boleh kosong'
        ];

        $attribute = [
            'category' => 'nama kategori'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attribute);

        if ($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            $data['category'] = $request->category;
            $data['slug'] = str_slug($request->category);
            $store = Category::create($data);

            if($store) {
                $return = ['success' => 'Kategori baru berhasil ditambahkan'];
            } else {
                $return = ['error' => 'Gagal menambah kategori baru.'];
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
        $data['name'] = Category::where('id', decrypt($id))->pluck('category')[0];
        return view('admin.partials.modal.category-edit', $data);
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
            'category' => 'required',
        ];

        $messages = [
            'category.required' => 'Nama kategori tidak boleh kosong'
        ];

        $attribute = [
            'category' => 'nama kategori'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attribute);

        if ($validator->fails()) {
            $return = ['errors' => $validator->errors()];
        } else {
            $data['category'] = $request->category;
            $data['slug'] = str_slug($request->category);
            $update = Category::find(decrypt($id))->update($data);

            if($update) {
                $return = ['success' => 'Kategori berhasil diubah'];
            } else {
                $return = ['error' => 'Gagal mengubah kategori.'];
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
        $del = Category::findOrFail(decrypt($id))->delete();

        if($del) {
            $return = ['success' => 'Berhasil hapus kategori'];
        } else {
            $return = ['error' => 'Gagal hapus kategori'];
        }

        return response()->json($return);
    }
}
