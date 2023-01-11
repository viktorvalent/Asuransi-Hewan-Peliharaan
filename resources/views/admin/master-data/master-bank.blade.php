@extends('layouts.dashboard.app')

@section('title', $title)

@push('css')
<link href="{{ asset('dashboard/css/jquery-datatable.css') }}" rel="stylesheet" />
@endpush

@section('container')
<div class="row">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#modal-create">
                <i class="align-middle" data-feather="plus"></i> Tambah Data
            </button>
        </div>
        <div class="card-body">
            <table id="datatable" class="table w-100 table-hover table-responsive">
                <thead>
                    <th>Nama</th>
                    <th>Logo</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="modal fade" id="modal-create" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="create" action="{{ route('master-data.bank.create') }}" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label required">Nama Bank <i class="text-danger">*</i></label>
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Bank">
                                <small class="text-danger nama_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label w-100">Logo Bank <i class="text-danger">*</i></label>
                                <input id="logo" name="logo" class="form-control" type="file">
                                <small class="text-danger logo_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Textarea" rows="2"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary create">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data {{ $title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="create" action="{{ route('master-data.bank.create') }}" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label required">Nama Bank <i class="text-danger">*</i></label>
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama Bank">
                                <small class="text-danger nama_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label w-100">Logo Bank <i class="text-danger">*</i></label>
                                <input id="logo" name="logo" class="form-control" type="file">
                                <small class="text-danger logo_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Textarea" rows="2"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary create">Kirim</button>
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
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script>
    _table.set("{{ route('master-bank.data') }}",
        [
            {data: 'nama', name: 'nama'},
            {data: 'logo', name: 'logo'},
            {data: 'deskripsi', name: 'deskripsi'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            },
        ]
    );

    _form.reset('.add','#create');

    $('.create').click(function (e) {
        e.preventDefault();
        var files = $('#logo')[0].files;
        let data = new FormData();
        data.append('logo',files[0]);
        data.append('nama',$('#nama').val());
        data.append('deskripsi',$('#deskripsi').val());
        $('#logo').val('');
        _ajax.postWithFile("{{ route('master-data.bank.create') }}",data,
            (response)=>{
                if (response.status == 200) {
                    _swalert(response);
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            },
            (response)=>{
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
        )
    });

    $('#datatable_paginate').parent().parent().addClass('mt-3');
</script>
@endpush
