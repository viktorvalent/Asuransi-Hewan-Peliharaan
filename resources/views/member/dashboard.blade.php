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
                                    <input type="hidden" name="user_id" class="user_id" value="{{ auth()->user()->id }}">
                                    <input type="text" class="form-control" id="nama" placeholder="Nama">
                                    <small class="text-danger nama_error"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">Nomor KTP (NIK) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nik" placeholder="Nomor KTP (NIK)">
                                    <small class="text-danger nik_error"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="nohp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nohp" placeholder="Nomor HP">
                                    <small class="text-danger nohp_error"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Alamat"></textarea>
                                    <small class="text-danger alamat_error"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="bank" class="form-label">Bank <span class="text-danger">*</span></label>
                                    <select class="form-select bank" aria-label="Default select example" name="bank" id="bank">
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->nama }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger bank_error"></small>
                                </div>
                                <div class="mb-3">
                                    <label for="rek" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="rek" placeholder="Nomor Rekening">
                                    <small class="text-danger rek_error"></small>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="tnc" value="1" id="tnc">
                                    <label class="form-check-label" for="tnc" style="font-size: .8em;">
                                        Dengan ini saya menyetujui <a href="#" class="fw-bold text-dark">Term & Conditions.</a>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-center py-3">
                                    <button type="submit" class="btn btn-primary shadow create" style="width: 150px;" disabled="disabled">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-md-2"></div>
            </div>
        @else
            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profil</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Asuransi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">@include('member.profile')</div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">@include('member.asuransi')</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#tnc').on('change', function () {
            $(this).prop('checked')?$('.create').removeAttr('disabled'):$('.create').attr('disabled','disabled');
        });

        $(document).on('click','.create', function (e) {
            e.preventDefault();
            let data = {
                user_id:$('.user_id').val(),
                nama: $('#nama').val(),
                nik: $('#nik').val(),
                nohp: $('#nohp').val(),
                alamat: $('#alamat').val(),
                bank: $('#bank').val(),
                rek: $('#rek').val(),
            }
            _input.loading.start(this);
            _ajax.post("{{ route('member.create') }}",data,
                (response) => {
                    _input.loading.stop('.create','Kirim');
                    if (response.status == 200) {
                        _swalert(response);
                        setTimeout(() => {
                            window.location.href="{{ route('member.dashboard') }}";
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
        });
    });
</script>
@endpush
