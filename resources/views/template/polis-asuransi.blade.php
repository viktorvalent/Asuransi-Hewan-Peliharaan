@extends('template.letter')
@push('template_css')
<style>
    * {
        font-family: 'Arial','Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', sans-serif';
    }
    body {
        padding: 0.5cm 1cm;
    }
</style>
@endpush

@section('template_body')
<table class="mb-4">
    <tr>
        <td>
            <img src="{{ asset('img/polis/logo.png') }}" style="width: 100px;" alt="">
        </td>
        <td class="text-center fw-bold ps-3" style="font-size: 50px;">
            Pet Insurance
        </td>
    </tr>
</table>
<table style="max-height: fit-content">
    <tr class="align-top">
        <td>Nomor Polis</td>
        <td>:</td>
        <td>00000001</td>
    </tr>
    <tr class="align-top">
        <td>Nama Pemilik</td>
        <td>:</td>
        <td>{{ $data->nama_pemilik }}</td>
    </tr>
    <tr class="align-top">
        <td>ID Member</td>
        <td>:</td>
        <td>{{ $data->member->id }}</td>
    </tr>
    <tr class="align-top">
        <td>Jenis Hewan (Ras)</td>
        <td>:</td>
        <td>{{ $data->ras_hewan->jenis_hewan->nama }} ({{ $data->ras_hewan->nama_ras }})</td>
    </tr>
    <tr class="align-top">
        <td>Nama Hewan yang diasuransikan</td>
        <td>:</td>
        <td>{{ $data->nama_hewan }}</td>
    </tr>
    <tr class="align-top">
        <td>Tanggal Lahir Hewan</td>
        <td>:</td>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d',$data->tgl_lahir_hewan)->format('d-m-Y') }}</td>
    </tr>
    <tr class="align-top">
        <td>Umur Hewan</td>
        <td>:</td>
        <td>{{ \Carbon\Carbon::parse($data->tgl_lahir_hewan)->age }} Tahun</td>
    </tr>
    <tr class="align-top" style="max-height: fit-content;">
        <td>Foto Hewan</td>
        <td>:</td>
        <td>
            <div style="width: 180px;height:90px;">
                <img src="{{ asset(Storage::url($data->foto)) }}" class="rounded w-100 h-auto"  alt="" style="object-fit: cover;object-position: center;">
            </div>
        </td>
    </tr>
    <tr>
        <td>Dengan ketentuan sebagai berikut :</td>
    </tr>
    <tr class="align-top">
        <td></td>
        <td>:</td>
        <td></td>
    </tr>
</table>


@endsection


@push('template_js')

@endpush
