@extends('template.letter')
@push('template_css')
<style>
    * {
        font-family: 'Times New Roman', Times, serif;
        font-size: 15px;
    }
    body {
        padding: 0.5cm 1cm;
    }
    td {
        font-size: 14px;
    }
    tr td:first-child {
        text-align: left;
        width: 350px;
    }
    .title {
        font-size: 19px;
        margin-top: 2cm;
        text-decoration: underline;
        text-decoration-thickness: 20%;
    }
</style>
@endpush

@section('template_body')
<div class="position-absolute left-0 top-0"><img src="{{ asset('img/polis/logo.png') }}" style="width: 85px;" alt=""></div>
<div class="text-center title fw-bold text-underline">Surat Pengajuan Klaim Asuransi Hewan MYPETT</div>
<div class="mt-5">Kepada YTH,</div>
<div class="">{{ $data->member->nama_lengkap }}</div>

<div class="mt-2">Nomor Polis : {{ $data->polis->nomor_polis }}</div>
<div class="mt-2">Tanggal Klaim : {{ \Carbon\Carbon::createFromFormat('Y-m-d',$data->tgl_klaim)->format('Y-m-d') }}</div>
<div class="mt-2 text-capitalized">Hal : {{ $data->keterangan_klaim }}</div>

<div class="mt-4 text-justify">Terima kasih atas kepercayaan Bapak/Ibu yang telah menggunakan Jasa Asuransi MYPETT sebagai mitra perlindungan asuransi hewan Bapak/Ibu. </div>
<div class="mt-4 text-justify">Pengajuan permohonan klaim sesuai dengan perihal Permohonan asuransi hewan Bapak/Ibu kami terima dengan jumlah sebesar Rp.{{ number_format(($data->nominal_bayar_rs+$data->nominal_bayar_obat+$data->nominal_bayar_dokter),0,'','.') }} dengan perincian sebagai berikut : </div>

<div>
    <table class="mt-4">
        <tr>
            <td>Mata Uang Polis</td>
            <td class="text-end">Rupiah</td>
        </tr>
        <tr>
            <td>Biaya Dokter</td>
            <td class="text-end">Rp {{ number_format(($data->nominal_bayar_dokter),0,'','.') }}</td>
        </tr>
        <tr>
            <td>Biaya Obat</td>
            <td class="text-end">Rp {{ number_format(($data->nominal_bayar_obat),0,'','.') }}</td>
        </tr>
        <tr class="border-bottom pb-2 border-dark border-black">
            <td>Biaya Rumah Sakit</td>
            <td class="text-end">Rp {{ number_format(($data->nominal_bayar_rs),0,'','.') }}</td>
        </tr>
        <tr>
            <td>Biaya Yang Dibayarkan</td>
            <td class="text-end">Rp {{ number_format(($data->nominal_bayar_rs+$data->nominal_bayar_obat+$data->nominal_bayar_dokter),0,'','.') }}</td>
        </tr>
    </table>
</div>

<div class="mt-4 text-justify">Dengan surat pengajuan klaim tersebut,maka permohonan klaim akan dipotong oleh limit yang tersedia sesuai dengan pertanggungan yang diperoleh.</div>
<div class="col-12 pt-3">
    <div class="text-center position-absolute end-0 me-5">
        <div class="">Jakarta, {{ \Carbon\Carbon::now('Asia/Jakarta')->isoFormat('D MMMM YYYY') }}</div>
        <div class="mb-1">MY PETT</div>
        <img src="{{ asset('img/ttd/mypet-qr-code.svg') }}" width="70" alt="">
    </div>
</div>

@endsection


@push('template_js')

@endpush
