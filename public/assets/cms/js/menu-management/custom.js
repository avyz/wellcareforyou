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
                // Access the data returned from the AJAX request here
                $('#edit_menu_id').val(data.uuid);
                const old_menu_name = $('#edit_menu_name').data('old_menu_name');
                $('#edit_menu_name').val(old_menu_name ? old_menu_name : data.menu_name);
                $('#edit_menu_icon').val(data.menu_icon);
            },
            error: function (xhr, status, error) {
                // Handle any errors that occur during the AJAX request
                console.error(error);
            }
        });
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

    $(document).on('submit', '#adminCreate', function (e) {
        $('#adminCreate button[type="submit"]').attr('disabled', true);
        setTimeout(() => { $('#adminCreate button[type="submit"]').attr('disabled', false) }, 3000);
    });

    $(document).on('submit', '#adminEdit', function (e) {
        // const value = $(this).serializeArray();
        // const errors = validateFormMenu(value);
        // if (Object.keys(errors).length > 0) {
        //     e.preventDefault();
        //     $('#validation_menu_name').text(errors.menu_name);
        // }
        $('#adminEdit button[type="submit"]').attr('disabled', true);
        setTimeout(() => { $('#adminEdit button[type="submit"]').attr('disabled', false) }, 3000);
        // console.log(bool);
        // else {
        //     const dataValue = {
        //         name: 'type',
        //         value: 'edit'
        //     }
        //     value.push(dataValue);
        //     $.ajax({
        //         url: url + '/menu-management/admin/edit',
        //         type: 'PUT',
        //         data: value,
        //         beforeSend: function () {
        //             $('#adminEdit button[type="submit"]').attr('disabled', true);
        //         },
        //         complete: function () {
        //             $('#adminEdit button[type="submit"]').attr('disabled', false);
        //         },
        //         error: function (xhr, status, error) {
        //             // Handle any errors that occur during the AJAX request
        //             console.error(error);
        //         }
        //     });
        //     $('#validation_menu_name').text('');
        // }
    });
});