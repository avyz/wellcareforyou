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
                        $('#' + key + '_validation').text(value);
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
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                $('textarea').text('');
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
                        $('#' + key + '_validation').text(value);
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
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
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

function postWithImage(url, id_datatable, id_form, formData, tableOnModal = null, noModal = false, tableOnModalIsArray = false) {
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
                    if (!noModal) {
                        if (tableOnModal) {
                            keys = key.replaceAll(".", "_validation_");
                            $('#' + keys).text(value);
                            $('#' + key + '_validation').text(value);
                            $(".invalid-feedback").css("display", "block");
                        } else {
                            // console.log("masuk");
                            $('#' + key + '_validation').text(value);
                        }
                    } else {
                        $('#' + key + '_validation').text(value);
                        $(".invalid-feedback").css("display", "block");
                    }
                }
            } else {
                // Nofitications
                $('.sweet-alert').html(data.notification);
                // Update DataTable
                if (!noModal) {
                    const table = $('#' + id_datatable).DataTable();
                    table.ajax.reload(null, false);
                    $('#' + id_form).trigger("reset");
                    $(".modal").modal("hide");

                    if (tableOnModalIsArray) {
                        if (tableOnModal.length > 0) {
                            tableOnModal.forEach(function (item) {
                                $('#' + item).html('');
                            });
                            $(".invalid-feedback").css("display", "none");
                        }
                    }else{
                        if (tableOnModal) {
                            $('#' + tableOnModal).html('');
                            $(".invalid-feedback").css("display", "none");
                        }
                    }
                    $('textarea').text('');
                } else {
                    $(".invalid-feedback").css("display", "none");
                }

                // clear all input form
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
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

function putWithImage(url, id_datatable, id_form, data_values, tableOnModal = null, noModal = false, tableOnModalIsArray = false) {
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
                    if (!noModal) {
                        if (tableOnModal) {
                            keys = key.replaceAll(".", "_validation_");
                            $('#' + keys).text(value);
                            $('#' + key + '_validation').text(value);
                            $(".invalid-feedback").css("display", "block");
                        } else {
                            // console.log("masuk");
                            $('#' + key + '_validation').text(value);
                        }
                    } else {
                        $('#' + key + '_validation').text(value);
                        $(".invalid-feedback").css("display", "block");
                    }

                    // let keys
                    // if (tableOnModal) {
                    //     keys = key.replaceAll(".", "_validation_");
                    //     $('#' + keys).text(value);
                    //     $('#' + key + '_validation').text(value);
                    //     $(".invalid-feedback").css("display", "block");
                    // } else {
                    //     $('#' + key + '_validation').text(value);
                    // }
                }
            } else {
                // Nofitications
                $('.sweet-alert').html(data.notification);

                // Update DataTable
                if (!noModal) {
                    const table = $('#' + id_datatable).DataTable();
                    table.ajax.reload(null, false);
                    $('#' + id_form).trigger("reset");
                    $(".modal").modal("hide");

                    if (tableOnModalIsArray) {
                        if (tableOnModal.length > 0) {
                            tableOnModal.forEach(function (item) {
                                $('#' + item).html('');
                            });
                            $(".invalid-feedback").css("display", "none");
                        }
                    }else{
                        if (tableOnModal) {
                            $('#' + tableOnModal).html('');
                            $(".invalid-feedback").css("display", "none");
                        }
                    }
                    $('textarea').text('');
                } else {
                    $(".invalid-feedback").css("display", "none");
                }

                // Update DataTable
                // const table = $('#' + id_datatable).DataTable();
                // table.ajax.reload(null, false);
                // $(".modal").modal("hide");
                // $('input').removeClass('is-invalid');
                // $('select').removeClass('is-invalid');
                // $('textarea').removeClass('is-invalid');
                // if (tableOnModal) {
                //     $('#' + tableOnModal).html('');
                //     $(".invalid-feedback").css("display", "none");
                // }
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

function postContentEditor(url, data_values) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        type: 'POST',
        data: data_values,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
        dataType: 'json',
        success: function (response) {
            updateCsrfToken(response.token);
            if (!response?.validation) {
                // Nofitications
                $('.sweet-alert').html(response.notification);
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                $(".invalid-feedback").css("display", "none");

                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 2000);
            } else {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
                for (const [key, value] of Object.entries(response.validation)) {
                    $('input[name="' + key + '"]').addClass('is-invalid');
                    $('select[name="' + key + '"]').addClass('is-invalid');
                    $('textarea[name="' + key + '"]').addClass('is-invalid');
                    $('#' + key + '_validation').text(value);
                }
                $(".invalid-feedback").css("display", "block");
            }

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

var tagify_value = {};
function makeTags(selector, name_attr, placeholderText = "Type to search...", maxTags = 6, tagText = 'value', searchKeys = ['value'], api, initObject) {
    csrfToken = $('meta[name="csrf-token"]').attr('content');
    var tagify = new Tagify(selector,
        {
            maxTags: maxTags,
            placeholder: placeholderText,
            delimiters: ";",
            skipInvalid: true,
            tagTextProp: tagText,
            enforceWhitelist: true,
            dropdown: {
                enabled: 1,            // show suggestion after 1 typed character
                fuzzySearch: true,    // match only suggestions that starts with the typed characters
                position: 'text',      // position suggestions list next to typed text
                caseSensitive: false,   // allow adding duplicate items if their case is different
                searchKeys: searchKeys, // search in value keys
            },
            templates: {
                dropdownItemNoMatch: function (data) {
                    return `<div class='${this.settings.classNames.dropdownItem}' tabindex="0" role="option">
                 No suggestion found for: <strong>${data.value}</strong>
             </div>`
                },

            }
        }
    )

    tagify_value[name_attr] = tagify;

      tagify.on('input', function (e) {
        var value = e.detail.value;
        if (value.length > 0) {
            // searchTags(, value, tagify_doctor_language, { value: item.language, id: item.lang_code });
            $.ajax({
                url: url + api,  // Ganti 'URL_TO_YOUR_API' dengan endpoint API Anda
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                data: { search: value }, // Mengirim query sebagai parameter
                dataType: 'json',
                success: function (data) {
                    updateCsrfToken(data.token);
                    // Asumsikan server mengembalikan array objek dengan id dan name
                    var whitelist = data.data.map(initObject);
                    // callback(whitelist);
                    tagify.settings.whitelist = whitelist;
                    tagify.dropdown.show();
                },
                error: function (error) {
                    console.error('Error fetching tags:', error);
                }
            });
        }
    });

    tagify.on('add', function (e) {
        if($("#tags_" + name_attr + " .tagify__tag").length >= 0 && $("#tags_" + name_attr + " .tagify__tag").length <= 1){
            $("#check_" + name_attr).val(1);
        }
    });
   
    tagify.on('remove', function (e) {
        if($("#tags_" + name_attr + " .tagify__tag").length == 0){
          $("#check_" + name_attr).val("");
        }
    });
}

// Function to get Tagify value
function getTagifyValue(name_attr) {
    if (tagify_value[name_attr]) {
        return tagify_value[name_attr].getCleanValue(); // Use getCleanValue() to get an array of tag data
    } else {
        console.error('No Tagify found for:', name_attr);
        return [];
    }
}

// function searchTags(link_api, value, tagify_variable, initObject) {
    
// }