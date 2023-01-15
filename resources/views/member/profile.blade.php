<div class="row">
    <div class="col-md-2 col-sm-0"></div>
    <div class="col-md-8 col-sm-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center border-bottom pb-3 mb-3">Member Profile <a class="btn btn-sm btn-warning" href="javascript:void(0)" role="button"><i class="bi bi-pencil"></i></a></h5>
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="d-flex justify-content-between  px-2">
                            <div class="fw-bold">
                                Nama
                            </div>
                            <div class="">
                                {{ $member->nama_lengkap }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="d-flex justify-content-between px-2">
                            <div class="fw-bold">
                                No. KTP (NIK)
                            </div>
                            <div class="">
                                {{ $member->no_ktp }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="d-flex justify-content-between px-2">
                            <div class="fw-bold">
                                Nomor HP
                            </div>
                            <div class="">
                                {{ $member->no_hp }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="d-flex justify-content-between px-2">
                            <div class="fw-bold">
                                Alamat
                            </div>
                            <div class="">
                                {{ $member->alamat }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-sm-0"></div>
</div>
