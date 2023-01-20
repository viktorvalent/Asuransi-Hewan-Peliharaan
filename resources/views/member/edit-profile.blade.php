@extends('member.dashboard')

@section('member')
<div class="row">
    <div class="col-sm-1 col-md-2"></div>
    <div class="col-sm-10 col-md-8 col-12">
        <div class="card shadow" style="opacity: 0.955 !important;">
            <div class="card-header py-3">
                <h4 class="text-center">Edit profile member</h4>
            </div>
            <div class="card-body mx-2">
                <form action="">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="hidden" name=member_id" class="member_id" value="{{ $data->id }}">
                        <input type="text" class="form-control" id="nama" placeholder="Nama" value="{{ $data->nama_lengkap }}">
                        <small class="text-danger nama_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nomor KTP (NIK) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="nik" placeholder="Nomor KTP (NIK)" value="{{ $data->no_ktp }}">
                        <small class="text-danger nik_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nohp" placeholder="Nomor HP" value="{{ $data->no_hp }}">
                        <small class="text-danger nohp_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Alamat">{{ $data->alamat }}</textarea>
                        <small class="text-danger alamat_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="bank" class="form-label">Bank <span class="text-danger">*</span></label>
                        <select class="form-select bank" aria-label="Default select example" name="bank" id="bank">
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}" {{ $data->bank_id==$bank->id?'selected':'' }}>{{ $bank->nama }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger bank_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="rek" class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rek" placeholder="Nomor Rekening" value="{{ $data->no_rekening }}">
                        <small class="text-danger rek_error"></small>
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
@endsection

@push('member_js')
<script src="{{ asset('dashboard/js/jquery.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script>
    $(document).ready(function () {

        $(document).on('click','.create', function (e) {
            e.preventDefault();
            let data = {
                member_id:$('.member_id').val(),
                nama: $('#nama').val(),
                nik: $('#nik').val(),
                nohp: $('#nohp').val(),
                alamat: $('#alamat').val(),
                bank: $('#bank').val(),
                rek: $('#rek').val(),
            }
            _input.loading.start(this);
            _ajax.post("{{ route('member.update') }}",data,
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
