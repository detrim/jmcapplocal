$(document).ready(function () {

    const token = window.authToken;

    const headers = {
        "Authorization": "Bearer " + token,
        "Accept": "application/json"
    };

    // =====================
    // LOAD PROVINSI
    // =====================
    $.ajax({
        url: "/api/provinsi",
        method: "GET",
        headers: headers,
        success: function (res) {
            let data = res.data;

            $('#provinsi').html('<option value="">Pilih Provinsi</option>');

            data.forEach(item => {
                $('#provinsi').append(
                    `<option value="${item.id}">${item.name}</option>`
                );
            });
        }
    });

    // =====================
    // KABUPATEN
    // =====================
    $('#provinsi').on('change', function () {
        let id = $(this).val();

        $('#kabupaten').html('<option value="">Pilih Kabupaten</option>');
        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');

        if (!id) return;

        $.ajax({
            url: `/api/kabupaten/${id}`,
            method: "GET",
            headers: headers,
            success: function (res) {
                res.data.forEach(item => {
                    $('#kabupaten').append(
                        `<option value="${item.id}">${item.name}</option>`
                    );
                });
            }
        });
    });

    // =====================
    // KECAMATAN
    // =====================
    $('#kabupaten').on('change', function () {
        let id = $(this).val();

        $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');

        if (!id) return;

        $.ajax({
            url: `/api/kecamatan/${id}`,
            method: "GET",
            headers: headers,
            success: function (res) {
                res.data.forEach(item => {
                    $('#kecamatan').append(
                        `<option value="${item.id}">${item.name}</option>`
                    );
                });
            }
        });
    });

    // =====================
    // AUTO FILL (KECAMATAN → KABUPATEN → PROVINSI)
    // =====================
    $('#kecamatan').on('change', function () {
        let id = $(this).val();

        if (!id) return;

        $.ajax({
            url: `/api/kecamatan-detail/${id}`,
            method: "GET",
            headers: headers,
            success: function (res) {

                let provinsiId = res.data.provinsi_id;
                let kabupatenId = res.data.kabupaten_id;

                // set provinsi
                $('#provinsi').val(provinsiId).trigger('change');

                setTimeout(() => {
                    $.ajax({
                        url: `/api/kabupaten/${provinsiId}`,
                        method: "GET",
                        headers: headers,
                        success: function (res) {

                            $('#kabupaten').html('<option value="">Pilih Kabupaten</option>');

                            res.data.forEach(item => {
                                $('#kabupaten').append(
                                    `<option value="${item.id}">${item.name}</option>`
                                );
                            });

                            $('#kabupaten').val(kabupatenId).trigger('change');
                        }
                    });
                }, 300);
            }
        });
    });

});
