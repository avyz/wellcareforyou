
// Get Dropdown Role for Users Create Modal
$(document).on('click', 'button[data-bs-target="#usersCreateModal"]', function () {
    const data = {
        method: 'get_data'
    };
    getDropdown(data, '/user-management/data-dropdown-role', 'role', 'uuid', 'role_id', 'usersCreate', 'role', 'add');
});

// Create User
$(document).on('submit', '#usersCreate', function (e) {
    e.preventDefault();
    const data = $(this).serializeArray();

    post(url + '/user-management/users/create-user', 'users-ui-table', 'usersCreate', data);
});

// Get Data User for Edit
$(document).on('click', '#editUsers', function () {
    const user_id = $(this).data('user_id');
    $.ajax({
        url: url + '/user-management/users/edit-user',
        type: 'GET',
        data: {
            user_id: user_id,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;

            const data_values = {
                role_id: data.role_uuid,
                method: 'get_data'
            };
            getDropdown(data_values, '/user-management/data-dropdown-role', 'role', 'uuid', 'edit_role_id_user', 'usersEdit', 'role', 'edit', 'role_id');

            // Access the data returned from the AJAX request here
            $('#edit_user_id').val(data.uuid);
            $('#edit_nama_depan').val(data.nama_depan);
            $('#edit_nama_belakang').val(data.nama_belakang);
            $('#edit_email_user').val(data.email);
            $('#edit_role_id').val(data.role_id);
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

// Edit User
$(document).on('submit', '#usersEdit', function (e) {
    e.preventDefault();
    let data = $(this).serializeArray();
    data.push({ name: 'type', value: 'edit' });
    var formData = {};
    $.each(data, function () {
        formData[this.name] = this.value;
    });
    put(url + '/user-management/users/edit-user', 'users-ui-table', 'usersEdit', formData);
});

// create role
$(document).on('submit', '#rolesCreate', function (e) {
    e.preventDefault();
    let data = $(this).serializeArray();

    post(url + '/user-management/roles/create-role', 'roles-ui-table', 'rolesCreate', data);
});

// get data role for edit
$(document).on('click', '#editRole', function () {
    const role_id = $(this).data('role_id');
    $.ajax({
        url: url + '/user-management/roles/edit-role',
        type: 'GET',
        data: {
            role_id: role_id,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            $('#edit_role_id').val(data.uuid);
            $('#edit_role').val(data.role);
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
$(document).on('submit', '#rolesEdit', function (e) {
    e.preventDefault();
    let data = $(this).serializeArray();
    data.push({ name: 'type', value: 'edit' });
    var formData = {};
    $.each(data, function () {
        formData[this.name] = this.value;
    });
    put(url + '/user-management/roles/edit-role', 'roles-ui-table', 'rolesEdit', formData);
});

// Onclick create data role menu management
// $(document).on('click', 'button[data-bs-target="#rolesCreateModal"]', function () {
//     menuRole.ajax.reload();
// });

// function formatChildTable(data) {
//     let html = '';
//     if (data.length > 0) {
//         html += '<div class="table-responsive">';
//         html += '<table class="table dt-table-hover" style="width:100%">';
//         html += '<thead>';
//         html += '<tr>';
//         html += '<th></th>';
//         html += '<th>No</th>';
//         html += '<th>Submenu Name</th>';
//         html += '<th>View</th>';
//         html += '<th>Create</th>';
//         html += '<th>Edit</th>';
//         html += '<th>Delete</th>';
//         html += '<th>CSV</th>';
//         html += '<th>Excel</th>';
//         html += '<th>Print</th>';
//         html += '</tr>';
//         html += '</thead>';
//         html += '<tbody>';
//         $.each(data, function (index, value) {
//             html += '<tr>';
//             html += `<td><h5 onclick="clickChildrenTab(this, ` + "'" + '/user-management/menu-management-role-child-tab' + "'" + `, ` + "'" + 'menu_children_uuid' + "'" + `, formatChildTabTable, ` + "'" + '/user-management/menu-management-role-child' + "'" + `, ` + "'" + value.menu_uuid + "'" + `);toggleClick(this, ` + "'" + 'ri-arrow-down-s-line' + "'" + `, ` + "'" + 'ri-arrow-right-s-line' + "'" + `)" class="ri-arrow-right-s-line" style="cursor:pointer;"></h5></td>`;
//             html += `<td>${value.number}</td>`;
//             html += `<td>${value.menu_children_name}</td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_view[]" value="${value.menu_children_uuid}"></td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_create[]" value="${value.menu_children_uuid}"></td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_edit[]" value="${value.menu_children_uuid}"></td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_delete[]" value="${value.menu_children_uuid}"></td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_buttons_csv[]" value="${value.menu_children_uuid}"></td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_buttons_excel[]" value="${value.menu_children_uuid}"></td>`;
//             html += `<td><input type="checkbox" data-menu_uuid="${value.menu_uuid}" name="menu_children_buttons_print[]" value="${value.menu_children_uuid}"></td>`;
//             html += '</tr>';
//         });
//         html += '</tbody>';
//         html += '</table>';
//         html += '</div>';
//     } else {
//         html += '<div class="table-responsive text-center">';
//         html += `<input type="hidden" name="menu_uuid_children[]" value="0"><input type="hidden" name="menu_children_uuid[]" value="0">No Data`;
//         html += '</div>';
//     }
//     return html;
// }

// function formatChildTabTable(data) {
//     let html = '';
//     if (data.length > 0) {
//         html += '<div class="table-responsive">';
//         html += '<table class="table dt-table-hover" style="width:100%">';
//         html += '<thead>';
//         html += '<tr>';
//         html += '<th></th>';
//         html += '<th>No</th>';
//         html += '<th>Tab Name</th>';
//         html += '<th>View</th>';
//         html += '<th>Create</th>';
//         html += '<th>Edit</th>';
//         html += '<th>Delete</th>';
//         html += '<th>CSV</th>';
//         html += '<th>Excel</th>';
//         html += '<th>Print</th>';
//         html += '</tr>';
//         html += '</thead>';
//         html += '<tbody>';
//         $.each(data, function (index, value) {
//             html += '<tr>';
//             html += `<td><input type="hidden" name="menu_children_uuid_tab[]" value="${value.menu_children_uuid}"><input type="hidden" name="menu_tab_uuid[]" value="${value.menu_tab_uuid}"></td>`;
//             html += `<td>${value.number}</td>`;
//             html += `<td>${value.menu_tab_name}</td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_view[]" value="1"></td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_create[]" value="1"></td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_edit[]" value="1"></td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_delete[]" value="1"></td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_buttons_csv[]" value="1"></td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_buttons_excel[]" value="1"></td>`;
//             html += `<td><input type="checkbox" name="menu_children_tab_buttons_print[]" value="1"></td>`;
//             html += '</tr>';
//         });
//         html += '</tbody>';
//         html += '</table>';
//         html += '</div>';
//     } else {
//         html += '<div class="table-responsive text-center">';
//         html += 'No Data';
//         html += '</div>';
//     }
//     return html;
// }