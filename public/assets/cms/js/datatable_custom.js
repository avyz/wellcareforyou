// var lastPage = localStorage.getItem('lastPage') || 0;
// var dataLength = localStorage.getItem('length');
// Buttons Property Datatable

const buttons = (data) => {
    return {
        buttons: [
            {
                extend: 'csv',
                className: 'btn',
                action: function (e, dt, button, config) {
                    metaLanguage = $('meta[name="language"]').attr('content');
                    // Mendapatkan seluruh data dari AJAX response
                    $.ajax({
                        url: '/menu-management/action-buttons',
                        type: 'GET',
                        data: {
                            ...data,
                            lang_code: metaLanguage,
                            buttons: "csv",
                        },
                        success: function (response) {

                            window.open("/menu-management/action-buttons?columnName=" + data.columnName + "&modelName=" + data.modelName + "&header=" + data.header.join(",") + "&column=" + data.column.join(",") + "&buttons=csv&lang_code=" + metaLanguage + "&methodName=" + data.methodName);
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
            },
            {
                extend: 'excel',
                className: 'btn',
                action: function (e, dt, button, config) {
                    metaLanguage = $('meta[name="language"]').attr('content');
                    // Mendapatkan seluruh data dari AJAX response
                    $.ajax({
                        url: '/menu-management/action-buttons',
                        type: 'GET',
                        data: {
                            ...data,
                            lang_code: metaLanguage,
                            buttons: 'excel'
                        },
                        success: function (response) {
                            window.open("/menu-management/action-buttons?columnName=" + data.columnName + "&modelName=" + data.modelName + "&header=" + data.header.join(",") + "&column=" + data.column.join(",") + "&buttons=excel&lang_code=" + metaLanguage + "&methodName=" + data.methodName);
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
            },
            {
                extend: 'print',
                className: 'btn',
                action: function (e, dt, node, config) {
                    metaLanguage = $('meta[name="language"]').attr('content');
                    $.ajax({
                        url: "/menu-management/action-buttons",
                        type: "GET",
                        data: {
                            ...data,
                            lang_code: metaLanguage,
                            buttons: 'print'
                        },
                        dataType: "json",
                        success: function (response) {
                            // Tanggapi respons dari server
                            const fullData = response.data;

                            const dataSelected = { header: data.header, column: data.column };
                            var selectedColumns = dataSelected;

                            // Membuat HTML untuk tabel sementara
                            var printContent = '<div class="table-responsive"><table class="table dt-table-hover"><thead><tr>';
                            $.each(selectedColumns.header, function (index, column) {
                                printContent += '<th>' + column + '</th>';
                            });
                            printContent += '</tr></thead><tbody>';
                            $.each(fullData, function (index, rowData) {
                                printContent += '<tr>';
                                $.each(selectedColumns.column, function (index, column) {
                                    printContent += '<td class="text-wrap">' + rowData[column] + '</td>';
                                });
                                printContent += '</tr>';
                            });
                            printContent += '</tbody></table></div>';

                            // Membuka tab baru untuk mencetak
                            var printWindow = window.open('', '_blank');
                            printWindow.document.open();
                            printWindow.document.write('<html><head>' + document.head.innerHTML + '</head><body>');
                            printWindow.document.write(printContent);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();

                            // Mencetak
                            printWindow.print();

                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            }
        ]
    }
}

// Dom Property Datatable
const dom = () => {
    return "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>";
}

const language = () => {
    return {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
    }
}

const initialComplete = (settings, json, wrapperSelector, modalName = "") => {
    // console.log(json);
    // json?.buttons.map((item, index) => {
    //     if (!item.isShow) {
    //         $('#' + wrapperSelector + ' .' + item.name).hide();
    //     }
    // })

    var tabs_active = $(".menutab>.nav-link.active");
    var table_active = $('#' + wrapperSelector);
    if (tabs_active.length > 0) {
        tabs_active[0]?.dataset?.edit === "1" ? $(".buttons-edit").attr("disabled", false) : $(".buttons-edit").attr("disabled", true);
        tabs_active[0]?.dataset?.delete === "1" ? $(".buttons-delete").show() : $(".buttons-delete").hide();
        tabs_active[0]?.dataset?.buttons_csv === "1" ? $(".buttons-csv").show() : $(".buttons-csv").hide();
        tabs_active[0]?.dataset?.buttons_excel === "1" ? $(".buttons-excel").show() : $(".buttons-excel").hide();
        tabs_active[0]?.dataset?.buttons_print === "1" ? $(".buttons-print").show() : $(".buttons-print").hide();
    } else {
        table_active[0]?.dataset?.create === "1" ? ($("#create-btn").attr("data-bs-target", "#" + modalName), $("#create-btn").show()) : ($("#create-btn").attr("data-bs-target", ""), $("#create-btn").hide());
        table_active[0]?.dataset?.edit === "1" ? $(".buttons-edit").attr("disabled", false) : $(".buttons-edit").attr("disabled", true);
        table_active[0]?.dataset?.delete === "1" ? $(".buttons-delete").show() : $(".buttons-delete").hide();
        table_active[0]?.dataset?.buttons_csv === "1" ? $(".buttons-csv").show() : $(".buttons-csv").hide();
        table_active[0]?.dataset?.buttons_excel === "1" ? $(".buttons-excel").show() : $(".buttons-excel").hide();
        table_active[0]?.dataset?.buttons_print === "1" ? $(".buttons-print").show() : $(".buttons-print").hide();
    }
}

// Admin
// MENU
// var menu_lang_code = metaLanguage;
const menu_ui_table = $('#menu-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/menu-management/data-menu",
        "type": "GET",
        // "data": {
        //     lang_code: menu_lang_code,
        // },
    },
    "dom": dom(),
    buttons: buttons(
        {
            columnName: "menu_id",
            modelName: "dataMenu",
            methodName: "menuManagementModel",
            column: ['number',
                'menu_name',
                'menu_slug',
                'menu_icon',
                'menu_url',
                'created_at'],
            header: [
                'No',
                'Menu',
                'Slug',
                'Icon',
                'Url',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    // "displayStart": lastPage,
    "columns": [
        {
            "data": 'menu_number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return `<div class='text-center'>${row.menu_number}</div>`;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                return `<div><span>${row.menu_name}</span><br><small class="badge badge-info">${row.menu_slug}</small></div>`;
            }
        },
        {
            "data": "menu_icon",
            "orderable": false,
            "render": function (data, type, row, meta) {
                // console.log(row.menu_icon);
                return row.menu_icon; // Ini akan menampilkan ikon HTML
            }
        },
        {
            "data": "menu_url",
            "orderable": false
        },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-menu_id=" + row.uuid + " id='editMenu' data-bs-toggle='modal' data-bs-target='#menuEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/menu-management/admin/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.menu_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="menu-ui-table" data-namesec="menu" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/menu-management/admin/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.menu_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="menu-ui-table" data-namesec="menu" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'menu-ui-table_wrapper');
    }
});

// SUBMENU
const submenu_ui_table = $('#submenu-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/menu-management/submenu",
        "type": "GET",
        // "data": {
        //     lang_code: metaLanguage
        // }
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "menu_children_id",
            modelName: "dataSubmenu",
            methodName: "menuManagementModel",
            column: ['number',
                'menu_name',
                'menu_children_name',
                'menu_children_url',
                'created_at'],
            header: [
                'No',
                'Menu',
                'Submenu',
                'Url',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    // "displayStart": lastPage,
    "columns": [
        {
            "data": 'number',
            "render": function (data, type, row, meta) {
                // return meta.row + meta.settings._iDisplayStart + 1;
                return row.number;
            }
        },
        { "data": "menu_name", "orderable": true },
        { "data": "menu_children_name", "orderable": false },
        {
            "data": "menu_children_url",
            "orderable": false,
        },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-menu_children_id=" + row.menu_children_uuid + " id='editSubmenu' data-bs-toggle='modal' data-bs-target='#submenuEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/menu-management/admin/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.menu_children_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="submenu-ui-table" data-namesec="menu_children" data-id="' + row.menu_children_uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/menu-management/admin/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.menu_children_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="submenu-ui-table" data-namesec="menu_children" data-id="' + row.menu_children_uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'submenu-ui-table_wrapper');
    }
});

// TAB
const tab_ui_table = $('#tab-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/menu-management/tabmenu",
        "type": "GET",
        // "data": {
        //     lang_code: metaLanguage
        // }
    },
    "dom": dom(),

    buttons: buttons({
        columnName: "menu_tab_id",
        modelName: "dataTabMenu",
        methodName: "menuManagementModel",
        column: ['number',
            'menu_name',
            'menu_children_name',
            'menu_tab_name',
            'created_at'],
        header: [
            'No',
            'Menu',
            'Submenu',
            'Tabmenu',
            'Created Date'
        ]
    }),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    // "displayStart": lastPage,
    "columns": [
        {
            "data": 'number',
            "render": function (data, type, row, meta) {
                // return meta.row + meta.settings._iDisplayStart + 1;
                return row.number;
            }
        },
        { "data": "menu_name", "orderable": true },
        { "data": "menu_children_name", "orderable": true },
        { "data": "menu_tab_name", "orderable": false },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {

                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-menu_tab_id=" + row.menu_tab_uuid + " id='editTabmenu' data-bs-toggle='modal' data-bs-target='#tabEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/menu-management/admin/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.menu_tab_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="tab-ui-table" data-namesec="menu_children_tab" data-id="' + row.menu_tab_uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/menu-management/admin/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.menu_tab_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="tab-ui-table" data-namesec="menu_children_tab" data-id="' + row.menu_tab_uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'tab-ui-table_wrapper');
    },
    // drawCallback: function (settings) {
    //     var api = this.api();
    //     var pageInfo = api.page.info();

    //     // var start = ;
    //     var info = {
    //         ...pageInfo,
    //         "start": parseInt(pageInfo.start)
    //     }
    //     // console.log(settings.json)
    //     localStorage.setItem('lastPage', info.start);
    // }
});

// USER MANAGEMENT
// User
$('#users-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/user-management/data-user",
        "type": "GET"
    },
    "dom": dom(),

    buttons: buttons({
        columnName: "user_id",
        modelName: "dataUser",
        methodName: "userManagementModel",
        column: ['number',
            'nama_lengkap',
            'email',
            'role',
            'created_at'],
        header: [
            'No',
            'Full Name',
            'Email',
            'Role',
            'Created Date'
        ]
    }),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    // "displayStart": lastPage,
    "columns": [
        {
            "data": 'number',
            "render": function (data, type, row, meta) {
                // return meta.row + meta.settings._iDisplayStart + 1;
                return row.number;
            }
        },
        { "data": "nama_lengkap", "orderable": true },
        { "data": "email", "orderable": false },
        { "data": "role", "orderable": false },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.auth_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-user_id=" + row.uuid + " id='editUsers' data-bs-toggle='modal' data-bs-target='#usersEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.auth_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/user-management/user-management/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.nama_lengkap + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="users-ui-table" data-namesec="auth" data-id="' + row.auth_uuid + '" class="buttons-delete ms-1"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/user-management/user-management/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.nama_lengkap + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="users-ui-table" data-namesec="auth" data-id="' + row.auth_uuid + '" class="buttons-delete ms-1"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'users-ui-table_wrapper');
    },
});

// Role
$('#roles-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/user-management/data-role",
        "type": "GET"
    },
    "dom": dom(),

    buttons: buttons({
        columnName: "role_id",
        modelName: "dataRole",
        methodName: "userManagementModel",
        column: ['number',
            'role',
            'created_at'],
        header: [
            'No',
            'Role Name',
            'Created Date'
        ]
    }),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    // "displayStart": lastPage,
    "columns": [
        {
            "data": 'number',
            "render": function (data, type, row, meta) {
                // return meta.row + meta.settings._iDisplayStart + 1;
                return row.number;
            }
        },
        { "data": "role", "orderable": true },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-role_id=" + row.uuid + " id='editRole' data-bs-toggle='modal' data-bs-target='#rolesEditModal'><i class='ri-pencil-line'></i></button>";
                button += '<a class="buttons-edit" href="/user-management/management/roles/menu?role=' + row.role.toLowerCase() + '&role_uuid=' + row.uuid + '&lang_code=' + metaLanguage + '" target="_blank" class="buttons-edit"><button class="btn mx-1 px-2 py-1 btn-info"><i class="ri-menu-add-fill"></i></button></a>';
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/user-management/user-management/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.role + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="roles-ui-table" data-namesec="role" data-id="' + row.uuid + '" class="buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/user-management/user-management/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.role + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="roles-ui-table" data-namesec="role" data-id="' + row.uuid + '" class="buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'roles-ui-table_wrapper');
    },
});


// Role
// Data role with menu management
// $('#menu-management-ui-table').DataTable({
//     "processing": true,
//     "serverSide": true,
//     "ajax": {
//         "url": url + "/user-management/menu-management-role",
//         "type": "GET",
//         "data": {
//             lang_code: metaLanguage,
//             role_uuid: $(this).data('role_uuid')
//         }
//     },
//     "dom": dom(),
//     buttons: [],
//     "oLanguage": language(),
//     "stripeClasses": [],
//     "lengthMenu": [7, 10, 20, 50],
//     "pageLength": 10,
//     // "displayStart": lastPage,
//     "columns": [
//         { "data": "number", "orderable": true },
//         { "data": "menu_name", "orderable": true },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {
//                 if (row.view == 1) {
//                     return '<input type="checkbox" name="view[]" value="' + row.uuid + '" checked>';
//                 }
//                 return '<input type="checkbox" name="view[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {

//                 if (row.create == 1) {
//                     return '<input type="checkbox" name="create[]" value="' + row.uuid + '" checked>';
//                 }

//                 return '<input type="checkbox" name="create[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {

//                 if (row.edit == 1) {
//                     return '<input type="checkbox" name="edit[]" value="' + row.uuid + '" checked>';
//                 }

//                 return '<input type="checkbox" name="edit[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {

//                 if (row.delete == 1) {
//                     return '<input type="checkbox" name="delete[]" value="' + row.uuid + '" checked>';
//                 }

//                 return '<input type="checkbox" name="delete[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {

//                 if (row['buttons-csv'] == 1) {
//                     return '<input type="checkbox" name="buttons_csv[]" value="' + row.uuid + '" checked>';
//                 }

//                 return '<input type="checkbox" name="buttons_csv[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {

//                 if (row['buttons-excel'] == 1) {
//                     return '<input type="checkbox" name="buttons_excel[]" value="' + row.uuid + '" checked>';
//                 }

//                 return '<input type="checkbox" name="buttons_excel[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row) {

//                 if (row['buttons-print'] == 1) {
//                     return '<input type="checkbox" name="buttons_print[]" value="' + row.uuid + '" checked>';
//                 }

//                 return '<input type="checkbox" name="buttons_print[]" value="' + row.uuid + '">';
//             }
//         },
//         {
//             "data": null,
//             "orderable": false,
//             "render": function (data, type, row, meta) {
//                 var button = '';
//                 if (row.menu_management_uuid) {
//                     button += '<a href="/user-management/menu-management-submenu?menu_uuid=' + row.uuid + '&menu_management_uuid=' + row.menu_management_uuid + '" target="_blank"><button class="btn px-2 py-1 btn-info"><i class="ri-menu-add-fill"></i></button></a>';
//                 } else {
//                     button += '<button class="btn px-2 py-1 btn-info" disabled><i class="ri-menu-add-fill"></i></button>';
//                 }
//                 return button;
//             }
//         }
//     ],
// });


// Log User
const table_log = $('#loguser-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/user-management/data-log-user",
        "type": "GET"
    },
    "dom": dom(),

    buttons: [],
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    // "displayStart": lastPage,
    "columns": [
        {
            "data": 'number',
            "orderable": false,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                // return row.number;
            }
        },
        { "data": "email", "orderable": true },
        { "data": "role", "orderable": false },
        { "data": "activity", "orderable": false },
        { "data": "description", "orderable": false },
        { "data": "created_at", "orderable": false }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'loguser-ui-table_wrapper');
    }
});

$(document).on("click", "#filter-log", function () {
    var date_start = $('#date_start_log').val();
    var date_end = $('#date_end_log').val();

    table_log.ajax.url(url + "/user-management/data-log-user?date_start=" + date_start + "&date_end=" + date_end).load();
});

// Log Auth
const table_auth = $('#logauth-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/user-management/data-log-auth",
        "type": "GET"
    },
    "dom": dom(),

    buttons: [],
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": false,
            "render": function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            "data": "email",
            "orderable": true,
            "render": function (data, type, row, meta) {
                if (row.email == null) {
                    return "Unknown";
                } else {
                    return row.email;
                }
            }

        },
        { "data": "activity", "orderable": false },
        { "data": "description", "orderable": false },
        { "data": "created_at", "orderable": false }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'logauth-ui-table_wrapper');
    }
});

$(document).on("click", "#filter-auth", function () {
    var date_start = $('#date_start_auth').val();
    var date_end = $('#date_end_auth').val();

    table_auth.ajax.url(url + "/user-management/data-log-auth?date_start=" + date_start + "&date_end=" + date_end).load();
});

// Setting Language
$('#language-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/setting/data-language",
        "type": "GET"
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "lang_id",
            modelName: "dataLanguage",
            methodName: "languageModel",
            column: ['number',
                'language',
                'lang_code',
                'lang_icon',
                'created_at'],
            header: [
                'No',
                'Language',
                'Code',
                'Icon',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": false,
            "render": function (data, type, row, meta) {
                return row.number;
            }
        },
        {
            "data": "language",
            "orderable": true

        },
        { "data": "lang_code", "orderable": false },
        { "data": "lang_icon", "orderable": false },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-lang_id=" + row.uuid + " id='editLanguage' data-bs-toggle='modal' data-bs-target='#languageEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/setting/language/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.language + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="language-ui-table" data-namesec="lang" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/setting/language/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.language + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="language-ui-table" data-namesec="lang" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'language-ui-table', 'languageCreateModal');
    }
});

// Pages
// Navbar
const pages_ui_table = $('#pages-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/pages/data-navbar",
        "type": "GET",
        // "data": {
        //     "lang_code": metaLanguage
        // }
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "navbar_management_id",
            modelName: "dataPages",
            methodName: "pagesModel",
            column: ['number',
                'lang_code',
                'navbar_management_name',
                'navbar_management_url',
                'created_at'],
            header: [
                'No',
                'Lang Code',
                'Page Name',
                'Page Url',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'page_number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return row.page_number;
            }
        },
        {
            "data": "navbar_management_name",
            "orderable": true

        },
        { "data": "navbar_management_url", "orderable": false },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-navbar_management_id=" + row.uuid + " id='editPages' data-bs-toggle='modal' data-bs-target='#pagesEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/pages/pages/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.navbar_management_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="pages-ui-table" data-namesec="page_navbar" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/pages/pages/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.navbar_management_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="pages-ui-table" data-namesec="page_navbar" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'pages-ui-table', 'pagesCreateModal');
    }
});

// Group Navbar
const group_pages_ui_table = $('#group-pages-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/group-pages/data-navbar",
        "type": "GET"
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "navbar_management_group_id",
            modelName: "dataGroupPages",
            methodName: "groupPagesModel",
            column: ['number',
                'lang_code',
                'navbar_management_group_name',
                'created_at'],
            header: [
                'No',
                'Lang Code',
                'Group Page Name',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": false,
            "render": function (data, type, row, meta) {
                return row.number;
            }
        },
        {
            "data": "navbar_management_group_name",
            "orderable": true

        },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                metaLanguage = $('meta[name="language"]').attr('content');
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-navbar_management_group_id=" + row.uuid + " id='editGroupPages' data-bs-toggle='modal' data-bs-target='#groupPagesEditModal'><i class='ri-pencil-line'></i></button>";
                button += '<a class="buttons-edit" href="/pages/group-pages/page-list?&navbar_management_group_uuid=' + row.uuid + '&lang_code=en&lang_view=' + metaLanguage + '&page=' + row.navbar_management_group_name.toLowerCase() + '" target="_blank" class="buttons-edit"><button class="btn mx-1 px-2 py-1 btn-info"><i class="ri-pages-line"></i></button></a>';
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/pages/group-pages/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.navbar_management_group_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="group-pages-ui-table" data-namesec="page_navbar_group" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/pages/group-pages/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.navbar_management_group_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="group-pages-ui-table" data-namesec="page_navbar_group" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'group-pages-ui-table', 'groupPagesCreateModal');
    }
});

// Hospital Location
const hospitalLocation = $('#hospital-location-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/setting/data-language",
        "type": "GET"
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "number",
            modelName: "dataLocation",
            methodName: "hospitalModel",
            column: ['number',
                'language',
                'hospital_location_code',
                'hospital_location_name',
                'created_at'],
            header: [
                'No',
                'Country',
                'State Code',
                'State',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return '<div class="d-flex align-items-center"><i style="font-size:1.2rem;cursor:pointer" onclick="toggleClick(this, ' + "'" + 'ri-arrow-right-s-line' + "'" + ', ' + "'" + 'ri-arrow-down-s-line' + "'" + ');clickChildren(this, ' + "'" + '/hospital/data-hospital-location' + "'" + ', ' + "'" + 'uuid' + "'" + ', formatHospitalLocationChildTable, hospitalLocation)" class="expand ri-arrow-right-s-line"></i> ' + row.number + '</div>';
            }
        },
        {
            "data": "language",
            "orderable": true

        },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-lang_id=" + row.uuid + " id='editLocation' data-bs-toggle='modal' data-bs-target='#locationEditModal'><i class='ri-pencil-line'></i></button>";
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'hospital-location-ui-table', 'locationCreateModal');
    }
});

// Hospital
const hospitalDatatable = $('#hospital-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/hospital/data-hospital",
        "type": "GET"
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "hospital_name",
            modelName: "dataHospitalWithBranch",
            methodName: "hospitalModel",
            column: [
                'hospital_name',
                'hospital_location_name',
                'hospital_address',
                'hospital_phone',
                'hospital_map_location',
                'hospital_country',
                'is_center',
                'created_at'],
            header: [
                'Hospital',
                'State',
                'Address',
                'Phone',
                'Map',
                'Country',
                'HQ',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return '<div class="d-flex align-items-center"><i style="font-size:1.2rem;cursor:pointer" onclick="toggleClick(this, ' + "'" + 'ri-arrow-right-s-line' + "'" + ', ' + "'" + 'ri-arrow-down-s-line' + "'" + ');clickChildren(this, ' + "'" + '/hospital/data-hospital-branch' + "'" + ', ' + "'" + 'uuid' + "'" + ', formatHospitalChildTable, hospitalDatatable)" class="expand ri-arrow-right-s-line"></i> ' + row.number + '</div>';
            }
        },
        {
            "data": "hospital_image",
            "orderable": false,
            "render": function (data, type, row, meta) {
                return '<img src="' + url + '/assets/website/images/hospital/' + row.hospital_image + '" alt="' + row.hospital_name + '" class="img-thumbnail" style="width: 120px;">';
            }

        },
        {
            "data": "hospital_name",
            "orderable": true,
            "render": function (data, type, row, meta) {
                return '<div>' + row.hospital_name + '<br><span><i>' + row.hospital_code + '</i></span><br><small class="badge badge-success"><i>Hospital HQ</i></small></div>';
            }

        },
        {
            "data": "hospital_phone",
            "orderable": false

        },
        {
            "data": "hospital_address",
            "orderable": false,
            "render": function (data, type, row, meta) {
                return '<a class="text-primary" href="' + row.hospital_map_location + '" target="_blank">' + row.hospital_address + ' - ' + row.hospital_location_name + '</a>';
            }

        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-hospital_id='" + row.uuid + "' data-hospital_name='" + row.hospital_name + "' data-hq_hospital_country='" + row.hospital_country_uuid + "' data-hq_hospital_location_uuid='" + row.hospital_location_uuid + "' data-hq_hospital_phone='" + row.hospital_phone + "' data-hq_hospital_map_location='" + row.hospital_map_location + "' data-hq_hospital_address='" + row.hospital_address + "' data-hospital_image='" + row.hospital_image + "' id='editHospital' data-bs-toggle='modal' data-bs-target='#hospitalEditModal'><i class='ri-pencil-line'></i></button>";
                button += '<a href="/hospital/hospital/packages?hospital_uuid=' + row.uuid + '&hospital_name=' + row.hospital_name + '&hospital_code=' + row.hospital_code + '&lang_code=' + metaLanguage + '" target="_blank" class="ms-1 buttons-edit"><button class="btn px-2 py-1 btn-info"><i class="ri-menu-add-line"></i></button></a>';
                button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/hospital/hospital/deleted` + "'" + ', ' + "'" + `Are you sure want to delete ` + row.hospital_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="hospital-ui-table" data-namesec="hospital" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-delete-bin-line"></i></button></a>';
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'hospital-ui-table', 'hospitalCreateModal');
    }
});

// Packages
const hospital_uuid = $("#packages-ui-table").data("hospital_uuid");
$('#packages-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/hospital/data-packages",
        "type": "GET",
        "data": {
            "hospital_uuid": hospital_uuid,
            "lang_code": metaLanguage
        }
    },
    "dom": dom(),

    "buttons": [],
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return row.number;
            }
        },
        {
            "data": "package_title",
            "orderable": false,
            "render": function (data, type, row, meta) {
                return '<div class="text-wrap">' + row.package_title + '</div>';
            }

        },
        {
            "data": "created_at",
            "orderable": true,
            "render": function (data, type, row, meta) {
                return row.created_at;
            }

        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                // window.location.href=" + '"' + url + '/hospital/hospital/package/update?hospital_package_uuid=' + row.uuid + '&hospital_uuid=' + row.hospital_uuid + '&hospital_name=' + row.hospital_name + '&hospital_code=' + row.hospital_code + '&lang_code=' + row.lang_code + '&action_type=edit' + "
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' onclick='window.location.href=\"" + url + "/hospital/hospital/package/update?hospital_package_uuid=" + row.uuid + "&hospital_uuid=" + row.hospital_uuid + "&hospital_name=" + row.hospital_name + "&hospital_code=" + row.hospital_code + "&lang_code=" + row.lang_code + "&action_type=edit\"'><a href='javascript:void(0)' class='text-white'><i class='ri-pencil-line'></i></a></button>";
                button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/hospital/hospital-package/deleted` + "'" + ', ' + "'" + `Are you sure want to delete ` + row.package_title + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="packages-ui-table" data-namesec="hospital_package" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-delete-bin-line"></i></button></a>';
                return button;
            }
        }
    ],
});

// Specialist
const specialist_ui_table = $('#specialist-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/doctor/data-doctor-specialist",
        "type": "GET",
        // "data": {
        //     "lang_code": metaLanguage
        // }
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "doctor_specialist_id",
            modelName: "dataDoctorSpecialistWithSpecialistDesc",
            methodName: "doctorModel",
            column: ['number',
                'lang_code',
                'specialist_name',
                'specialist_desc',
                'created_at'],
            header: [
                'No',
                'Lang Code',
                'Specialist Name',
                'Specialist Description',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return row.number;
            }
        },
        {
            "data": "specialist_name",
            "orderable": true

        },
        // {
        //     "data": "specialist_desc",
        //     "orderable": true,
        //     "render": function (data, type, row, meta) {
        //         return '<div class="text-wrap">' + row.specialist_desc + '</div>';
        //     }

        // },
        {
            "data": null,
            "orderable": false,
            render: function (data, type, row, meta) {
                // console.log(row);
                let html = "";
                if (row.is_active == 1) {
                    html = 'Active'
                } else {
                    html = 'Inactive'
                }
                return html;
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-specialist_id=" + row.uuid + " id='editSpecialist' data-bs-toggle='modal' data-bs-target='#specialistEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/hospital/specialist/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.specialist_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="specialist-ui-table" data-namesec="doctor_specialist" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/hospital/specialist/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.specialist_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="specialist-ui-table" data-namesec="doctor_specialist" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
                }
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'specialist-ui-table', 'specialistCreateModal');
    }
});

// Doctor
const doctor_ui_table = $('#doctors-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/doctor/data-doctor",
        "type": "GET",
        "data": {
            "lang_code": metaLanguage
        }
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "doctor_id",
            modelName: "dataDoctorComplete",
            methodName: "doctorModel",
            column: ['number',
                'doctor_name',
                'doctor_phone',
                'doctor_language',
                'doctor_specialist',
                'doctor_hospital',
                'doctor_address',
                'created_at'],
            header: [
                'No',
                'Doctor Name',
                'Phone',
                'Lang Code',
                'Specialist',
                'Hospital',
                'Address',
                'Created Date'
            ]
        }
    ),
    "oLanguage": language(),
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 10,
    "columns": [
        {
            "data": 'number',
            "orderable": true,
            "render": function (data, type, row, meta) {
                return row.number;
            }
        },
        {
            "data": "doctor_image",
            "orderable": false,
            "render": function (data, type, row, meta) {
                return '<img src="' + url + '/assets/website/images/doctor/' + row.doctor_image + '" alt="' + row.doctor_name + '" class="img-thumbnail" style="width: 120px;">';
            }

        },
        {
            "data": "doctor_name",
            "orderable": true

        },
        {
            "data": "doctor_phone",
            "orderable": false

        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row, meta) {
                var button = "<button class='buttons-edit btn px-2 py-1 btn-primary' data-doctor_id=" + row.uuid + " id='editDoctor' data-bs-toggle='modal' data-bs-target='#doctorEditModal'><i class='ri-pencil-line'></i></button>";
                button += '<a href="javascript:void(0)" onclick="del(this, ' + "'" + `/doctor/doctor/deleted` + "'" + ', ' + "'" + `Are you sure want to delete ` + row.doctor_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="doctors-ui-table" data-namesec="doctor" data-id="' + row.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-delete-bin-line"></i></button></a>';
                return button;
            }
        }
    ],
    initComplete: function (settings, json) {
        initialComplete(settings, json, 'doctors-ui-table', 'doctorCreateModal');
    }
});