@extends('layouts.landing.app')

@push('css')

@endpush

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb py-3 bg-light">
        <div class="container d-flex">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About</li>
        </div>
    </ol>
</nav>
<div class="container">
    <div class="car">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div>1. Ketentuan Umum &amp; Pengakhiran<br><br></div><div>Poin ini berisikan menjelaskan hal dasar terkait situs web atau aplikasi seluler, oleh karena itu pemilik layanan dapat memutuskan bagaimana itu harus digunakan.<br><br></div><div>Setiap pengguna umumnya wajib mengetahui Terms and Conditions yang mencakup daftar larangan atau pedoman umum yang harus ditaati dalam penggunaan layanan. Isinya bisa mencakup pada aturan yang luas, seperti menyatakan bahwa layanan tidak akan digunakan untuk tujuan ilegal atau melanggar hukum atau bahwa pengguna tidak boleh mencoba untuk melanggar atau menguji kerentanan <a href="https://adammuiz.com/jaringan-komputer/">jaringan</a> atau menghindari tindakan keamanan.<br><br></div><div>Jika platform kolaboratif, artinya pengguna diundang untuk berbagi seperti di jaringan <a href="https://adammuiz.com/media-sosial/"><em>media sosial</em></a>, maka disarankan memiliki halaman terpisah dengan pedoman <a href="https://adammuiz.com/komunitas/">komunitas</a>, yang nantinya dapat ditautkan dalam klausa itu.<br><br></div><div>Pengelola layanan berhak untuk mengakhiri kontrak atau menonaktifkan akun pengguna jika ada pelanggaran terhadap salah satu syarat, pedoman, dan ketentuan dengan menyertakan klausul penghentian – hal ini sangat umum terdapat dalam kasus <a href="https://adammuiz.com/world-wide-web/">situs web</a> dan aplikasi SaaS.<br><br></div><div>Pada akhirnya, sebagai&nbsp; pemilik layanan kita menyatakan memiliki kuasa penuh untuk mengambil tindakan yang dibutuhkan jika seseorang menyalahgunakan layanan.<br><br></div><div><br>2. Hak Cipta &amp; Kekayaan Intelektual<br><br></div><div>Meskipun memiliki klausul kekayaan intelektual tidak menjamin bahwa seseorang tidak akan menyalin karya orang lain. Memiliki pemberitahuan hak cipta yang menegaskan dan memperingatkan pengguna bahwa <a href="https://adammuiz.com/konten/">konten</a> di situs web adalah hak pemilik layanan dan tidak untuk direproduksi atau digunakan kembali tanpa izin tertulis serta menegaskan kembali bahwa pemilik layanan memegang merek dagang dan kepemilikan atas elemen tertentu dari situs web itu sendiri dan atas produk yang di jual harus no-brainer.<br><br></div><div><br>3. Proses Penghapusan DMCA<br><br></div><div>Merupakan praktik umum untuk menyertakan klausa yang menjelaskan cara memproses dan menanggapi pemberitahuan penghapusan <a href="https://adammuiz.com/dmca/">DMCA</a> – tidak perlu menjelaskan secara mendetail tetapi dapat meringkas informasi penting, menyertakan tautan ke formulir kontak atau alamat email, dan tautan dengan kebijakan DMCA yang terpisah.<br><br></div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush
