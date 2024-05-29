function updateCsrfToken(token) {
    $('meta[name="csrf-token"]').attr('content', token);
}

function updateLanguage(lang_code) {
    $('meta[name="language"]').attr('content', lang_code);
}

function getDropdown(data_values, link, value_name, value_id, name_selector, id_selector, key_name, type = '', edit_values = '') {
    $.ajax({
        url: url + link,
        type: 'GET',
        data: data_values,
        dataType: 'json',
        success: function (data) {
            let html = '';
            html += '<option value="">-- Choose your selection --</option>';
            var data_key = null;
            if (key_name) {
                data_key = data[key_name];
            } else {
                data_key = data;
            }
            if (data_key) {
                for (const [key, value] of Object.entries(data_key)) {
                    if (type == 'add') {
                        html += '<option value="' + value[value_id] + '">' + value[value_name] + '</option>'
                    } else {
                        if (value[value_id] != data_values[edit_values]) {
                            html += '<option value="' + value[value_id] + '">' + value[value_name] + '</option>'
                        } else {
                            html += '<option value="' + value[value_id] + '" selected>' + value[value_name] + '</option>'
                        }
                    }
                };
            }
            $("#" + id_selector + " select[name='" + name_selector + "']").html(html);
        },
        error: function (xhr, status, error) {
            // Handle any errors that occur during the AJAX request
            Swal.fire({
                title: 'Error!',
                text: error,
                icon: 'error',
                showConfirmButton: true,
                showCancelButton: false
            });
        }
    });
}

// Fungsi untuk onchange tanggal
function dateVal(e, date_end) {
    var date_start = $(e).val();
    if (date_start != "") {
        $("#" + date_end).val(date_start).attr('min', date_start).attr('readonly', false);

        // Tambahkan 7 hari ke tanggal start untuk mendapatkan tanggal max
        var maxDate = new Date(date_start);
        maxDate.setDate(maxDate.getDate() + 7);

        // Format tanggal menjadi YYYY-MM-DD
        var maxDateString = maxDate.toISOString().split('T')[0];

        // Set atribut max ke input date_end
        $("#" + date_end).attr('max', maxDateString);
    } else {
        $("#" + date_end).val("").attr('min', "").attr('max', "").attr('readonly', true);

    }
}

function timeVal(e, time_end) {
    var time_start = $(e).val();
    if (time_start != "") {
        $("#" + time_end).val("").attr('min', time_start).attr('readonly', false).attr('required', true);

        // Tambahkan 8 jam ke waktu start untuk mendapatkan waktu max
        var startTime = new Date('1970-01-01T' + time_start + 'Z');
        startTime.setHours(startTime.getHours() + 8);

        // // Format waktu menjadi HH:MM
        // var maxTimeString = startTime.toISOString().split('T')[1].substring(0, 5);

        // // Set atribut max ke input time_end
        // $("#" + time_end).attr('max', maxTimeString);
    } else {
        $("#" + time_end).val("").attr('min', "").attr('max', "").attr('readonly', true).removeAttr('required');
    }
}

function toggleClick(e, target_after, target_before) {
    $(e).toggleClass('expand');

    if ($(e).hasClass('expand')) {
        $(e).addClass(target_after);
        $(e).removeClass(target_before);
    } else {
        $(e).removeClass(target_after);
        $(e).addClass(target_before);
    }
}

// Expand Children in datatable
function clickChildren(e, link, value_id, func = null, variable_datatable = null) {

    var tr = $(e).closest('tr');
    var row = variable_datatable.row(tr);

    if (row.child.isShown()) {
        // Tutup tabel anak jika sudah terbuka
        row.child.hide();
        tr.removeClass('shown');
    } else {
        // Ambil data untuk baris saat ini
        var rowData = row.data();
        // console.log(rowData);
        // Kirim permintaan Ajax untuk memuat data tabel anak
        $.ajax({
            url: url + link,
            type: 'GET',
            data: { id: rowData[value_id] },
            dataType: 'json',
            success: function (response) {
                // Tampilkan data tabel anak di bawah baris utama
                row.child(func(response)).show();
                tr.addClass('shown');
            }
        });
    }

}
// Expand Children Tab in datatable
function clickChildrenTab(e, link, value_id, func = null, parent_url = null, parent_id = null) {
    $.ajax({
        url: url + parent_url,
        type: 'GET',
        data: { id: parent_id },
        dataType: 'json',
        success: function (response) {
            // Temukan baris terdekat yang mengandung elemen e
            var tr = $(e).closest('tr');
            if (tr.hasClass('shown')) {
                // Sembunyikan tabel anak jika sudah terbuka
                tr.removeClass('shown');
                tr.next('tr.child-row').remove(); // Hapus tabel anak jika sudah ada
            } else {
                var rowData = response[0];
                // Kirim permintaan Ajax untuk memuat data tabel anak
                $.ajax({
                    url: url + link,
                    type: 'GET',
                    data: { id: rowData[value_id] },
                    dataType: 'json',
                    success: function (response) {
                        // Buat baris baru untuk tabel anak
                        var childRow = $('<tr class="child-row"><td colspan="10"></td></tr>');
                        // Masukkan tabel anak di bawah baris utama
                        tr.after(childRow);
                        // Tambahkan kelas 'shown' ke baris utama
                        tr.addClass('shown');
                        // Isi tabel anak dengan data yang diterima dari respons Ajax
                        var childCell = childRow.find('td');
                        childCell.append(func(response));
                    }
                });
            }
        }
    });

    // var rowData = tr.find('td').map(function () {
    //     // Periksa apakah ada elemen input di dalam <td>
    //     var inputElement = $(this).find('input');
    //     if (inputElement.length > 0) {
    //         // Jika ada elemen input, kembalikan nilai dari input tersebut
    //         return inputElement.val();
    //     } else {
    //         // Jika tidak ada elemen input, kembalikan nilai teks dari <td>
    //         return $(this).text();
    //     }
    // }).get();

    // console.log(rowData);

    // if (tr.next().hasClass('child-row')) {
    //     // Tutup tabel anak jika sudah terbuka
    //     tr.next().remove();
    // } else {
    //     // Kirim permintaan Ajax untuk memuat data tabel anak
    //     $.ajax({
    //         url: url + link,
    //         type: 'GET',
    //         data: { id: rowData[value_id] },
    //         dataType: 'json',
    //         success: function (response) {
    //             // Tampilkan data tabel anak di bawah baris utama
    //             // row.child().show();
    //             tr.after(func(response));
    //         }
    //     });
    // }

}

function validationButtons(e = null) {
    var tabs_active = $(e);
    tabs_active.data('edit') === 1 ? $(".buttons-edit").attr("disabled", false) : $(".buttons-edit").attr("disabled", true);
    tabs_active.data('delete') === 1 ? $(".buttons-delete").show() : $(".buttons-delete").hide();
    tabs_active.data('buttons_csv') === 1 ? $(".buttons-csv").show() : $(".buttons-csv").hide();
    tabs_active.data('buttons_excel') === 1 ? $(".buttons-excel").show() : $(".buttons-excel").hide();
    tabs_active.data('buttons_print') === 1 ? $(".buttons-print").show() : $(".buttons-print").hide();
}

// function changeFileInput(e, label, name, match_value_file_name) {
//     $("#" + label).text(e.files[0].name);
//     $(e).attr("name", name);
//     // Untuk conditional di server side
//     $("#" + match_value_file_name).val(e.files[0].name);
// }

// $(document).on("click", "#submit-data", function (e) {
//     $(e).attr('disabled', true);
//     setTimeout(() => {
//         $(e).attr('disabled', false);
//     }, 3000);
//     $(e).submit();
// });

function previewImg(selector, previewImgClass) {
    const fileName = document.querySelector("#" + selector);
    const previewImg = document.querySelector("." + previewImgClass);


    // Ambil gambar dari root file
    const fileCover = new FileReader();
    // Get nama file nya
    fileCover.readAsDataURL(fileName.files[0]);
    // Load gambar
    fileCover.onload = function (e) {
        if (fileName.files[0].type == 'image/jpg' || fileName.files[0].type == 'image/jpeg' || fileName.files[0].type == 'image/png') {
            previewImg.src = e.target.result;
        } else {
            Swal.fire({
                title: "Error",
                text: "File yang anda masukkan tidak valid",
                icon: "error",
                timer: 0,
                showConfirmButton: true
            });
        }
    }
}