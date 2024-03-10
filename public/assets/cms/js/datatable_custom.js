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
                    // Mendapatkan seluruh data dari AJAX response
                    $.ajax({
                        url: '/menu-management/action-buttons',
                        method: 'GET',
                        data: {
                            ...data,
                            buttons: "csv",
                        },
                        success: function (response) {

                            window.open("/menu-management/action-buttons?columnName=" + data.columnName + "&modelName=" + data.modelName + "&header=" + data.header.join(",") + "&column=" + data.column.join(",") + "&buttons=csv");
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
                    // Mendapatkan seluruh data dari AJAX response
                    $.ajax({
                        url: '/menu-management/action-buttons',
                        method: 'GET',
                        data: {
                            ...data,
                            buttons: 'excel'
                        },
                        success: function (response) {
                            window.open("/menu-management/action-buttons?columnName=" + data.columnName + "&modelName=" + data.modelName + "&header=" + data.header.join(",") + "&column=" + data.column.join(",") + "&buttons=excel");
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
                    $.ajax({
                        url: "/menu-management/action-buttons",
                        method: "GET",
                        data: {
                            ...data,
                            buttons: 'print'
                        },
                        dataType: "json",
                        success: function (response) {
                            // Tanggapi respons dari server
                            console.log(response);
                            const fullData = response.data;

                            const dataSelected = { header: data.header, column: data.column };
                            var selectedColumns = dataSelected;

                            // Membuat HTML untuk tabel sementara
                            var printContent = '<table class="table dt-table-hover"><thead><tr>';
                            $.each(selectedColumns.header, function (index, column) {
                                printContent += '<th>' + column + '</th>';
                            });
                            printContent += '</tr></thead><tbody>';
                            $.each(fullData, function (index, rowData) {
                                printContent += '<tr>';
                                $.each(selectedColumns.column, function (index, column) {
                                    printContent += '<td>' + rowData[column] + '</td>';
                                });
                                printContent += '</tr>';
                            });
                            printContent += '</tbody></table>';

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

const initialComplete = (settings, json, wrapperSelector) => {
    // console.log(json);
    json?.buttons.map((item, index) => {
        if (!item.isShow) {
            $('#' + wrapperSelector + ' .' + item.name).hide();
        }
    })
}

// MENU
$('#menu-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/menu-management/data-menu",
        "method": "GET",
        // data: function (e) {
        //     console.log(e);
        // }
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "menu_id",
            modelName: "dataMenu",
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
            "data": 'number',
            "render": function (data, type, row, meta) {
                // return meta.row + meta.settings._iDisplayStart + 1;
                return row.number;
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
                var button = "<button class='btn px-2 py-1 btn-primary' data-menu_id=" + row.uuid + " id='editMenu' data-bs-toggle='modal' data-bs-target='#menuEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="deleteConfirmation(this, ' + "'" + `/menu-management/admin/deactivate` + "'" + ', ' + "'" + `Are you sure want to deactivate ` + row.menu_name + "?'" + ', ' + "'" + `PUT` + "'" + ')" data-id_datatable="menu-ui-table" data-id="' + row.uuid + '" class="ms-1"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="deleteConfirmation(this, ' + "'" + `/menu-management/admin/activate` + "'" + ', ' + "'" + `Are you sure want to activate ` + row.menu_name + "?'" + ', ' + "'" + `PUT` + "'" + ')" data-id_datatable="menu-ui-table" data-id="' + row.uuid + '" class="ms-1"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
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
$('#submenu-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/menu-management/submenu",
        "method": "GET",
        // data: function (e) {
        //     console.log(e);
        // }
    },
    "dom": dom(),

    buttons: buttons(
        {
            columnName: "menu_children_id",
            modelName: "dataSubmenu",
            column: ['number',
                'menu_children_name',
                'menu_children_url',
                'created_at'],
            header: [
                'No',
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
                var button = "<button class='btn px-2 py-1 btn-primary' data-menu_children_id=" + row.uuid + " data-bs-toggle='modal' data-bs-target='#submenuEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="window.location.href=' + "'" + `/menu-management/admin/submenu/deactive/${row.menu_children_id}` + "'" + '" class="ms-1"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="window.location.href=' + "'" + `/menu-management/admin/submenu/active/${row.menu_children_id}` + "'" + '" class="ms-1"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
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
$('#tab-ui-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url + "/menu-management/tabmenu",
        "method": "GET",
    },
    "dom": dom(),

    buttons: buttons({
        columnName: "menu_tab_id",
        modelName: "dataTabMenu",
        column: ['number',
            'menu_tab_name',
            'created_at'],
        header: [
            'No',
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
                var button = "<button class='btn px-2 py-1 btn-primary' data-menu_tab_id=" + row.uuid + " data-bs-toggle='modal' data-bs-target='#tabEditModal'><i class='ri-pencil-line'></i></button>";
                if (row.is_active == 1) {
                    button += '<a href="javascript:void(0)" onclick="window.location.href=' + "'" + `/menu-management/admin/tabmenu/deactive/${row.menu_tab_id}` + "'" + '" class="ms-1"><button class="btn px-2 py-1 btn-danger"><i class="ri-shut-down-line"></i></button></a>';
                } else {
                    button += '<a href="javascript:void(0)" onclick="window.location.href=' + "'" + `/menu-management/admin/tabmenu/active/${row.menu_tab_id}` + "'" + '" class="ms-1"><button class="btn px-2 py-1 btn-success"><i class="ri-checkbox-circle-line"></i></button></a>';
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