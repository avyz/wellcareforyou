$(document).ready(function () {

    // MENU
    // Admin
    $(document).on('click', '#editMenu', function () {
        const menu_id = $(this).data('menu_id');
        // console.log(menu_id);
        $.ajax({
            url: url + '/menu-management/admin/edit',
            type: 'GET',
            data: {
                menu_id: menu_id,
                type: 'view'
            },
            dataType: 'json',
            success: function (data) {
                data = data.data;
                // Access the data returned from the AJAX request here
                $('#edit_menu_id').val(data.uuid);
                $('#edit_menu_name').val(data.menu_name);
                $('#edit_menu_icon').val(data.menu_icon);
                $('#edit_menu_number').val(data.menu_number);
                $('select[name=lang_code]').val(data.lang_code);
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

    // User
    $(document).on('click', '#editMenuUser', function () {
        const menu_id = $(this).data('menu_id');
        // console.log(menu_id);
        $.ajax({
            url: url + '/menu-management/user/edit',
            type: 'GET',
            data: {
                menu_id: menu_id,
                type: 'view'
            },
            dataType: 'json',
            success: function (data) {
                data = data.data;
                // Access the data returned from the AJAX request here
                $('#edit_menu_id').val(data.uuid);
                $('#edit_menu_name').val(data.menu_name);
                $('#edit_menu_icon').val(data.menu_icon);
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

    // create
    // Admin
    $(document).on('submit', '#adminCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();

        post(url + '/menu-management/admin/create', 'menu-ui-table', 'adminCreate', data);
    });
    // User
    $(document).on('submit', '#userCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        post(url + '/menu-management/user/create', 'menuuser-ui-table', 'userCreate', data);
    });

    // edit
    // Admin
    $(document).on('submit', '#adminEdit', function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: 'type', value: 'edit' });
        var formData = {};
        $.each(data, function () {
            formData[this.name] = this.value;
        });
        put(url + '/menu-management/admin/edit', 'menu-ui-table', 'adminEdit', formData);
    });

    // User
    $(document).on('submit', '#userEdit', function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: 'type', value: 'edit' });
        var formData = {};
        $.each(data, function () {
            formData[this.name] = this.value;
        });
        put(url + '/menu-management/user/edit', 'menuuser-ui-table', 'userEdit', formData);
    });
    // End MENU

    // SUBMENU
    // Onchange lang_code
    // Admin
    $(document).on('change', '#adminSubmenuCreate select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'menu_id', 'adminSubmenuCreate', 'menu', 'add');
    });

    // User
    $(document).on('change', '#userSubmenuCreate select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'menu_id', 'userSubmenuCreate', 'menu', 'add');
    });

    // Onchange lang_code edit
    // Admin
    $(document).on('change', '#adminSubmenuEdit select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        // let menu_id = $('#adminSubmenuEdit select[name="menu_id"]').val();
        const data = {
            lang_code: lang_code,
            // type: 'add',
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'edit_submenu_menu_id', 'adminSubmenuEdit', 'menu', 'edit');
        // if (menu_id) {
        //     getDropdown(data, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'menu_children_id', 'adminSubmenuCreate', 'submenu', 'add');
        // }
    });
    // User
    $(document).on('change', '#userSubmenuEdit select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'edit_submenu_menu_id', 'userSubmenuEdit', 'menu', 'add');
    });
    // Admin
    $(document).on('click', 'button[data-bs-target="#submenuCreateModal"]', function () {
        let lang_code = $("#adminSubmenuCreate select[name='lang_code']").val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'menu_id', 'adminSubmenuCreate', 'menu', 'add');
    });
    // User
    $(document).on('click', 'button[data-bs-target="#submenuuserCreateModal"]', function () {
        let lang_code = $("#userSubmenuCreate select[name='lang_code']").val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'menu_id', 'userSubmenuCreate', 'menu', 'add');
    });

    // Onchange get submenu by menu id
    // Admin
    $(document).on('change', '#adminSubmenuCreate select[name="menu_id"]', function () {
        let menu_id = $(this).val();
        const data = {
            menu_id: menu_id,
            method: 'onchange_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'menu_children_id', 'adminSubmenuCreate', 'submenu_arr', 'add');
    });
    // User
    $(document).on('change', '#userSubmenuCreate select[name="menu_id"]', function () {
        let menu_id = $(this).val();
        const data = {
            menu_id: menu_id,
            method: 'onchange_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_children_name', 'menu_children_uuid', 'menu_children_id', 'userSubmenuCreate', 'submenu_arr', 'add');
    });

    // View data edit submenu
    // Admin
    $(document).on('click', '#editSubmenu', function () {
        const menu_children_id = $(this).data('menu_children_id');
        // console.log(menu_id);
        $.ajax({
            url: url + '/menu-management/admin/edit-submenu',
            type: 'GET',
            data: {
                menu_children_id: menu_children_id,
                type: 'view'
            },
            dataType: 'json',
            success: function (data) {
                data = data.data;
                // Access the data returned from the AJAX request here
                // console.log(data)
                let lang_code = data.lang_code;
                const data_values = {
                    menu_id: data.menu_uuid,
                    lang_code: lang_code,
                    // type: 'edit',
                    method: 'get_data'
                };
                getDropdown(data_values, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'edit_submenu_menu_id', 'adminSubmenuEdit', 'menu', 'edit', 'menu_id');
                $('#edit_menu_children_id').val(data.menu_children_uuid);
                $('#edit_submenu_menu_id').val(data.menu_uuid);
                $('#edit_menu_children_name').val(data.menu_children_name);
                $("#adminSubmenuEdit select[name='lang_code']").val(data.lang_code);

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

    // User
    $(document).on('click', '#editSubmenuUser', function () {
        const menu_children_id = $(this).data('menu_children_id');
        // console.log(menu_id);
        $.ajax({
            url: url + '/menu-management/user/edit-submenu',
            type: 'GET',
            data: {
                menu_children_id: menu_children_id,
                type: 'view'
            },
            dataType: 'json',
            success: function (data) {
                data = data.data;
                // Access the data returned from the AJAX request here
                let lang_code = $("#userSubmenuEdit select[name='lang_code']").val();
                const data_values = {
                    menu_id: data.menu_uuid,
                    lang_code: lang_code,
                    // type: 'edit',
                    method: 'get_data'
                };
                getDropdown(data_values, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'edit_submenu_menu_id', 'userSubmenuEdit', 'menu', 'edit', 'menu_id');
                $('#edit_menu_children_id').val(data.menu_children_uuid);
                $('#edit_submenu_menu_id').val(data.menu_uuid);
                $('#edit_menu_children_name').val(data.menu_children_name);
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

    // create
    // Admin
    $(document).on('submit', '#adminSubmenuCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        post(url + '/menu-management/admin/create-submenu', 'submenu-ui-table', 'adminSubmenuCreate', data);
    });
    // User
    $(document).on('submit', '#userSubmenuCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        post(url + '/menu-management/user/create-submenu', 'submenuuser-ui-table', 'userSubmenuCreate', data);
    });

    // edit
    // Admin
    $(document).on('submit', '#adminSubmenuEdit', function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: 'type', value: 'edit' });
        var formData = {};
        $.each(data, function () {
            formData[this.name] = this.value;
        });
        put(url + '/menu-management/admin/edit-submenu', 'submenu-ui-table', 'adminSubmenuEdit', formData);
    });
    // User
    $(document).on('submit', '#userSubmenuEdit', function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: 'type', value: 'edit' });
        var formData = {};
        $.each(data, function () {
            formData[this.name] = this.value;
        });
        put(url + '/menu-management/user/edit-submenu', 'submenuuser-ui-table', 'userSubmenuEdit', formData);
    });

    // TABMENU
    // Onchange lang_code
    // Admin
    $(document).on('change', '#adminTabmenuCreate select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        let menu_id = $('#adminTabmenuCreate select[name="tabmenu_menu_id"]').val();
        const data = {
            lang_code: lang_code,
            // type: 'add',
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'tabmenu_menu_id', 'adminTabmenuCreate', 'menu', 'add');
        if (menu_id) {
            getDropdown(data, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'tabmenu_children_id', 'adminTabmenuCreate', 'submenu', 'add');
        }
    });
    // User
    $(document).on('change', '#userTabmenuCreate select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        let menu_id = $('#userTabmenuCreate select[name="tabmenu_menu_id"]').val();
        const data = {
            lang_code: lang_code,
            // type: 'add',
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'tabmenu_menu_id', 'userTabmenuCreate', 'menu', 'add');
        if (menu_id) {
            getDropdown(data, '/menu-management/data-menu-management-user', 'menu_children_name', 'menu_children_uuid', 'tabmenu_children_id', 'userTabmenuCreate', 'submenu', 'add');
        }
    });

    // Onchange lang_code edit
    // Admin
    $(document).on('change', '#adminTabmenuEdit select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        let menu_id = $('#adminTabmenuEdit select[name="edit_tabmenu_menu_id"]').val();
        const data = {
            lang_code: lang_code,
            // type: 'add',
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'edit_tabmenu_menu_id', 'adminTabmenuEdit', 'menu', 'edit', 'menu_id');
        if (menu_id) {
            getDropdown(data, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'edit_tabmenu_children_id', 'adminTabmenuEdit', 'submenu', 'edit', 'menu_children_id');
        }
    });
    // User
    $(document).on('change', '#userTabmenuEdit select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        let menu_id = $('#userTabmenuEdit select[name="edit_tabmenu_menu_id"]').val();
        const data = {
            lang_code: lang_code,
            // type: 'add',
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'edit_tabmenu_menu_id', 'userTabmenuEdit', 'menu', 'edit', 'menu_id');
        if (menu_id) {
            getDropdown(data, '/menu-management/data-menu-management-user', 'menu_children_name', 'menu_children_uuid', 'edit_tabmenu_children_id', 'userTabmenuEdit', 'submenu', 'edit', 'menu_children_id');
        }

    });

    // onclick get submenu
    // Admin
    $(document).on('click', 'button[data-bs-target="#tabCreateModal"]', function () {
        let lang_code = $("#adminTabmenuCreate select[name='lang_code']").val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'tabmenu_menu_id', 'adminTabmenuCreate', 'menu', 'add');
    });
    // User
    $(document).on('click', 'button[data-bs-target="#tabuserCreateModal"]', function () {
        let lang_code = $("#userTabmenuCreate select[name='lang_code']").val();
        const data = {
            lang_code: lang_code,
            method: 'get_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'tabmenu_menu_id', 'userTabmenuCreate', 'menu', 'add');
    });

    // Onchange get submenu by menu id
    // Admin
    $(document).on('change', '#adminTabmenuCreate select[name="tabmenu_menu_id"]', function () {
        let menu_id = $(this).val();
        const data = {
            menu_id: menu_id,
            method: 'onchange_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'tabmenu_children_id', 'adminTabmenuCreate', 'submenu_arr', 'add');
    });

    // User
    $(document).on('change', '#userTabmenuCreate select[name="tabmenu_menu_id"]', function () {
        let menu_id = $(this).val();
        const data = {
            menu_id: menu_id,
            method: 'onchange_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_children_name', 'menu_children_uuid', 'tabmenu_children_id', 'userTabmenuCreate', 'submenu_arr', 'add');
    });

    // onchange get submenu arr by menu id edit
    // Admin
    $(document).on('change', '#adminTabmenuEdit select[name="edit_tabmenu_menu_id"]', function () {
        let menu_id = $(this).val();
        const data = {
            menu_id: menu_id,
            method: 'onchange_data'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'edit_tabmenu_children_id', 'adminTabmenuEdit', 'submenu_arr', 'edit', 'menu_id');
    });
    // User
    $(document).on('change', '#userTabmenuEdit select[name="edit_tabmenu_menu_id"]', function () {
        let menu_id = $(this).val();
        const data = {
            menu_id: menu_id,
            method: 'onchange_data'
        };
        getDropdown(data, '/menu-management/data-menu-management-user', 'menu_children_name', 'menu_children_uuid', 'edit_tabmenu_children_id', 'userTabmenuEdit', 'submenu_arr', 'edit', 'menu_id');
    });

    // View data tabmenu
    // Admin
    $(document).on('click', '#editTabmenu', function () {
        const menu_tab_id = $(this).data('menu_tab_id');
        $.ajax({
            url: url + '/menu-management/admin/edit-tabmenu',
            type: 'GET',
            data: {
                tab_menu_id: menu_tab_id,
                type: 'view'
            },
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                data = data.data;
                // Access the data returned from the AJAX request here
                let lang_code = data.lang_code;
                const data_values_menu = {
                    menu_id: data.menu_uuid,
                    lang_code: lang_code,
                    method: 'get_data'
                };
                getDropdown(data_values_menu, '/menu-management/data-menu-management', 'menu_name', 'uuid', 'edit_tabmenu_menu_id', 'adminTabmenuEdit', 'menu', 'edit', 'menu_id');

                $('#edit_tab_menu_id').val(data.menu_tab_uuid);
                $('#edit_tabmenu_menu_id').val(data.menu_uuid);
                $('#edit_tabmenu_children_id').val(data.menu_children_uuid);
                $('#edit_menu_tab_name').val(data.menu_tab_name);
                $("#adminTabmenuEdit select[name='lang_code']").val(data.lang_code);

                if ($("#adminTabmenuEdit select[name='lang_code']").val() == data.lang_code) {
                    const data_values_submenu = {
                        menu_id: data.menu_uuid,
                        menu_children_id: data.menu_children_uuid,
                        lang_code: lang_code,
                        method: 'onchange_data'
                    };
                    getDropdown(data_values_submenu, '/menu-management/data-menu-management', 'menu_children_name', 'menu_children_uuid', 'edit_tabmenu_children_id', 'adminTabmenuEdit', 'submenu_arr', 'edit', 'menu_children_id');
                } else {
                    $('#edit_tabmenu_children_id').html('<option value="">-- Choose your selection --</option>');
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
    });
    // User
    $(document).on('click', '#editTabmenuUser', function () {
        const menu_tab_id = $(this).data('menu_tab_id');
        $.ajax({
            url: url + '/menu-management/user/edit-tabmenu',
            type: 'GET',
            data: {
                tab_menu_id: menu_tab_id,
                type: 'view'
            },
            dataType: 'json',
            success: function (data) {

                data = data.data;
                // Access the data returned from the AJAX request here
                let lang_code = $("#userTabmenuEdit select[name='lang_code']").val();

                const data_values_menu = {
                    menu_id: data.menu_uuid,
                    lang_code: lang_code,
                    method: 'get_data'
                };
                getDropdown(data_values_menu, '/menu-management/data-menu-management-user', 'menu_name', 'uuid', 'edit_tabmenu_menu_id', 'userTabmenuEdit', 'menu', 'edit', 'menu_id');
                $('#edit_tab_menu_id').val(data.menu_tab_uuid);
                $('#edit_tabmenu_menu_id').val(data.menu_uuid);
                $('#edit_tabmenu_children_id').val(data.menu_children_uuid);
                $('#edit_menu_tab_name').val(data.menu_tab_name);

                if (lang_code == data.lang_code) {
                    const data_values_submenu = {
                        menu_id: data.menu_uuid,
                        menu_children_id: data.menu_children_uuid,
                        lang_code: lang_code,
                        method: 'onchange_data'
                    };
                    getDropdown(data_values_submenu, '/menu-management/data-menu-management-user', 'menu_children_name', 'menu_children_uuid', 'edit_tabmenu_children_id', 'userTabmenuEdit', 'submenu_arr', 'edit', 'menu_children_id');
                } else {
                    $('#edit_tabmenu_children_id').html('<option value="">-- Choose your selection --</option>');
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
    });

    // create
    // Admin
    $(document).on('submit', '#adminTabmenuCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        post(url + '/menu-management/admin/create-tabmenu', 'tab-ui-table', 'adminTabmenuCreate', data);
    });
    // User
    $(document).on('submit', '#userTabmenuCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        post(url + '/menu-management/user/create-tabmenu', 'tabuser-ui-table', 'userTabmenuCreate', data);
    });

    // edit
    // Admin
    $(document).on('submit', '#adminTabmenuEdit', function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: 'type', value: 'edit' });
        var formData = {};
        $.each(data, function () {
            formData[this.name] = this.value;
        });
        put(url + '/menu-management/admin/edit-tabmenu', 'tab-ui-table', 'adminTabmenuEdit', formData);
    });
    // User
    $(document).on('submit', '#userTabmenuEdit', function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: 'type', value: 'edit' });
        var formData = {};
        $.each(data, function () {
            formData[this.name] = this.value;
        });
        put(url + '/menu-management/user/edit-tabmenu', 'tabuser-ui-table', 'userTabmenuEdit', formData);
    });
});