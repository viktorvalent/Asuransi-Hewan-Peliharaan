@extends('layouts.dashboard.app')

@section('title', 'Tambah '.$title)

@push('css')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
<style>
    button.trix-button.trix-button--icon.trix-button--icon-attach,
    span.trix-button-group.trix-button-group--file-tools {
        display: none !important;
        visibility: hidden !important;
    }
</style>
@endpush

@section('container')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 col-sm-1"></div>
                <div class="col-md-8 col-sm-10">
                    <form>
                        <h5>Produk</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" id="nama_produk" placeholder="Nama">
                                    <small class="text-danger nama_error"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Kelas Kamar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kelas_kamar" placeholder="Kelas Kamar">
                                    <small class="text-danger kelas_kamar_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Limit Kamar <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="limit_kamar" placeholder="Limit Kamar">
                                    <small class="text-danger limit_kamar_error"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Limit Obat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="limit_obat" placeholder="Limit obat">
                                    <small class="text-danger limit_obat_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Satuan Limit Kamar <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="satuan_limit_kamar" placeholder="Satuan">
                                    <small class="text-danger satuan_limit_kamar_error"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Satuan Limit Obat <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="satuan_limit_obat" placeholder="Satuan">
                                    <small class="text-danger satuan_limit_obat_error"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Satuan Limit Dokter <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="satuan_limit_dokter" placeholder="Satuan">
                                    <small class="text-danger satuan_limit_dokter_error"></small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Benefit</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Nilai Pertanggungan Minimal <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nilai_pertanggungan_min" name="nilai_pertanggungan_min" placeholder="Rp.">
                                    <small class="text-danger nilai_pertanggungan_min_error"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Nilai Pertanggungan Maksimal <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nilai_pertanggungan_max" name="nilai_pertanggungan_max" placeholder="Rp.">
                                    <small class="text-danger nilai_pertanggungan_max_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Santunan Mati Kecelakaan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="santunan_mati_kecelakaan" name="santunan_mati_kecelakaan" placeholder="Rp.">
                                    <small class="text-danger santunan_mati_kecelakaan_error"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Santunan untuk Kecurian <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="santunan_kecurian" name="santunan_kecurian" placeholder="%">
                                    <small class="text-danger santunan_kecurian_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Tanggung jawab hukum pihak ketiga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="tanggung_jawab_hukum" name="tanggung_jawab_hukum" placeholder="Rp.">
                                    <small class="text-danger tanggung_jawab_hukum_error"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Maksimal Santunan Kremasi <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="santunan_kremasi" placeholder="Rp.">
                                    <small class="text-danger santunan_kremasi_error"></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Maksimal Santunan Rawat Inap <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="santunan_rawat_inap" placeholder="Rp.">
                                    <small class="text-danger santunan_rawat_inap_error"></small>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary create">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 col-sm-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click','.create', function(e) {
            e.preventDefault();
            let data = {
                'nama_produk':$('#nama_produk').val(),
                'kelas_kamar':$('#kelas_kamar').val(),
                'limit_kamar':$('#limit_kamar').val(),
                'limit_obat':$('#limit_obat').val(),
                'satuan_limit_kamar':$('#satuan_limit_kamar').val(),
                'satuan_limit_obat':$('#satuan_limit_obat').val(),
                'satuan_limit_dokter':$('#satuan_limit_dokter').val(),
                'nilai_pertanggungan_min':$('#nilai_pertanggungan_min').val(),
                'nilai_pertanggungan_max':$('#nilai_pertanggungan_max').val(),
                'santunan_mati_kecelakaan':$('#santunan_mati_kecelakaan').val(),
                'santunan_kecurian':$('#santunan_kecurian').val(),
                'tanggung_jawab_hukum':$('#tanggung_jawab_hukum').val(),
                'santunan_kremasi':$('#santunan_kremasi').val(),
                'santunan_rawat_inap':$('#santunan_rawat_inap').val(),
            }
            console.log(data);
            _input.loading.start(this);
            _ajax.post("{{ route('master-data.produk-asuransi.create') }}",data,
                (response)=>{
                    _input.loading.stop('.create','Kirim');
                    if (response.status == 200) {
                        _swalert(response);
                        setTimeout(() => {
                            window.location.href="{{ route('master-data.produk-asuransi') }}";
                        }, 2000);
                    }
                },
                (response)=>{
                    _input.loading.stop('.create','Kirim');
                    if (response.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.responseJSON.error.isi[0],
                            showConfirmButton: false,
                            timer: 1500
                        })
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
