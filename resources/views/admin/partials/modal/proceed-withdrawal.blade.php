<div class="row">
    <div class="col-12 col-lg-12 mb-3">
        <p class="mb-2 text-center">Pencairan Dana Proyek</p>
        <h4 class="mb-0 text-center">{{$withdrawal->project->project_name}}</h4>
    </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="container mt-3">
            <div class="justify-content-center">
                <div class="form-group">
                    <label for="">Silahkan Transfer Sesuai Ketentuan Berikut</label>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Penerima</h5></th>
                                <td class="">{{$withdrawal->account_name}}</td>
                            </tr>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Rek. Penerima</h5></th>
                                <td class="">{{$withdrawal->account_number}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nominal Tranfer</th>
                                <td class="">{{Idnme::print_rupiah($withdrawal->amount,false,true)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Bank</th>
                                <td class="">{{$withdrawal->bank->bank_code}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Bank</th>
                                <td>
                                    <img class="align-self-center ml-auto" src="{{secure_asset($withdrawal->bank->logo)}}" height="50" alt="Logo {{$withdrawal->bank->bank_name}}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{route('withdrawal.proceed', ['id' => encrypt($withdrawal->id)])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Unggah Bukti Transfer Pencairan Dana Proyek</label>
                    </div>
                    <div class="row mb-3 text-center">
                        <div class="col-12">
                            <img id="proceed-withdrawal-preview-default" alt="preview" class="img-fluid img-thumbnail" src="{{secure_asset('storage/profile_pictures/no_image_placeholder.png')}}">
                            <img id="proceed-withdrawal-preview" alt="preview" class="img-fluid img-thumbnail" src="{{secure_asset('storage/profile_pictures/no_image_placeholder.png')}}" style="display:none;">
                            <img id="proceed-withdrawal-loader" src="{{secure_asset('storage/loader/spinner.gif')}}" alt="loader" class="img-fluid"  style="display:none">
                        </div>
                    </div>
                    
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="receipt" name="receipt" onchange="javascript:previewImgUpload(this, '#proceed-withdrawal-preview-default', '#proceed-withdrawal-loader', '#proceed-withdrawal-preview', '#proceed-withdrawal-label');">
                        <label class="custom-file-label" for="receipt" id="proceed-withdrawal-label">Pilih File</label>
                    </div>
                </form>
    
            </div>
        </div>
    </div>
</div>
      