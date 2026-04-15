@extends('layouts.app')
@section('title', 'Pegawai')
@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Data Pegawai</h5>
            </div>

            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Foto -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Foto</label>
                            <div class="input-group" style="justify-content: center">
                                <input type="file" name="foto" id="photos"
                                    class=" form-control form-control-border mb-3 rounded-0 inGambar sendText previewImg"
                                    style="display: none;visibility:none;" onchange="toText(this.value)">
                                <img src="{{ asset('img/white-background.jpg') }}"
                                    class="img-placeholder-linen img-thumbnail  rounded-0">
                                <img src="{{ asset('img/empty.jpg') }}"
                                    class="img-overlay-linen img-preview img-thumbnail rounded-0" onclick="toGambar()">
                                <label class="center-label-linen">
                                    <a role="button" class="btn btn-md btn-flat btn-outline-success" onclick="toGambar()">
                                        <i class="bi bi-camera"></i>
                                    </a>
                                </label>
                            </div>
                            <input type="hidden" name="oldFoto" value="">
                        </div>

                        <!-- NIP -->
                        <div class="col-md-4 mb-3">
                            <div class="mb-3">
                                <label class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis_kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="+628xxxx">
                        </div>
                        <div class="col-md-4 mb-3 position-relative">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                autocomplete="off">
                            <div id="kab-list" class="list-group position-absolute w-100 shadow"
                                style="z-index:999; max-height:250px; overflow-y:auto;">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tgl_lahir" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Usia</label>
                            <input type="text" id="usia_text" class="form-control" readonly>
                            <input type="hidden" name="usia" id="usia" class="form-control">
                        </div>


                        <!-- Alamat -->
                        <div class="col-md-4 mb-3 position-relative">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan" class="form-control" autocomplete="on">

                            <div id="kec-list" class="list-group position-absolute w-100 shadow"
                                style="z-index:999; max-height:250px; overflow-y:auto;">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kabupaten</label>
                            <input type="text" id="kabupaten" disabled class="form-control">
                            <input type="hidden" id="kabupaten_val" name="kabupaten" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Provinsi</label>
                            <input type="text" id="provinsi" disabled class="form-control">
                            <input type="hidden" id="provinsi_val" name="provinsi" class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="form-control"></textarea>
                        </div>



                        <!-- Status Kawin -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status Kawin</label>
                            <select name="status_kawin" class="form-select">
                                <option value="tidak kawin">Tidak Kawin</option>
                                <option value="kawin">Kawin</option>
                            </select>
                        </div>

                        <!-- Jumlah Anak -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jumlah Anak</label>
                            <input type="number" name="jumlah_anak" class="form-control">
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                        </div>

                        <!-- Jabatan -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jabatan</label>
                            <select name="jabatan" class="form-select">
                                <option value="Manager">Manager</option>
                                <option value="Staf">Staf</option>
                                <option value="Magang">Magang</option>
                            </select>
                        </div>

                        <!-- Departemen -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Departemen</label>
                            <select name="departemen" class="form-select">
                                <option value="Marketing">Marketing</option>
                                <option value="HRD">HRD</option>
                                <option value="Production">Production</option>
                                <option value="Executive">Executive</option>
                                <option value="Commissioner">Commissioner</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Status Pegawai</label>
                            <select name="status_pegawai" class="form-select">
                                <option value="Kontrak">Kontrak</option>
                                <option value="Tetap">Tetap</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label>Pendidikan</label>

                                <!-- SD -->
                                <div class="row mb-2">
                                    <div class="col-md-1 text-end">
                                        <input type="checkbox" onchange="togglePendidikan(this)" required>
                                    </div>

                                    <div class="col-md-1">
                                        <select disabled class="form-control" name="pendidikan[0][jenjang]" required>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                    </div>

                                    <div class="col-md-7">
                                        <input type="text" name="pendidikan[0][nama]" class="form-control"
                                            placeholder="Nama Sekolah" disabled required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="pendidikan[0][tahun]" class="form-control"
                                            placeholder="Tahun Lulus" disabled required>
                                    </div>
                                </div>

                                <!-- List tambahan -->
                                <div id="list-pendidikan"></div>

                                <!-- Tombol tambah -->
                                <button type="button" class="btn btn-primary btn-sm mt-2" onclick="tambahField()">
                                    + List Item
                                </button>
                            </div>
                        </div>
                        <!-- Pendidikan -->


                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @include('pegawai.ajax');
    @push('script-create-pegawai')
        <script>
            /* TAMBAH FIELD */
            let indexPendidikan = 1;

            function tambahField() {
                let container = document.getElementById('list-pendidikan');

                let div = document.createElement('div');
                div.classList.add('row', 'mb-2');

                div.innerHTML = `
        <div class="col-md-1 text-end">
            <input type="checkbox" onchange="togglePendidikan(this)" required>
        </div>

        <div class="col-md-1 ">
            <select class="form-control" required disabled name="pendidikan[${indexPendidikan}][jenjang]">
                <option value="">Pilih</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="SMK">SMK</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </div>

        <div class="col-md-7">
            <input type="text"
                name="pendidikan[${indexPendidikan}][nama]"
                class="form-control"
                placeholder="Nama Sekolah"
                disabled required>
        </div>
        <div class="col-md-2">
            <input type="number"
                name="pendidikan[${indexPendidikan}][tahun]"
                class="form-control"
                placeholder="Tahun Lulus"
                disabled required>
        </div>

        <div class="col-md-1">
            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.row').remove()">
                Hapus
            </button>
        </div>
    `;

                container.appendChild(div);
                indexPendidikan++;
            }
        </script>
    @endpush


@endsection
