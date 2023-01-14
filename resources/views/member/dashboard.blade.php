@extends('layouts.landing.app')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" />
@endpush

@section('content')
<section id="member-dashboard">
    <div class="container">
        @if (!auth()->user()->member)
            <div class="row">
                <div class="col-sm-1 col-md-2"></div>
                <div class="col-sm-10 col-md-8 col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Peringatan!</strong> Lengkapi dulu data anda sebelum melakukan pembelian asuransi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h4 class="text-center">Silahkan isi dengan benar.</h4>
                        </div>
                        <div class="card-body mx-2">
                            <form action="">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama">
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Nomor KTP (NIK) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nik" placeholder="Nomor KTP (NIK)">
                                </div>
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nohp" placeholder="Nomor HP">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Alamat"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="bank" class="form-label">Bank <span class="text-danger">*</span></label>
                                    <select class="form-select bank" aria-label="Default select example" name="bank">
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="rek" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="rek" placeholder="Nomor Rekening">
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="tnc" value="1" id="tnc">
                                    <label class="form-check-label" for="tnc" style="font-size: .8em;">
                                        Dengan ini saya menyetujui <a href="#" class="fw-bold text-dark">Term & Conditions.</a>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-center py-3">
                                    <button type="submit" class="btn btn-primary shadow create" style="width: 150px;">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-md-2"></div>
            </div>
        @else
            nt
        @endif
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click','.create', function (e) {
            e.preventDefault();
            alert('ok');
        });
    });
</script>
@endpush
