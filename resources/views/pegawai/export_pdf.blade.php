<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Export Pegawai</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>

    <h3 style="text-align:center;">DATA PEGAWAI</h3>
    {{ \Carbon\Carbon::now()->format('d-m-Y') }}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tanggal Masuk</th>
                <th>Masa Kerja</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pegawai as $i => $p)
                @php
                    $diff = \Carbon\Carbon::parse($p->tanggal_masuk)->diff(now());
                @endphp

                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nip }}</td>
                    <td class="text-left">{{ $p->nama }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($p->tanggal_masuk)->format('d-m-Y') }}
                    </td>
                    <td>
                        {{ $diff->y }} tahun {{ $diff->m }} bulan
                    </td>
                    <td>
                        {{ $p->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
