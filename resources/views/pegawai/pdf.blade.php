<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Detail Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .row {
            width: 100%;
            margin-bottom: 10px;
        }

        .col {
            width: 50%;
            float: left;
        }

        .clear {
            clear: both;
        }

        img {
            width: 120px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h3>Detail Data Pegawai</h3>

    <!-- FOTO -->
    <div class="row">
        <div class="col">
            <img src="{{ public_path('storage/' . $pegawai->foto) }}">
        </div>
    </div>

    <div class="clear"></div>

    <p><span class="label">NIP:</span> {{ $pegawai->nip }}</p>
    <p><span class="label">Nama:</span> {{ $pegawai->nama }}</p>
    <p><span class="label">Email:</span> {{ $pegawai->email }}</p>
    <p><span class="label">No HP:</span> {{ $pegawai->no_hp }}</p>
    <p><span class="label">Jenis Kelamin:</span> {{ $pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
    <p><span class="label">Tempat Lahir:</span> {{ $pegawai->tempat_lahir }}</p>
    <p><span class="label">Tanggal Lahir:</span>
        {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y') }}</p>
    <p><span class="label">Usia:</span> {{ $pegawai->usia }} Tahun</p>
    <p><span class="label">Tanggal Masuk:</span>
        {{ \Carbon\Carbon::parse($pegawai->tanggal_masuk)->translatedFormat('d F Y') }}</p>

    <p><span class="label">Alamat Lengkap:</span>
        {{ $pegawai->alamat_lengkap }},
    </p>
    <p><span class="label">Alamat:</span> Kec.
        {{ $pegawai->alamat_kecamatan }}, Kab.
        {{ $pegawai->alamat_kabupaten }}, Prov.
        {{ $pegawai->alamat_provinsi }}
    </p>

    <p><span class="label">Status Kawin:</span> {{ $pegawai->status_kawin }}</p>
    <p><span class="label">Jumlah Anak:</span> {{ $pegawai->jumlah_anak }}</p>
    <p><span class="label">Jabatan:</span> {{ $pegawai->jabatan }}</p>
    <p><span class="label">Departemen:</span> {{ $pegawai->departemen }}</p>
    <p><span class="label">Status Pegawai:</span> {{ $pegawai->status == 'kontrak' ? 'Kontrak' : 'Tetap' }}</p>
    <p><span class="label">Status:</span> {{ $pegawai->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</p>

    <hr>

    <h4>Pendidikan</h4>

    @foreach ($pendidikan as $p)
        <p>
            {{ $p['jenjang'] ?? '-' }} - {{ $p['nama'] ?? '-' }} - {{ $p['tahun'] ?? '-' }}
        </p>
    @endforeach

</body>

</html>
