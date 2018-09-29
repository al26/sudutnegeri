@php
    $total = $investments->sum('amount');
    $total += $investments->sum('payment_code');
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Investasi Saya</h4>
    </div>
    <div class="card-body">
        <div class="row section-content">
            <div class="col-12 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">{{Idnme::print_rupiah($total)}}</h3>
                        <p class="text-secondary">Total Investasi</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-section mt-3">
            <div class="fs-head"><span class="fs-head-text">Investasi Saya</span></div>
        </div>
        <div class="row section-content">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Proyek</th>
                            <th>Jumlah Investasi</th>
                            <th>Tanggal Investasi</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investments as $i)
                            @php
                                switch ($i->status) {
                                    case 'being verified':
                                        $badge = 'warning';
                                        break;
                                    case 'verified':
                                        $badge = 'success';
                                        break;
                                    default:
                                        $badge = 'danger';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{$i->project->project_name}}</td>
                                <td>{{Idnme::print_rupiah($i->amount + $i->payment_code)}}</td>
                                <td>{{Idnme::print_date($i->created_at, true)}}</td>
                                <td><span class="badge badge-{{$badge}}">{{$i->status}}</span></td>
                                <td>
                                    @if(empty($i->transfer_receipt))
                                        <a class="btn btn-sm btn-primary" data-toggle="pjax" data-pjax="main-content" href="{{route('donation.upreceipt', ['id' => $i->id])}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-cloud-upload-alt"></i> Upload Bukti Transfer</a>
                                    @else
                                        <a href="{{URL::to('/').'/'.$i->transfer_receipt}}" class="btn btn-sm btn-link" target="_blank"> Lihat Bukti Transfer</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>