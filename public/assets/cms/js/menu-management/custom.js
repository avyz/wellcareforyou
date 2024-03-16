$(document).ready(function () {
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

    // Create Submenu
    $(document).on('click', '#create-btn', function () {
        let lang_code = $("#adminSubmenuCreate select[name='lang_code']").val();
        const data = {
            lang_code: lang_code,
            type: 'add'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'menu_id', 'adminSubmenuCreate');

    });

    // Onchange lang_code
    $(document).on('change', '#adminSubmenuCreate select[name="lang_code"]', function () {
        let lang_code = $(this).val();
        const data = {
            lang_code: lang_code,
            type: 'add'
        };
        getDropdown(data, '/menu-management/data-menu-management', 'menu_name', 'menu_id', 'adminSubmenuCreate');
    });

    // const validateFormMenu = (value) => {
    //     let errors = {};
    //     const regexCapital = /^[A-Z][a-zA-Z]{2,}$/;
    //     if (!value[4].value.match(regexCapital)) {
    //         errors.menu_name =
    //             "Menu Name must be capitalized and not contains any number and least 3 characters";
    //     }

    //     return errors;
    // };

    // Menu

    // create
    $(document).on('submit', '#adminCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();

        post(url + '/menu-management/admin/create', 'menu-ui-table', 'adminCreate', data);
    });

    // edit
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

    // Submenu

    // create
    $(document).on('submit', '#adminSubmenuCreate', function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        post(url + '/menu-management/admin/create-submenu', 'submenu-ui-table', 'adminSubmenuCreate', data);
    });

    // edit
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
});