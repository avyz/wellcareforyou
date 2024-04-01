// Pages

// $(document).on('click', 'button[data-bs-target="#pagesCreateModal"]', function () {
//     let length_data = $("#pages-ui-table>tbody>tr").length;
//     $('#pagesCreate input[name="navbar_management_number"]').attr(length_data + 1);
// });

// create pages
$(document).on('submit', '#pagesCreate', function (e) {
    e.preventDefault();
    let formData = $(this).serializeArray();
    post(url + '/pages/create-navbar', 'pages-ui-table', 'pagesCreate', formData);
});

// get data pages for edit
$(document).on('click', '#editPages', function () {
    const navbar_management_id = $(this).data('navbar_management_id');
    $.ajax({
        url: url + '/pages/edit-navbar',
        type: 'GET',
        data: {
            navbar_management_id: navbar_management_id,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            $('#edit_navbar_management_id').val(data.uuid);
            $('#edit_navbar_management_name').val(data.navbar_management_name);
            $('#edit_navbar_management_number').val(data.page_number);
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

// edit pages
$(document).on('submit', '#pagesEdit', function (e) {
    e.preventDefault();
    let data = $(this).serializeArray();
    data.push({ name: 'type', value: 'edit' });
    var formData = {};
    $.each(data, function () {
        formData[this.name] = this.value;
    });
    put(url + '/pages/edit-navbar', 'pages-ui-table', 'pagesEdit', formData);
});

// Group Pages

// $(document).on('click', 'button[data-bs-target="#groupPagesCreateModal"]', function () {
//     let lang_code = $("#groupPagesCreate select[name='lang_code']").val();
//     const data = {
//         lang_code: lang_code,
//         method: 'get_data'
//     };
//     getDropdown(data, '/group-pages/data-group-pages', 'navbar_management_group_name', 'uuid', 'navbar_management_group_id', 'groupPagesCreate', 'group_pages', 'add');
// });

// $(document).on('change', '#groupPagesCreate select[name="lang_code"]', function () {
//     let lang_code = $(this).val();
//     const data = {
//         lang_code: lang_code,
//         method: 'get_data'
//     };
//     getDropdown(data, '/group-pages/data-group-pages', 'navbar_management_group_name', 'uuid', 'navbar_management_group_id', 'groupPagesCreate', 'group_pages', 'add');
// });

// create pages
$(document).on('submit', '#groupPagesCreate', function (e) {
    e.preventDefault();
    let formData = $(this).serializeArray();

    post(url + '/group-pages/create-navbar', 'group-pages-ui-table', 'groupPagesCreate', formData);
});

// get data pages for edit
$(document).on('click', '#editGroupPages', function () {
    const navbar_management_group_id = $(this).data('navbar_management_group_id');
    $.ajax({
        url: url + '/group-pages/edit-navbar',
        type: 'GET',
        data: {
            navbar_management_group_id: navbar_management_group_id,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            $('#edit_navbar_management_group_id').val(data.uuid);
            $('#edit_navbar_management_group_name').val(data.navbar_management_group_name);
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

// edit pages
$(document).on('submit', '#groupPagesEdit', function (e) {
    e.preventDefault();
    let data = $(this).serializeArray();
    data.push({ name: 'type', value: 'edit' });
    var formData = {};
    $.each(data, function () {
        formData[this.name] = this.value;
    });
    put(url + '/group-pages/edit-navbar', 'group-pages-ui-table', 'groupPagesEdit', formData);
});