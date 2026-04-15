@extends('layouts.app')

@section('content')
    @if (auth()->user()->isSuperAdmin())
        Selamat Datang {{ auth()->user()->name }} - {{ auth()->user()->role?->name }}
    @elseif (auth()->user()->isAdminHRD())
        Selamat Datang {{ auth()->user()->name }} - {{ auth()->user()->role?->name }}
    @else
        <h4 class="mb-4">
            Selamat Datang {{ auth()->user()->name }} - {{ auth()->user()->role?->name }}
        </h4>

        {{-- WIDGET --}}
        <div class="row mb-4">

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Total Pegawai</h6>
                        <h4>{{ $total_pegawai ?? 0 }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Pegawai Kontrak</h6>
                        <h4>{{ $pegawai_kontrak ?? 0 }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Pegawai Tetap</h6>
                        <h4>{{ $pegawai_tetap ?? 0 }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>Magang</h6>
                        <h4>{{ $pegawai_magang ?? 0 }}</h4>
                    </div>
                </div>
            </div>

        </div>

        {{-- CHART --}}
        <div class="row mb-4">

            <div class="col-md-6">
                <div class="card p-3">
                    <h6>Kontrak vs Tetap vs Magang</h6>
                    <canvas id="chartJenis"></canvas>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3">
                    <h6>Pria vs Wanita</h6>
                    <canvas id="chartGender"></canvas>
                </div>
            </div>

        </div>

        {{-- TABLE --}}
        <div class="card">
            <div class="card-header">
                5 Pegawai Kontrak Terbaru
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Masuk</th>
                            <th>Status Kontrak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai_baru ?? [] as $p)
                            <tr>
                                <td>{{ $p->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_masuk)->format('d/m/Y') }}</td>
                                <td>{{ $p->status_pegawai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>

        {{-- CHART JS --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            new Chart(document.getElementById('chartJenis'), {
                type: 'doughnut',
                data: {
                    labels: ['Kontrak', 'Tetap', 'Magang'],
                    datasets: [{
                        data: [{{ $pegawai_kontrak ?? 0 }}, {{ $pegawai_tetap ?? 0 }},
                            {{ $pegawai_magang ?? 0 }}
                        ]
                    }]
                }
            });

            new Chart(document.getElementById('chartGender'), {
                type: 'doughnut',
                data: {
                    labels: ['Pria', 'Wanita'],
                    datasets: [{
                        data: [{{ $laki_laki ?? 0 }}, {{ $perempuan ?? 0 }}]
                    }]
                }
            });
        </script>
    @endif
@endsection
