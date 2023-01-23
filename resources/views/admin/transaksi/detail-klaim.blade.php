@extends('layouts.dashboard.app')

@section('title', $title)

@push('css')
<link href="{{ asset('dashboard/css/jquery-datatable.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('dashboard/css/zooming.css') }}">
@endpush

@section('container')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3 p-1 rounded">
                            <div class="fs-5 text-muted mb-2">Tanggal Klaim</div>
                            <input class="klaim_id" type="hidden" name="klaim_id" value="{{ $data->id }}">
                            <div class="fs-4 fw-bold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_klaim, 'Asia/Jakarta')->format('d-m-Y') }}</div>
                        </div>
                        <div class="col-md-3 p-1 rounded">
                            <div class="fs-5 text-muted mb-2">Member</div>
                            <div class="fs-4 fw-bold">{{ $data->member->nama_lengkap }}</div>
                        </div>
                        <div class="col-md-3 p-1 rounded">
                            <div class="fs-5 text-muted mb-2">Nomor Polis</div>
                            <input type="hidden" name="polis_id" class="polis_id" value="{{ $data->polis->id }}">
                            <div class="fs-4 fw-bold">{{ $data->polis->nomor_polis }}</div>
                        </div>
                        <div class="col-md-3 p-1 rounded">
                            <div class="fs-5 text-muted mb-2">Status Klaim</div>
                            <div class="fs-4">
                                @if ($data->status_set->id==1)
                                    <span class="badge text-bg-light shadow-sm">{{ $data->status_set->status }}</span>
                                @elseif ($data->status_set->id==2)
                                    <span class="badge text-bg-danger text-white shadow-sm">{{ $data->status_set->status }}</span>
                                @elseif ($data->status_set->id==3)
                                    <span class="badge text-bg-success text-white shadow-sm">{{ $data->status_set->status }}</span>
                                @else
                                    <span class="badge text-bg-warning shadow-sm">{{ $data->status_set->status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="mb-4">Data Klaim Asuransi</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex mb-3 justify-content-between pb-2">
                        <div class="col-md-6">
                            <div class="fw-bold">Keterangan Klaim</div>
                        </div>
                        <div class="col-md-6 text-end">
                            {{ $data->keterangan_klaim }}
                        </div>
                    </div>
                    <div class="my-3 fs-4">
                        Rincian Biaya :
                    </div>
                    <div class="d-flex mb-3 justify-content-between border-bottom pb-2">
                        <div class="col-md-6">
                            <div class="fw-bold">Nominal Pembayaran Rumah Sakit</div>
                        </div>
                        <div class="col-md-6 text-end">
                            Rp{{ number_format($data->nominal_bayar_rs,0,'','.') }}
                        </div>
                    </div>
                    <div class="d-flex mb-3 justify-content-between border-bottom pb-2">
                        <div class="col-md-6">
                            <div class="fw-bold">Nominal Pembayaran Resep Obat</div>
                        </div>
                        <div class="col-md-6 text-end">
                            Rp{{ number_format($data->nominal_bayar_obat,0,'','.') }}
                        </div>
                    </div>
                    <div class="d-flex mb-3 justify-content-between border-bottom pb-2">
                        <div class="col-md-6">
                            <div class="fw-bold">Nominal Pembayaran Diagnosa Dokter</div>
                        </div>
                        <div class="col-md-6 text-end">
                            Rp{{ number_format($data->nominal_bayar_dokter,0,'','.') }}
                        </div>
                    </div>
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="col-md-6">
                            <div class="fw-bold">Total Nominal Klaim</div>
                        </div>
                        <div class="col-md-6 text-end fw-bold text-success">
                            Rp{{ number_format(($data->nominal_bayar_rs+$data->nominal_bayar_obat+$data->nominal_bayar_dokter),0,'','.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="fw-bold mb-3">Bukti Bayar Rumah Sakit</div>
                    <img src="{{ asset(Storage::url($data->foto_bukti_bayar)) }}" class="w-100 img-zoomable" alt="Bukti Bayar Rumah Sakit">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="fw-bold mb-3">Bukti Bayar Resep Obat</div>
                    <img src="{{ asset(Storage::url($data->foto_resep_obat)) }}" class="w-100 img-zoomable" alt="Bukti Bayar Resep Obat">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="fw-bold mb-3">Bukti Bayar Diagnosa Dokter</div>
                    <img src="{{ asset(Storage::url($data->foto_diagnosa_dokter)) }}" class="w-100 img-zoomable" alt="Bukti Bayar Diagnosa Dokter">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                @if ($data->status_klaim==3)
                <button class="btn btn-success me-2" style="width: 300px;height: 35px;" @disabled(true)><i class="bi bi-check2-square"></i> Terima & Buat Nota Klaim</button>
                <button class="btn btn-danger" style="width: 300px;height: 35px;" @disabled(true)><i class="bi bi-x-circle"></i> Tolak & Butuh Revisi</button>
                @elseif ($data->status_klaim==2)
                <button class="btn btn-success me-2" style="width: 300px;height: 35px;" @disabled(true)><i class="bi bi-check2-square"></i> Terima & Buat Nota Klaim</button>
                <button class="btn btn-danger" style="width: 300px;height: 35px;" @disabled(true)><i class="bi bi-x-circle"></i> Tolak & Butuh Revisi</button>
                @else
                    <button class="btn btn-success me-2 accept" style="width: 300px;height: 35px;"><i class="bi bi-check2-square"></i> Terima & Buat Nota Klaim</button>
                    <button class="btn btn-danger" style="width: 300px;height: 35px;" data-bs-toggle="modal" data-bs-target="#modal_create"><i class="bi bi-x-circle"></i> Tolak & Butuh Revisi</button>
                @endif
                <a href="{{ URL::route('test.pdf', $data->id) }}" class="btn btn-secondary ms-2" style="width: 200px;height: 35px;"><i class="bi bi-check2-square"></i> Test PDF</a>
            </div>
            <div class="modal fade" id="modal_create" tabindex="-1" aria-modal="true" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tolak Klaim Asuransi</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mx-3">
                            <form id="create">
                                <div class="mb-3">
                                    <label class="form-label">Alasan menolak</label>
                                    <textarea id="alasan" class="form-control alasan" name="alasan" placeholder="Alasan menolak" rows="3"></textarea>
                                    <small class="text-danger alasan_error"></small>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="reset" class="btn btn-secondary cancel" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary ms-2 create">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script src="{{ asset('dashboard/js/jquery-datatable.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script src="{{ asset('dashboard/js/zooming.js') }}"></script>
<script>
    $(document).ready(function () {
        new Zooming().listen('.img-zoomable');
        $(document).on('click','.create', function(e){
            e.preventDefault();
            let data = {
                'id': $('.klaim_id').val(),
                'alasan':$('#alasan').val()
            }
            _input.loading.start(this);
            _ajax.post("{{ route('klaim.reject') }}",data,
                (response) => {
                    _input.loading.stop('.create','Kirim');
                    if (response.status == 200) {
                        _swalert(response);
                        setTimeout(() => {
                            location.href="{{ route('klaim') }}";
                        }, 1500);
                    }
                },
                (response) => {
                    _input.loading.stop('.create','Kirim');
                    if (response.status == 400) {
                        _validation.action(response.responseJSON)
                    } else if (response.status == 404) {
                        _swalert(response);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            );

        })

        $(document).on('click','.accept', function(e){
            e.preventDefault();
            let data = {
                'id': $('.klaim_id').val(),
            }
            _input.loading.start(this);
            _ajax.post("{{ route('klaim.confirm') }}",data,
                (response) => {
                    _input.loading.stop('.accept','<i class="bi bi-check2-square"></i> Terima & Buat Nota Klaim');
                    if (response.status == 200) {
                        _swalert(response);
                        setTimeout(() => {
                            location.href="{{ route('klaim') }}";
                        }, 1500);
                    }
                },
                (response) => {
                    _input.loading.stop('.accept','<i class="bi bi-check2-square"></i> Terima & Buat Nota Klaim');
                    if (response.status == 400) {
                        _validation.action(response.responseJSON)
                    } else if (response.status == 404) {
                        _swalert(response);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            );
        })

    });
</script>
@endpush
