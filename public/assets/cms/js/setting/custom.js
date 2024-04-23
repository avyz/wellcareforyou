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

// FilePond.registerPlugin(
//     FilePondPluginFileValidateType,
//     FilePondPluginImageExifOrientation,
//     FilePondPluginImagePreview,
//     FilePondPluginImageCrop,
//     FilePondPluginImageResize,
//     FilePondPluginImageTransform,
//     //   FilePondPluginImageEdit
// );

// Select the file input and use
// create() to turn it into a pond

// FilePond.create(
//     document.querySelector('.misc_logo'), {
//     // labelIdle: `<span class="no-image-placeholder"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span> <p class="drag-para">Drag & Drop your picture or <span class="filepond--label-action" tabindex="0">Browse</span></p>`,
//     imagePreviewHeight: 170,
//     imageCropAspectRatio: '1:1',
//     imageResizeTargetWidth: 200,
//     imageResizeTargetHeight: 200,
//     stylePanelLayout: 'compact circle',
//     styleLoadIndicatorPosition: 'center bottom',
//     styleProgressIndicatorPosition: 'right bottom',
//     styleButtonRemoveItemPosition: 'left bottom',
//     styleButtonProcessItemPosition: 'right bottom',
//     files: $('#misc_logo').val().length > 0 ? [
//         {
//             // the server file reference
//             source: url + '/assets/website/images/' + $('#misc_logo').val(),
//         }
//     ] : [],
// }
// );

// FilePond.create(
//     document.querySelector('.misc_logo_white'), {
//     // labelIdle: `<span class="no-image-placeholder"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span> <p class="drag-para">Drag & Drop your picture or <span class="filepond--label-action" tabindex="0">Browse</span></p>`,
//     imagePreviewHeight: 170,
//     imageCropAspectRatio: '1:1',
//     imageResizeTargetWidth: 200,
//     imageResizeTargetHeight: 200,
//     stylePanelLayout: 'compact circle',
//     styleLoadIndicatorPosition: 'center bottom',
//     styleProgressIndicatorPosition: 'right bottom',
//     styleButtonRemoveItemPosition: 'left bottom',
//     styleButtonProcessItemPosition: 'right bottom',
//     files: $('#misc_logo_white').val().length > 0 ? [
//         {
//             // the server file reference
//             source: url + '/assets/website/images/' + $('#misc_logo_white').val(),
//         }
//     ] : [],
// }
// );