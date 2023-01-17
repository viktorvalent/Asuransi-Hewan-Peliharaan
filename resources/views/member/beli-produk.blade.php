@extends('member.dashboard')

@section('member')
<div class="row">
    <div class="col-sm-1 col-md-2"></div>
    <div class="col-sm-10 col-md-8 col-12">
        <div class="card shadow" style="opacity: 0.955 !important;">
            <div class="card-header py-3">
                <h4 class="text-center">Silahkan isi form dengan benar.</h4>
            </div>
            <div class="card-body mx-2">
                <form action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="produk" class="form-label">Produk Asuransi <span class="text-danger">*</span></label>
                        <select class="form-select produk" aria-label="Default select example" name="produk" id="produk">
                            <option value="">Pilih Produk</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger produk_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                        <select class="form-select jenis" aria-label="Default select example" name="jenis" id="jenis">
                            <option value="0">Pilih Jenis Hewan</option>
                            @foreach ($jeniss as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger bank_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="ras" class="form-label">Ras Hewan <span class="text-danger">*</span></label>
                        <div class="ras_select">
                            <select class="form-select ras" aria-label="Default select example" name="ras" id="ras" disabled style="cursor: no-drop">
                                <option value="">Pilih Ras</option>
                            </select>
                        </div>
                        <small class="text-danger bank_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="nama_hewan" class="form-label">Nama Hewan Peliharaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_hewan" placeholder="Nama Hewan">
                        <small class="text-danger nama_hewan_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pemilik" class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pemilik" placeholder="Nama Pemilik">
                        <small class="text-danger nama_pemilik_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Hewan <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="foto" name="foto">
                        <small class="text-danger nama_pemilik_error"></small>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin Hewan <span class="text-danger">*</span></label>
                        <select class="form-select gender" aria-label="Default select example" name="gender" id="gender">
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>
                        <small class="text-danger gender_error"></small>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="">
                                <label for="tgl_lahir_hewan" class="form-label">Tanggal Lahir Hewan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tgl_lahir_hewan" placeholder="Tanggal Lahir">
                                <small class="text-danger tgl_lahir_hewan_error"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label for="berat_badan" class="form-label">Bobot Hewan (Kg) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="berat_badan" placeholder="Berat">
                                <small class="text-danger berat_badan_error"></small>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="Alamat"></textarea>
                        <small class="text-danger alamat_error"></small>
                    </div> --}}

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
        $(document).on('change','#jenis',function(e){
            e.preventDefault()
            let id = $(this).val();

            if (id==0) {
                $('#ras').attr('disabled','disabled');
                $('#ras').css('cursor', 'no-drop');
            } else {
                _ajax.get("{{ url('/pembelian/getRas') }}/"+id,
                    (response) => {
                        if (response.status == 200) {
                            let option = [];

                            response.ras.map(e => {
                                option.push(`<option value='${e.id}'>${e.nama_ras}</option>`);
                            })
                            $('.ras_select').html(`<select class="form-select ras" aria-label="Default select example" name="ras" id="ras">
                                <option value="">Pilih Ras</option>
                                ${option.join('')}
                            </select>`);
                        }
                    },
                    (response) => {
                        if (response.status == 404) {

                        }
                    }
                );
            }
        })
    });
</script>
@endpush
