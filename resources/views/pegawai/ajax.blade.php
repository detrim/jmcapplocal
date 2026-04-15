@push('ajax-pegawai')
    <script>
        // kecamatan
        $(document).ready(function() {
            $('#kecamatan').on('keyup', function() {

                let q = $(this).val();

                if (q.length < 3) {
                    $('#kec-list').html('');
                    return;
                }

                $.ajax({
                    url: '/api/wilayah/searchwilayah',
                    type: 'GET',
                    headers: {
                        "Authorization": "Bearer {{ session('api_token') }}"
                    },
                    data: {
                        q: q
                    },
                    success: function(res) {

                        let html = '';

                        res.forEach(function(item) {
                            html += `
                        <a href="#"
                           class="list-group-item list-group-item-action select-kec"
                           data-kec="${item.nama_kecamatan}"
                           data-kab="${item.nama_kabupaten}"
                           data-prov="${item.nama_provinsi}">
                            ${item.nama_kecamatan}
                        </a>
                    `;
                        });

                        $('#kec-list').html(html);
                    }
                });
            });

            // klik hasil
            $(document).on('click', '.select-kec', function(e) {
                e.preventDefault();

                $('#kecamatan').val($(this).data('kec'));
                $('#kecamatan_val').val($(this).data('kec'));
                $('#kabupaten').val($(this).data('kab'));
                $('#kabupaten_val').val($(this).data('kab'));
                $('#provinsi').val($(this).data('prov'));
                $('#provinsi_val').val($(this).data('prov'));

                $('#kec-list').html('');
            });

            // klik luar untuk tutup list
            $(document).click(function(e) {
                if (!$(e.target).closest('#kecamatan').length) {
                    $('#kec-list').html('');
                }
            });
        });

        // tempat_lahir
        $(document).ready(function() {

            $('#tempat_lahir').on('keyup', function() {

                let q = $(this).val();

                if (q.length < 3) {
                    $('#kab-list').html('');
                    return;
                }

                $.ajax({
                    url: '/api/wilayah/searchkabupaten',
                    type: 'GET',
                    headers: {
                        "Authorization": "Bearer {{ session('api_token') }}"
                    },
                    data: {
                        q: q
                    },
                    success: function(res) {

                        let html = '';

                        res.forEach(function(item) {
                            html += `
                        <a href="#"
                           class="list-group-item list-group-item-action select-kab"
                           data-kab="${item.nama_kabupaten}">
                            ${item.nama_kabupaten}
                        </a>
                    `;
                        });

                        $('#kab-list').html(html);
                    }
                });
            });

            // klik hasil
            $(document).on('click', '.select-kab', function(e) {
                e.preventDefault();
                $('#tempat_lahir').val($(this).data('kab'));

                $('#kab-list').html('');
            });

            // klik luar untuk tutup list
            $(document).click(function(e) {
                if (!$(e.target).closest('#tempat_lahir').length) {
                    $('#kab-list').html('');
                }
            });

        });
    </script>
@endpush
