@extends('layouts.dashboard.app')

@section('title', $title)

@push('css')
<link href="{{ asset('dashboard/css/jquery-datatable.css') }}" rel="stylesheet" />
@endpush

@section('container')
<div class="row">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#modal_create">
                <i class="align-middle" data-feather="plus"></i> Tambah Data
            </button>
        </div>
        <div class="card-body">
            <table id="datatable" class="table w-100 table-hover">
                <thead>
                    <tr>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th>Harga Hewan</th>
                        <th>Persen per Tahun</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="modal fade" id="modal_create" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="create">
                            <div class="mb-3">
                                <label class="form-label required">Nama Ras <i class="text-danger">*</i></label>
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama">
                                <small class="text-danger nama_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Jenis Hewan <i class="text-danger">*</i></label>
                                <select class="form-control form-control-sm choice jenis_hewan" name="jenis_hewan" id="jenis_hewan">
                                    <option value="">Pilih Jenis Hewan</option>
                                    @foreach ($jenis_hewans as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger jenis_hewan_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Harga Hewan <i class="text-danger">*</i></label>
                                <input id="harga_hewan" type="number" name="harga_hewan" class="form-control" placeholder="Harga Hewan">
                                <small class="text-danger harga_hewan_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Persen per tahun <i class="text-danger">*</i></label>
                                <input id="persen" type="number" name="persen" class="form-control" placeholder="Persen">
                                <small class="text-danger persen_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control deskripsi" name="deskripsi" placeholder="Deskripsi" rows="2"></textarea>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="reset" class="btn btn-secondary cancel" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary ms-2 create">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_edit" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="edit">
                            <div class="mb-3">
                                <label class="form-label required">Nama Ras <i class="text-danger">*</i></label>
                                <input type="hidden" name="edit_id" class="edit_id">
                                <input id="nama" type="text" name="edit_nama" class="form-control edit_nama" placeholder="Nama">
                                <small class="text-danger nama_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Jenis Hewan <i class="text-danger">*</i></label>
                                <div class="select_edit">
                                    <select class="form-control form-control-sm">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                                <small class="text-danger jenis_hewan_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Harga Hewan <i class="text-danger">*</i></label>
                                <input id="harga_hewan" type="number" name="edit_harga_hewan" class="form-control edit_harga_hewan" placeholder="Harga Hewan">
                                <small class="text-danger harga_hewan_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Persen per tahun <i class="text-danger">*</i></label>
                                <input id="persen" type="number" name="edit_persen" class="form-control edit_persen" placeholder="Persen">
                                <small class="text-danger persen_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control edit_deskripsi" name="edit_deskripsi" placeholder="Deskripsi" rows="2"></textarea>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="reset" class="btn btn-secondary cancel" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary ms-2 update">Kirim</button>
                            </div>
                        </form>
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
<script src="{{ asset('dashboard/libs/choice-js/js/app.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script>
    $(document).ready(function () {
        _table.set("{{ route('ras-hewan.data') }}",
            [
                {data: 'nama_ras', name: 'nama_ras'},
                {data: 'jenis_hewan_id.nama', name: 'jenis_hewan_id.nama'},
                {data: 'harga_hewan', name: 'harga_hewan'},
                {data: 'persen_per_umur', name: 'persen_per_umur'},
                {data: 'deskripsi', name: 'deskripsi'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ]
        );
        new Choices('.choice');
        _form.reset('.add','#create');

        $(document).on('click','.create',function (e) {
            e.preventDefault();
            let data = {
                'nama':$('#nama').val(),
                'jenis_hewan':$('#jenis_hewan option:selected').val(),
                'harga_hewan':$('#harga_hewan').val(),
                'persen':$('#persen').val(),
                'deskripsi':$('#deskripsi').val()
            }
            _input.loading.start(this);
            _ajax.post("{{ route('master-data.ras-hewan.create') }}",data,
                (response)=>{
                    _input.loading.stop('.create','Kirim');
                    if (response.status == 200) {
                        _swalert(response);
                        _table.reload();
                    }
                },
                (response)=>{
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

        $(document).on('click','.edit', function(e) {
            e.preventDefault()
            $('form#edit').trigger('reset');
            let id = $(this).data('id');
            _ajax.get(`{{ url('/auth/dashboard/master-ras-hewan/edit') }}/${id}`,
                (response) => {
                    $('#modal_edit').modal('show');
                    if (response.status == 200) {
                        $('.edit_id').val(response.data.id);$('.edit_nama').val(response.data.nama_ras);$('.edit_harga_hewan').val(response.data.harga_hewan);$('.edit_persen').val(response.data.persen_per_umur);$('.edit_deskripsi').val(response.data.deskripsi);let options = [];response.jeniss.forEach(e => {response.data.jenis_hewan_id==e.id?options.push(`<option value="${e.id}" selected>${e.nama}</option>`):options.push(`<option value="${e.id}">${e.nama}</option>`);});$('.select_edit').html(`<select class="form-control form-control-sm choice_edit edit_jenis_hewan bank" name="edit_jenis_hewan" id="jenis_hewan">${options.join('')}</select>`);new Choices('.choice_edit');
                    }
                },
                (response) => {
                    if (response.status == 422) {
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

        $(document).on('click','.update', function(e){
            e.preventDefault();
            let data = {
                'id':$('.edit_id').val(),
                'nama':$('.edit_nama').val(),
                'jenis_hewan':$('.edit_jenis_hewan option:selected').val(),
                'harga_hewan':$('.edit_harga_hewan').val(),
                'persen':$('.edit_persen').val(),
                'deskripsi':$('.edit_deskripsi').val()
            }
            _input.loading.start(this);
            _ajax.put(`{{ url('/auth/dashboard/master-ras-hewan/update') }}/${data.id}`,data,
                (response) => {
                    _input.loading.stop('.update','Kirim');
                    if (response.status == 200) {
                        _swalert(response);
                        _table.reload();
                    }
                },
                (response) => {
                    _input.loading.stop('.update','Kirim');
                    if (response.status == 400) {
                        _validation.action(response.responseJSON);
                    } else if (response.status == 404) {
                        _swalert(response);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            );
        });

        $(document).on('click','.delete', function(e){
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Apa Anda Yakin ?',
                text: "Anda tidak akan dapat mengembalikan data ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, Hapus data ini !',
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    _ajax.get(`{{ url('/auth/dashboard/master-ras-hewan/delete') }}/${id}`,
                        (response)=>{
                            if (response.status == 200) {
                                Swal.fire({
                                    title: 'Data terhapus!',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                _table.reload();
                            }
                        },
                        (response)=>{
                            Swal.fire({
                                title: 'Data tidak terhapus!',
                                icon: 'info',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    );
                }
            });
        })

    });
</script>
@endpush
