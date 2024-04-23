function post(url, id_datatable, id_form, data_values, tableOnModal = null) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrfToken // use  CSRF token on request headers
        },
        url: url,
        type: 'POST',
        data: data_values,
        dataType: 'json',
        beforeSend: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', true);
        },
        success: function (data) {
            updateCsrfToken(data.token);
            if (data?.validation) {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                for (const [key, value] of Object.entries(data.validation)) {
                    $('input[name="' + key + '"]').addClass('is-invalid');
                    $('select[name="' + key + '"]').addClass('is-invalid');
                    $('textarea[name="' + key + '"]').addClass('is-invalid');
                    let keys
                    if (tableOnModal) {
                        keys = key.replaceAll(".", "_validation_");
                        $('#' + keys).text(value);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#' + key + '_validation').text(value);
                    }
                }
            } else {
                // Nofitications
                $('.sweet-alert').html(data.notification);
                // Update DataTable
                const table = $('#' + id_datatable).DataTable();
                table.ajax.reload(null, false);
                // clear all input form
                $('#' + id_form).trigger("reset");
                $(".modal").modal("hide");
                $('input').removeClass('is-invalid');
                if (tableOnModal) {
                    $('#' + tableOnModal).html('');
                    $(".invalid-feedback").css("display", "none");
                }
            }
        },
        complete: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', false);
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

function put(url, id_datatable, id_form, data_values, tableOnModal = null) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrfToken // use  CSRF token on request headers
        },
        url: url,
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(data_values),
        dataType: 'json',
        beforeSend: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', true);
        },
        success: function (data) {
            updateCsrfToken(data.token);
            if (data?.validation) {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                for (const [key, value] of Object.entries(data.validation)) {
                    $('input[name="' + key + '"]').addClass('is-invalid');
                    $('select[name="' + key + '"]').addClass('is-invalid');
                    $('textarea[name="' + key + '"]').addClass('is-invalid');
                    let keys
                    if (tableOnModal) {
                        keys = key.replaceAll(".", "_validation_");
                        $('#' + keys).text(value);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#' + key + '_validation').text(value);
                    }
                }
            } else {
                // Nofitications
                $('.sweet-alert').html(data.notification);
                // Update DataTable
                const table = $('#' + id_datatable).DataTable();
                table.ajax.reload(null, false);
                $(".modal").modal("hide");
                $('input').removeClass('is-invalid');
                if (tableOnModal) {
                    $(".invalid-feedback").css("display", "none");
                }
            }
        },
        complete: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', false);
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

function postWithImage(url, id_datatable, id_form, formData, tableOnModal = null) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrfToken // use  CSRF token on request headers
        },
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', true);
        },
        success: function (data) {
            updateCsrfToken(data.token);
            if (data?.validation) {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                for (const [key, value] of Object.entries(data.validation)) {
                    $('input[name="' + key + '"]').addClass('is-invalid');
                    $('select[name="' + key + '"]').addClass('is-invalid');
                    $('textarea[name="' + key + '"]').addClass('is-invalid');
                    let keys
                    if (tableOnModal) {
                        keys = key.replaceAll(".", "_validation_");
                        $('#' + keys).text(value);
                    } else {
                        $('#' + key + '_validation').text(value);
                    }
                }
            } else {
                // Nofitications
                $('.sweet-alert').html(data.notification);
                // Update DataTable
                const table = $('#' + id_datatable).DataTable();
                table.ajax.reload(null, false);
                // clear all input form
                $('#' + id_form).trigger("reset");
                $(".modal").modal("hide");
                $('input').removeClass('is-invalid');
                if (tableOnModal) {
                    $('#' + tableOnModal).html('');
                }
            }
        },
        complete: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', false);
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

function putWithImage(url, id_datatable, id_form, data_values, tableOnModal = null) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrfToken // use  CSRF token on request headers
        },
        url: url,
        type: 'POST',
        contentType: 'application/json',
        data: data_values,
        dataType: 'json',
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', true);
        },
        success: function (data) {
            updateCsrfToken(data.token);
            if (data?.validation) {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                for (const [key, value] of Object.entries(data.validation)) {
                    $('input[name="' + key + '"]').addClass('is-invalid');
                    $('select[name="' + key + '"]').addClass('is-invalid');
                    $('textarea[name="' + key + '"]').addClass('is-invalid');
                    let keys
                    if (tableOnModal) {
                        keys = key.replaceAll(".", "_validation_");
                        $('#' + keys).text(value);
                        $(".invalid-feedback").css("display", "block");
                    } else {
                        $('#' + key + '_validation').text(value);
                    }
                }
            } else {
                // Nofitications
                $('.sweet-alert').html(data.notification);
                // Update DataTable
                const table = $('#' + id_datatable).DataTable();
                table.ajax.reload(null, false);
                $(".modal").modal("hide");
                $('input').removeClass('is-invalid');
                $('#' + id_form).trigger("reset");
                if (tableOnModal) {
                    $('#' + tableOnModal).html('');
                }
            }
        },
        complete: function () {
            $('#' + id_form + ' button[type="submit"]').attr('disabled', false);
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

function del(e, url, textMessage = '', method) {
    const id = $(e).data('id');
    const namesec = $(e).data('namesec');
    const id_datatable = $(e).data('id_datatable');
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    Swal.fire({
        title: 'Are you sure?',
        text: textMessage ? textMessage : "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fff',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrfToken // use  CSRF token on request headers
                },
                url: url + '/' + namesec + '/' + id,
                type: method,
                dataType: 'json',
                success: function (data) {
                    // Update DataTable
                    const table = $('#' + id_datatable).DataTable();
                    table.ajax.reload(null, false);
                    updateCsrfToken(data.token);
                    $('.sweet-alert').html(data.notification);
                    // return data;
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
    })
}