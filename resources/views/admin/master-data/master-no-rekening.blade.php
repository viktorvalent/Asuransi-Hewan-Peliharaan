@extends('layouts.dashboard.app')

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
            <table id="datatable" class="table w-100">
                <thead>
                    <th>Bank</th>
                    <th>Nomor Rekening</th>
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
                                <label class="form-label required">Bank <i class="text-danger">*</i></label>
                                {{-- <select class="form-control mb-3 select2" name="bank_id">
                                    <option value="">Pilih Bank</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select> --}}
                                <select class="form-control form-control-sm choice" name="bank_id" id="bank_id">
                                    <option value="">Pilih Bank</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger nama_error"></small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Nomor Rekening <i class="text-danger">*</i></label>
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Masukkan nomor rekening">
                                <small class="text-danger nama_error"></small>
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
<script src="{{ asset('dashboard/libs/choice-js/js/app.js') }}"></script>
<script src="{{ asset('dashboard/js/support.js') }}"></script>
<script src="{{ asset('dashboard/libs/sweetalert/app.js') }}"></script>
<script>
    $(document).ready(function () {
        _table.set("{{ route('no-rek.data') }}",
            [
                {data: 'master_bank.nama', name: 'master_bank.nama'},
                {data: 'nomor_rekening', name: 'nomor_rekening'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ]
        );
        const choices = new Choices('.choice');

        $('.create').click(function (e) {
            e.preventDefault();
            console.log($('#bank_id').val());
        });
    });
</script>
@endpush
