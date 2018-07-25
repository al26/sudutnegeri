<div class="card">
    <div class="card-body">
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Email</span></div>
                <div class="form-group row mx-0">
                    <input type="text" readonly class="form-control-plaintext col-12" id="email" placeholder="Email" value="{{Auth::user()->email}}" name="data[email]">
                </div>    
            </div>
            @if (!empty(Auth::user()->password))
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Ubah Password</span></div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="old_pass">Password Lama</label>
                    <input type="text" class="form-control col-12 col-md-9" id="old_pass" placeholder="Password lama">
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="new_pass">Password Baru</label>
                    <input type="text" class="form-control col-12 col-md-9" id="new_pass" placeholder="Password baru">
                </div>
                <div class="form-group row mx-0">
                    <label class="fs-label col-12 col-md-3" for="confirm_pass">Konfirmasi Password</label>
                    <input type="text" class="form-control col-12 col-md-9" id="confirm_pass" placeholder="Ketik ulang password baru">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>    
            </div>
            @else
            <form method="POST" action="{{route('password.create')}}" id="form-account">
                @method('PUT')
                @csrf 
                <input type="hidden" value="{{Auth::user()->email}}" name="data[email]">
                <div class="form-section">
                    <div class="fs-head"><span class="fs-head-text">Buat Password</span></div>
                    <div class="form-group row mx-0">
                        <label class="fs-label col-12 col-md-3" for="new_pass">Password Baru</label>
                        <input type="password" class="form-control col-12 col-md-9" id="new_pass" placeholder="Password baru" name="data[new_pass]">
                    </div>
                    <div class="form-group row mx-0">
                        <label class="fs-label col-12 col-md-3" for="new_pass_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control col-12 col-md-9" id="new_pass_confirmation" placeholder="Ketik ulang password baru" name="data[new_pass_confirmation]">
                    </div>
                    <button type="submit" id="password-create" class="btn btn-primary">Buat Password</button>
                </div>
            </form>
            @endif
        
        <form>
            <div class="form-section">
                @php
                    $sns = array();
                    foreach (Auth::user()->socialAccounts as $key => $value) {
                        array_push($sns, $value->provider_name);
                    }
                @endphp
                <div class="fs-head"><span class="fs-head-text">Koneksi Akun Media Sosial</span></div>
                <small class="form-text text-muted mb-3">Hubungkan dengan akun media sosialmu untuk kemudahan login dengan sekali klik</small>                
                <ul id="user-connect" class="list-group list-group fa-ul">
                    <li class="list-group-item border-0 pb-3 pt-0"><span class="fa-li mt-1"><i class="fab fw fa-facebook-square" data-fa-transform="grow-20" style="color:#3b5998"></i></span>
                        @if (in_array("facebook", $sns))
                            <a class="btn btn-link decoration-none p-0" href="">Putuskan koneksi dengan Facebook</a>
                        @else
                            <a class="btn btn-link decoration-none p-0" href="{{route('oauth.connect', ['provider' => 'facebook'])}}">Hubungkan dengan akun Facebook</a>
                        @endif
                    </li>
                    <li class="list-group-item border-0"><span class="fa-li"><i class="fab fw fa-google-plus-square" data-fa-transform ="grow-20" style="color:#dd4b39"></i></span>
                        @if (in_array("google", $sns))
                            <a class="btn btn-link decoration-none p-0" href="">Putuskan koneksi dengan akun Google</a>
                        @else
                            <form action="{{route('oauth.login', ['provider' => 'google'])}}" method="GET" style="display:none;" id="g-connect">
                                @csrf
                                <input type="hidden" name="data[email]" value="{{Auth::user()->email}}">
                            </form>
                            <a class="btn btn-sm btn-link decoration-none" target="_blank" href="{{route('oauth.login', ['provider' => 'google'])}}">Hubungkan dengan akun google
                            </a>
                        @endif    
                    </li>
                </ul>
                
                {{-- <a href="{{ route('oauth.login', ['provider' => 'facebook']) }}" class="w-50 mb-2 btn btn-default btn-social fb {{in_array("facebook", $sns) ? 'disabled' : ''}}">
                    <i class="fab fa-facebook-f"></i>{{in_array("google", $sns) ? 'Terhubung' : 'Hubungkan'}} Dengan Akun Facebook
                    <span class="dis-overlay">Hilangkan Koneksi Dengan Akun Facebook</span>
                </a>
                <a href="{{ route('oauth.login', ['provider' => 'google']) }}" class="w-50 mb-2 btn btn-default btn-social g-plus {{in_array("google", $sns) ? 'disabled' : ''}}">
                    <i class="fab fa-google-plus-g"></i>{{in_array("google", $sns) ? 'Terhubung' : 'Hubungkan'}} Dengan Akun Google
                    <span class="dis-overlay">Hilangkan Koneksi Dengan Akun Google</span>
                </a>     --}}
            </div>
        </form>
    </div>
</div>