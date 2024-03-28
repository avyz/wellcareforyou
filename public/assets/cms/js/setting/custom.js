// create role
$(document).on('submit', '#languageCreate', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    postWithImage(url + '/setting/create-language', 'language-ui-table', 'languageCreate', formData);
});

// get data role for edit
$(document).on('click', '#editLanguage', function () {
    const lang_id = $(this).data('lang_id');
    $.ajax({
        url: url + '/setting/edit-language',
        type: 'GET',
        data: {
            lang_id: lang_id,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            $('#edit_lang_id').val(data.uuid);
            $('#edit_language').val(data.language);
            $('#edit_old_lang_icon').val(data.lang_icon);
            $('#edit_lang_icon_label').text(data.lang_icon);
            $('#edit_lang_icon').attr("name", "");
            $('#edit_lang_code').val(data.lang_code);
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
});

// edit role
$(document).on('submit', '#languageEdit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    putWithImage(url + '/setting/edit-language', 'language-ui-table', 'languageEdit', formData);
});