<div class="row">
    <div class="col-md-1 col-sm-0"></div>
    <div class="col-md-10 col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center border-bottom pb-3 mb-3">Daftar Asuransi Yang Digunakan</a></h5>
                @if ($member!=null && count($member->pembelian_produk)<1)
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Pemberitahuan!</strong> Anda belum melakukan pembelian asuransi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @else
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-1 col-sm-0"></div>
</div>

