<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="sidebar-brand-text align-middle">
                MYPETT
            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>
        <ul class="sidebar-nav">

            <li class="sidebar-header">
                Navigasi
            </li>

            <li class="sidebar-item {{ $title=='Dashboard'?'active':'' }}">
                <a class="sidebar-link" href="{{ route('auth.dashboard') }}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title=='Pembelian Asuransi Member'?'active':'' }}{{ $title=='Detail Pembelian Asuransi Member'?'active':'' }}">
                <a class="sidebar-link" href="{{ route('pembelian') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Pembelian</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title=='Polis Asuransi Member'?'active':'' }}">
                <a class="sidebar-link" href="{{ route('klaim') }}">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Polis</span>
                </a>
            </li>

            <li class="sidebar-item {{ $title=='Klaim Asuransi Member'?'active':'' }}">
                <a class="sidebar-link" href="{{ route('klaim') }}">
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Klaim</span>
                </a>
            </li>

            <li class="sidebar-item
                {{ $title=='Master Bank'?'active':'' }}
                {{ $title=='Master Jenis Hewan'?'active':'' }}
                {{ $title=='Master Ras Hewan'?'active':'' }}
                {{ $title=='Produk Asuransi'?'active':'' }}
                {{ $title=='Tambah Produk Asuransi'?'active':'' }}
                {{ $title=='Master Nomor Rekening'?'active':'' }}">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Master Data</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse
                    {{ $title=='Master Bank'?'show':'' }}
                    {{ $title=='Master Jenis Hewan'?'show':'' }}
                    {{ $title=='Master Ras Hewan'?'show':'' }}
                    {{ $title=='Produk Asuransi'?'show':'' }}
                    {{ $title=='Tambah Produk Asuransi'?'show':'' }}
                    {{ $title=='Master Nomor Rekening'?'show':'' }}"
                    data-bs-parent="#sidebar" style="">
                    <li class="sidebar-item">
                        <a data-bs-target="#multi-2" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">Bank Payment</a>
                        <ul id="multi-2" class="sidebar-dropdown list-unstyled collapse
                            {{ $title=='Master Bank'?'show':'' }}
                            {{ $title=='Master Nomor Rekening'?'show':'' }}">
                            <li class="sidebar-item {{ $title=='Master Bank'?'active':'' }}">
                                <a class="sidebar-link" href="{{ route('master-data.bank') }}">Daftar Bank</a>
                            </li>
                            <li class="sidebar-item {{ $title=='Master Nomor Rekening'?'active':'' }}">
                                <a class="sidebar-link" href="{{ route('master-data.no-rek') }}">Nomor Rekening</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="sidebar-item"><a class="sidebar-link" href="dashboard-ecommerce.html">E-Commerce</a></li> --}}
                    <li class="sidebar-item {{ $title=='Master Jenis Hewan'?'active':'' }}">
                        <a class="sidebar-link" href="{{ route('master-data.jenis-hewan') }}">Jenis Hewan</a>
                    </li>

                    <li class="sidebar-item {{ $title=='Master Ras Hewan'?'active':'' }}">
                        <a class="sidebar-link" href="{{ route('master-data.ras-hewan') }}">Ras Hewan</a>
                    </li>

                    <li class="sidebar-item
                    {{ $title=='Produk Asuransi'?'active':'' }}
                    {{ $title=='Tambah Produk Asuransi'?'active':'' }}
                    ">
                        <a class="sidebar-link" href="{{ route('master-data.produk-asuransi') }}">Produk Asuransi</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item
                {{ $title=='FAQ'?'active':'' }}
                {{ $title=='Term & Conditions'?'active':'' }}
                {{ $title=='Tambah Term & Conditions'?'active':'' }}">
                <a data-bs-target="#webcontents" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                    <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Konten Web</span>
                </a>
                <ul id="webcontents" class="sidebar-dropdown list-unstyled collapse
                    {{ $title=='FAQ'?'show':'' }}
                    {{ $title=='Term & Conditions'?'show':'' }}
                    {{ $title=='Tambah Term & Conditions'?'show':'' }}"
                    data-bs-parent="#sidebar" style="">
                    {{-- <li class="sidebar-item">
                        <a data-bs-target="#multi-2" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">Master Bank</a>
                        <ul id="multi-2" class="sidebar-dropdown list-unstyled collapse
                            {{ $title=='Master Bank'?'show':'' }}">
                            <li class="sidebar-item {{ $title=='Master Bank'?'active':'' }}">
                                <a class="sidebar-link" href="{{ route('master-data.bank') }}">Daftar Bank</a>
                            </li>
                            <li class="sidebar-item {{ $title=='Master Nomor Rekening'?'active':'' }}">
                                <a class="sidebar-link" href="{{ route('master-data.no-rek') }}">Nomor Rekening</a>
                            </li>
                        </ul>
                    </li> --}}
                    {{-- <li class="sidebar-item"><a class="sidebar-link" href="dashboard-ecommerce.html">E-Commerce</a></li> --}}
                    <li class="sidebar-item {{ $title=='Hero'?'active':'' }}">
                        <a class="sidebar-link" href="{{ route('web-content.hero') }}">Hero</a>
                    </li>
                    <li class="sidebar-item
                    {{ $title=='Term & Conditions'?'active':'' }}
                    {{ $title=='Tambah Term & Conditions'?'active':'' }}">
                        <a class="sidebar-link" href="{{ route('web-content.tnc') }}">Term & Conditions</a>
                    </li>
                    <li class="sidebar-item {{ $title=='FAQ'?'active':'' }}">
                        <a class="sidebar-link" href="{{ route('web-content.faq') }}">FAQ</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Manajemen User</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-in.html">Sign In</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign Up</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-reset-password.html">Reset Password <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-404.html">404 Page <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="pages-500.html">500 Page <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
