@extends('member.dashboard')

@section('member')
<div class="row">
    <div class="col-md-1 col-sm-0"></div>
    <div class="col-md-10 col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center border-bottom pb-3 mb-3">Daftar Asuransi Yang Digunakan</a></h5>
                @if ($member!=null && count($member->pembelian_produk)<1)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Pemberitahuan!</strong> Anda belum melakukan pembelian asuransi.
                </div>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="bi bi-cart3 fs-5"></i> Paket Asuransi</a>
                </div>
                @else
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-1 col-sm-0"></div>
</div>
@endsection

@push('member_js')

@endpush
