@extends('layouts.dashboard.app')

@section('title', $title)

@push('css')

@endpush

@section('container')
<div class="row">
    <div class="col-md-12 ">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-icon">
                <i class="align-middle" data-feather="user"></i>
            </div>
            <div class="alert-message fs-4">
                Selamat datang, <strong>{{ auth()->user()->username }}</strong>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Member</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($data['member'],0,'','.') }}</h1>
                <div class="mb-0">
                    <span class="badge {{ $data['m_persen']['status']?'badge-success-light':'badge-danger-light' }}"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $data['m_persen']['status']?'+':'-' }}{{ $data['m_persen']['persen'] }}% </span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Pembelian</h5>
                    </div>
                    <div class="col-auto">
                        <div class="stat text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($data['asuransi'],0,'','.') }}</h1>
                <div class="mb-0">
                    <span class="badge {{ $data['a_persen']['status']?'badge-success-light':'badge-danger-light' }}"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $data['a_persen']['status']?'+':'-' }}{{ $data['a_persen']['persen'] }}% </span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Polis</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail align-middle"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($data['polis'],0,'','.') }}</h1>
                <div class="mb-0">
                    <span class="badge {{ $data['p_persen']['status']?'badge-success-light':'badge-danger-light' }}"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $data['p_persen']['status']?'+':'-' }}{{ $data['p_persen']['persen'] }}% </span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Klaim</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        </div>
                    </div>
                </div>
                <h1 class="mt-1 mb-3">{{ number_format($data['klaim'],0,'','.') }}</h1>
                <div class="mb-0">
                    <span class="badge {{ $data['k_persen']['status']?'badge-success-light':'badge-danger-light' }}"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $data['k_persen']['status']?'+':'-' }}{{ $data['k_persen']['persen'] }}% </span>
                    <span class="text-muted">Since last week</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-6 col-xxl-7">
        <div class="card flex-fill w-100 shadow-lg">
            <div class="card-header">
                <h5 class="card-title mb-0">Grafik Pembelian Asuransi</h5>
            </div>
            <div class="card-body pt-2 pb-3">
                <div class="chart chart-sm"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="chartjs-dashboard-line" style="display: block; width: 246px; height: 250px;" width="246" height="250" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-3">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Klaim Asuransi</h5>
            </div>
            <div class="card-body d-flex">
                <div class="align-self-center w-100">
                    <div class="py-3">
                        <div class="chart chart-xs"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="chartjs-dashboard-pie" width="456" height="125" style="display: block; width: 456px; height: 125px;" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td><i class="align-middle text-success" data-feather="check"></i> Accepted</td>
                                <td class="text-end">{{ $data['acc_klaim'] }}</td>
                            </tr>
                            <tr>
                                <td><i class="align-middle text-danger" data-feather="x"></i> Rejected</td>
                                <td class="text-end">{{ $data['rej_klaim'] }}</td>
                            </tr>
                            <tr>
                                <td><i class="align-middle text-secondary" data-feather="activity"></i> Awaiting</td>
                                <td class="text-end">{{ $data['await_klaim'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
        gradientLight.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradientLight.addColorStop(1, "rgba(215, 227, 244, 0)");
        var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
        gradientDark.addColorStop(0, "rgba(51, 66, 84, 1)");
        gradientDark.addColorStop(1, "rgba(51, 66, 84, 0)");
        var chart = {!! $data['chart'] !!};
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: window.theme.id === "light" ? gradientLight : gradientDark,
                    borderColor: window.theme.primary,
                    data: chart
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1000
                        },
                        display: true,
                        borderDash: [3, 3],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var chart_pie = {!! $data['chart_pie'] !!};
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Accepted", "Rejected", "Awaiting"],
                datasets: [{
                    data: chart_pie,
                    backgroundColor: [
                        window.theme.success,
                        window.theme.danger,
                        window.theme.secondary,
                        "#E8EAED"
                    ],
                    borderWidth: 5,
                    borderColor: window.theme.white
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            }
        });
    });
</script>
@endpush
