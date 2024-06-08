// Section 1
$(document).on('submit', '#createSectionOne', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    // console.log(...formData.entries());

    // return false;

    postWithImage(url + '/page/about/edit-content', '', 'createSectionOne', formData, null, false, false, true);
});

$(document).on('click', '#aboutSectionOne', function () {
    getDataAjax('/page/about/edit-content', 'aboutSectionOne', 'createSectionOne').then(responseJSON => {
        const get_data = responseJSON;
        const data_page = get_data.data_page;
        const data_grid = get_data.data_grid;
        const data_image = get_data.data_image;

        $("#section_one_about_title").val(data_page.title);
        $("#section_one_about_optional_title").val(data_page.optional_title);
        $("#section_one_about_subtitle").val(data_page.subtitle);
        $("#section_one_about_paragraph").val(data_page.paragraph);

        data_grid.map(function (value, index) {
            $("#section_one_about_grid_title_" + index).val(value.title);
            $("#section_one_about_grid_paragraph_" + index).val(value.paragraph);
            $("#section_one_about_grid_image_" + index).val(value.image);
        });

        data_image.map(function (value, index) {
            $("#section_one_about_image_" + index).val(value.page_image);
            $("#edit-show-section-one-about-image-" + index + " img").attr('src', url + '/assets/website/images/about/' + value.page_image);
        });
    }).catch(error => {
        return error;
    });
});

// Section 2
$(document).on('submit', '#createSectionTwo', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    postWithImage(url + '/page/about/edit-content', '', 'createSectionTwo', formData, null, false, false, true);
});

$(document).on('click', '#aboutSectionTwo', function () {
    getDataAjax('/page/about/edit-content', 'aboutSectionTwo', 'createSectionTwo').then(responseJSON => {
        const get_data = responseJSON;
        const data_grid = get_data.data_grid;

        data_grid.map(function (value, index) {
            $("#section_two_about_grid_title_" + index).val(value.title);
            $("#section_two_about_grid_paragraph_" + index).val(value.paragraph);
        });
    }).catch(error => {
        return error;
    });
});

// Section 3
$(document).on('submit', '#createSectionThree', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    postWithImage(url + '/page/about/edit-content', '', 'createSectionThree', formData, null, false, false, true);
});

$(document).on('click', '#aboutSectionThree', function () {
    getDataAjax('/page/about/edit-content', 'aboutSectionThree', 'createSectionThree').then(responseJSON => {
        const get_data = responseJSON;
        const data_page = get_data.data_page;
        const data_grid = get_data.data_grid;

        $("#section_three_about_title").val(data_page.title);
        $("#section_three_about_subtitle").val(data_page.subtitle);

        data_grid.map(function (value, index) {
            $("#section_three_about_grid_title_" + index).val(value.title);
            $("#section_three_about_grid_paragraph_" + index).val(value.paragraph);
        });
    }).catch(error => {
        return error;
    });
});

// Section 4
$(document).on('submit', '#createSectionFour', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    postWithImage(url + '/page/about/edit-content', '', 'createSectionFour', formData, null, false, false, true);
});

$(document).on('click', '#aboutSectionFour', function () {
    getDataAjax('/page/about/edit-content', 'aboutSectionFour', 'createSectionFour').then(responseJSON => {
        const get_data = responseJSON;
        const data_page = get_data.data_page;
        const data_grid = get_data.data_grid;

        // console.log(get_data);
        $("#section_four_about_title").val(data_page.title);
        $("#section_four_about_optional_title").val(data_page.optional_title);
        $("#section_four_about_subtitle").val(data_page.subtitle);
        $("#section_four_about_paragraph").val(data_page.paragraph);
        $("#section_four_about_image").val(data_page.page_image);
        $("#edit-show-section-four-about-image img").attr('src', url + '/assets/website/images/about/' + data_page.page_image);

        data_grid.map(function (value, index) {
            $("#section_four_about_grid_title_" + index).val(value.title);
            $("#section_four_about_grid_paragraph_" + index).val(value.paragraph);
        });
    }).catch(error => {
        return error;
    });
});

// Section 5
var edit_no_insert_data_grid_about = 1;
$(document).on("click", "#add-about-grid", function () {
    // console.log(edit_no_insert_data_grid_about);
    if ($(".data-about-grid .rows").length >= 8) {
        Swal.fire({
            title: 'Warning!',
            text: 'Reach maximum 8 image',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    let html = '';
    html += '<div class="rows">';
    html += '<a href="javascript:void(0)" type="button" class="d-flex justify-content-end text-danger edit-delete-data-about-grid" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '<h6 class="mb-3 section_five_about_grid_no_urutan">Grid ' + (edit_no_insert_data_grid_about + 1) + '</h6>';
    html += '<input type="hidden" class="form-control" name="section_five_about_grid_urutan[]" value="' + edit_no_insert_data_grid_about + '">';
    html += '<div class="mb-3">';
    html += '<label class="form-label">Title <small class="text-danger">*</small> :</label>';
    html += '<input type="text" class="form-control" name="section_five_about_grid_title[]" id="section_five_about_grid_title_' + edit_no_insert_data_grid_about + '" required>';
    html += '<div class="invalid-feedback grid_title" id="section_five_about_grid_title_validation_' + edit_no_insert_data_grid_about + '"></div>';
    html += '</div>';
    html += '<div class="mb-3">';
    html += '<label class="form-label">Image <small class="text-danger">*</small> :</label>';
    html += '<div class="row align-items-center" id="edit-show-section-five-about-grid-image-' + edit_no_insert_data_grid_about + '">';
    html += '<div class="col-lg-12 mb-3">';
    html += '<img src="/assets/website/images/icon/icon-3.svg" class="edit-preview-img-section-five-about-grid-image-' + edit_no_insert_data_grid_about + ' mb-2 mb-lg-0" style="width:120px" alt="img">';
    html += '</div>';
    html += '<div class="col-lg-12">';
    html += '<input onchange="previewImg(\'section_five_about_grid_image_new_' + edit_no_insert_data_grid_about + '\', \'edit-preview-img-section-five-about-grid-image-' + edit_no_insert_data_grid_about + '\')" class="form-control" type="file" id="section_five_about_grid_image_new_' + edit_no_insert_data_grid_about + '" name="section_five_about_grid_image_new[]" accept="image/*" required>';
    html += '</div>';
    html += '</div>';
    html += '<div class="invalid-feedback grid_image_new" id="section_five_about_grid_image_new_validation_' + edit_no_insert_data_grid_about + '"></div>';
    html += '<input type="hidden" class="form-control" name="section_five_about_grid_image[]" id="section_five_about_grid_image_' + edit_no_insert_data_grid_about + '">';
    html += '</div>';
    html += '</div>';
    $(".data-about-grid").append(html);
    editUpdateInsertDataGridAbout("data-about-grid");
});

$(document).on("click", ".edit-delete-data-about-grid", function () {
    // remove file input when trigger click
    $(this).closest('.rows').remove();
    editUpdateInsertDataGridAbout("data-about-grid");
});

function editUpdateInsertDataGridAbout(id_table) {
    edit_no_insert_data_grid_about = $("." + id_table + " .rows").length;

    $("." + id_table + " .rows").each(function (index) {
        // console.log(index);
        $(this).find(".section_five_about_grid_no_urutan").text('Grid ' + (index + 1));
        $(this).find("input[name='section_five_about_grid_urutan[]']").val(index);

        $(this).find("input[name='section_five_about_grid_title[]']").attr('id', 'section_five_about_grid_title_' + index);
        $(this).find(".invalid-feedback.grid_title").attr('id', 'section_five_about_grid_title_validation_' + index);

        $(this).find(".row.align-items-center").attr('id', 'edit-show-section-five-about-grid-image-' + index);
        $(this).find("img").attr('class', 'edit-preview-img-section-five-about-grid-image-' + index);
        $(this).find("input[type='file']").attr({
            'onchange': `previewImg('section_five_about_grid_image_new_${index}', 'edit-preview-img-section-five-about-grid-image-${index}')`,
            'id': 'section_five_about_grid_image_new_' + index
        });
        $(this).find(".invalid-feedback.grid_image_new").attr('id', 'section_five_about_grid_image_new_validation_' + index);
        $(this).find("input[type='hidden']").attr('id', 'section_five_about_grid_image_' + index);
    });
}

$(document).on('submit', '#createSectionFive', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    postWithImage(url + '/page/about/edit-content', '', 'createSectionFive', formData, null, false, false, true);
});

$(document).on('click', '#aboutSectionFive', function () {
    getDataAjax('/page/about/edit-content', 'aboutSectionFive', 'createSectionFive').then(responseJSON => {
        const get_data = responseJSON;
        const data_page = get_data.data_page;
        const data_grid = get_data.data_grid;

        // console.log(get_data);
        // data_grid.map(function (value, index) {
        //     $("#section_four_about_grid_title_" + index).val(value.title);
        //     $("#section_four_about_grid_paragraph_" + index).val(value.paragraph);
        // });

        $("#section_five_about_title").val(data_page.title);
        $("#section_five_about_subtitle").val(data_page.subtitle);

        let html = '';
        data_grid.map(function (value, index) {
            // $("#section_five_about_grid_title_" + index).val(value.title);

            html += '<div class="rows">';
            if (index != 0) {
                html += '<a href="javascript:void(0)" type="button" class="d-flex justify-content-end text-danger edit-delete-data-about-grid" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
            }
            html += '<h6 class="mb-3 section_five_about_grid_no_urutan">Grid ' + (index + 1) + '</h6>';
            html += '<input type="hidden" class="form-control" name="section_five_about_grid_urutan[]" value="' + index + '">';
            html += '<div class="mb-3">';
            html += '<label class="form-label">Title <small class="text-danger">*</small> :</label>';
            html += '<input type="text" class="form-control" name="section_five_about_grid_title[]" id="section_five_about_grid_title_' + index + '" value="' + value.title + '" required>';
            html += '<div class="invalid-feedback grid_title" id="section_five_about_grid_title_validation_' + index + '"></div>';
            html += '</div>';
            html += '<div class="mb-3">';
            html += '<label class="form-label">Image <small class="text-danger">*</small> :</label>';
            html += '<div class="row align-items-center" id="edit-show-section-five-about-grid-image-' + index + '">';
            html += '<div class="col-lg-12 mb-3">';
            html += '<img src="/assets/website/images/about/icon/' + value.image + '" class="edit-preview-img-section-five-about-grid-image-' + index + ' mb-2 mb-lg-0" style="width:120px" alt="img">';
            html += '</div>';
            html += '<div class="col-lg-12">';
            html += '<input onchange="previewImg(\'section_five_about_grid_image_new_' + index + '\', \'edit-preview-img-section-five-about-grid-image-' + index + '\')" class="form-control" type="file" id="section_five_about_grid_image_new_' + index + '" name="section_five_about_grid_image_new[]" accept="image/*">';
            html += '</div>';
            html += '</div>';
            html += '<div class="invalid-feedback grid_image_new" id="section_five_about_grid_image_new_validation_' + index + '"></div>';
            html += '<input type="hidden" class="form-control" name="section_five_about_grid_image[]" id="section_five_about_grid_image_' + index + '" value="' + value.image + '">';
            html += '</div>';
            html += '</div>';
            // $("#section_five_about_grid_image_" + index).val(value.image);
            // $("#edit-show-section-five-about-grid-image-" + index + " img").attr('src', url + '/assets/website/images/about/icon/' + value.image);
        });
        $(".data-about-grid").html(html);

    }).catch(error => {
        return error;
    });
});