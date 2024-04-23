// Location Section
function formatHospitalLocationChildTable(data) {
    let html = '';
    if (data.length > 0) {
        html += '<div class="table-responsive">';
        html += '<table class="table dt-table-hover" style="width:100%">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>No</th>';
        html += '<th>Code</th>';
        html += '<th>Location</th>';
        html += '<th>Action</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        $.each(data, function (index, value) {
            html += '<tr>';
            html += `<td>${value.number}</td>`;
            html += `<td>${value.hospital_location_code}</td>`;
            html += `<td>${value.hospital_location_name}</td>`;
            html += '<td><a href="javascript:void(0)" onclick="del(this, ' + "'" + `/hospital/hospital-location/deleted` + "'" + ', ' + "'" + `Are you sure want to delete ` + value.hospital_location_name + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="hospital-location-ui-table" data-namesec="hospital_location" data-id="' + value.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-delete-bin-line"></i></button></a></td>';
            html += '</tr>';
        });
        html += '</tbody>';
        html += '</table>';
        html += '</div>';
    } else {
        html += '<div class="table-responsive text-center">';
        html += `No Data`;
        html += '</div>';
    }
    return html;
}

var no_insert_data = 0;
$(document).on("click", "#insert-data-location", function () {
    // append file input when trigger click
    const hospital_location_name = $("#hospital_location_name").val();
    const lang_uuid = $("#lang_uuid").val();
    // get option label in selected option
    const lang_uuid_label = $("#lang_uuid option:selected").text();
    if (hospital_location_name == "" || lang_uuid == "") {
        if (lang_uuid == "") {
            $("#lang_uuid").trigger('focus');
        }
        if (hospital_location_name == "") {
            $("#hospital_location_name").trigger('focus');
        }
        return false;
    }
    // validate if value input not matches with value before in td
    let check = false;
    $("#show-state tr").each(function () {
        if ($(this).find("td:eq(1)").text().toLowerCase() == hospital_location_name.toLowerCase()) {
            check = true;
        }
    });
    if (check) {
        Swal.fire({
            title: 'Warning!',
            text: 'State already exists',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    if ($("#show-state").find("tr").length >= 10) {
        Swal.fire({
            title: 'Warning!',
            text: 'State reach maximum 10 data',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    let html = '';
    html += '<tr>';
    html += '<td>';
    html += lang_uuid_label;
    html += '<input type="hidden" class="form-control" name="lang_uuid[]" value="' + lang_uuid + '" required>';
    html += '<div class="invalid-feedback" data-id="lang_uuid"></div>';
    // html += '<br><div class="invalid-feedback" id="lang_uuid.' + no_insert_data + '_validation"></div>';
    html += '</td>';
    html += '<td>';
    html += hospital_location_name;
    html += '<input type="hidden" class="form-control" name="hospital_location_name[]" value="' + hospital_location_name + '" required>';
    html += '<div class="invalid-feedback" data-id="hospital_location_name"></div>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger delete-data-location" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#show-state").append(html);
    $("#hospital_location_name").val("");
    $("#lang_uuid").val("");
    updateInsertDataNumber("show-state");
    if ($("#show-state").find("tr").length > 0) {
        $("#hospital_location_name").attr("required", false);
        $("#lang_uuid").attr("required", false);
    } else {
        $("#hospital_location_name").attr("required", true);
        $("#lang_uuid").attr("required", true);
    }
})

$(document).on("click", ".delete-data-location", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumber("show-state");
    if ($("#show-state").find("tr").length > 0) {
        $("#hospital_location_name").attr("required", false);
        $("#lang_uuid").attr("required", false);
    } else {
        $("#hospital_location_name").attr("required", true);
        $("#lang_uuid").attr("required", true);
    }
});


function updateInsertDataNumber(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    no_insert_data = $("#" + id_table + " tr").length;
}

// create Hospital Location
$(document).on('submit', '#locationCreate', function (e) {
    e.preventDefault();
    let formData = $(this).serializeArray();

    post(url + '/hospital/create-hospital-location', 'hospital-location-ui-table', 'locationCreate', formData, 'show-state');
});

// Edit Hospital Location
$(document).on('click', '#editLocation', function () {
    const lang_id = $(this).data('lang_id');
    $.ajax({
        url: url + '/hospital/edit-hospital-location',
        type: 'GET',
        data: {
            lang_id: lang_id,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            let html = '';
            data?.map(function (value, index) {
                html += '<tr>';
                html += '<td>';
                html += value.language;
                html += '<input type="hidden" class="form-control" name="action_type" value="edit_value">';
                html += '<input type="hidden" class="form-control" name="location_id[]" value="' + value.uuid + '" required>';
                html += '<input type="hidden" class="form-control" name="edit_lang_uuid[]" value="' + value.lang_uuid + '" required>';
                html += '<div class="invalid-feedback" data-id="edit_lang_uuid"></div>';
                html += '</td>';
                html += '<td>';
                html += value.hospital_location_name;
                html += '<input type="hidden" class="form-control" name="edit_hospital_location_name[]" value="' + value.hospital_location_name + '" required>';
                html += '<div class="invalid-feedback" data-id="edit_hospital_location_name"></div>';
                html += '</td>';
                html += '<td>';
                html += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-location" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
                html += '</td>';
                html += '</tr>';
            });
            $("#edit-show-state").html(html);
            $("#edit_lang_uuid").val(lang_id);
            editUpdateInsertDataNumber("edit-show-state");
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

var edit_no_insert_data = 0;
$(document).on("click", "#edit-insert-data-location", function () {
    // append file input when trigger click
    const edit_hospital_location_name = $("#edit_hospital_location_name").val();
    const edit_lang_uuid = $("#edit_lang_uuid").val();
    // get option label in selected option
    const edit_lang_uuid_label = $("#edit_lang_uuid option:selected").text();
    if (edit_hospital_location_name == "" || edit_lang_uuid == "") {
        if (edit_lang_uuid == "") {
            $("#edit_lang_uuid").trigger('focus');
        }
        if (edit_hospital_location_name == "") {
            $("#edit_hospital_location_name").trigger('focus');
        }
        return false;
    }
    // validate if value input not matches with value before in td
    let check = false;
    $("#edit-show-state tr").each(function () {
        if ($(this).find("td:eq(1)").text().toLowerCase() == edit_hospital_location_name.toLowerCase()) {
            check = true;
        }
    });
    if (check) {
        Swal.fire({
            title: 'Warning!',
            text: 'State already exists',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    if ($("#edit-show-state").find("tr").length >= 10) {
        Swal.fire({
            title: 'Warning!',
            text: 'State reach maximum 10 data',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    let html = '';
    html += '<tr>';
    html += '<td>';
    html += edit_lang_uuid_label;
    html += '<input type="hidden" class="form-control" name="action_type" value="add_value">';
    html += '<input type="hidden" class="form-control" name="edit_lang_uuid[]" value="' + edit_lang_uuid + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_lang_uuid"></div>';
    html += '</td>';
    html += '<td>';
    html += edit_hospital_location_name;
    html += '<input type="hidden" class="form-control" name="edit_hospital_location_name[]" value="' + edit_hospital_location_name + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_hospital_location_name"></div>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-location" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#edit-show-state").append(html);
    $("#edit_hospital_location_name").val("");
    // $("#edit_lang_uuid").val("");
    editUpdateInsertDataNumber("edit-show-state");
    if ($("#edit-show-state").find("tr").length > 0) {
        $("#edit_hospital_location_name").attr("required", false);
        $("#edit_lang_uuid").attr("required", false);
    } else {
        $("#edit_hospital_location_name").attr("required", true);
        $("#edit_lang_uuid").attr("required", true);
    }
})

$(document).on("click", ".edit-delete-data-location", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    editUpdateInsertDataNumber("edit-show-state");
    if ($("#edit-show-state").find("tr").length > 0) {
        $("#edit_hospital_location_name").attr("required", false);
        $("#edit_lang_uuid").attr("required", false);
    } else {
        $("#edit_hospital_location_name").attr("required", true);
        $("#edit_lang_uuid").attr("required", true);
    }
});


function editUpdateInsertDataNumber(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    edit_no_insert_data = $("#" + id_table + " tr").length;
}

$(document).on('submit', '#locationEdit', function (e) {
    e.preventDefault();
    let data = new FormData(this);
    // var formData = {};
    // $.each(data, function () {
    //     formData[this.name] = this.value;
    // });
    // console.log(JSON.stringify(data));
    putWithImage(url + '/hospital/edit-hospital-location', 'hospital-location-ui-table', 'locationEdit', data, 'show-state');
});
// End

// Hospital Section

// HQ
$(document).on('change', '#hospitalCreate select[name="hq_hospital_country"]', function () {
    let hq_hospital_country = $(this).val();
    const data = {
        id: hq_hospital_country,
        method: 'get_data'
    };
    getDropdown(data, '/hospital/data-hospital-location', 'hospital_location_name', 'uuid', 'hq_hospital_location_uuid', 'hospitalCreate', null, 'add');
});

// BRANCH
$(document).on('change', '#branch_hospital_country', function () {
    let branch_hospital_country = $(this).val();
    const data = {
        id: branch_hospital_country,
        method: 'get_data'
    };
    getDropdown(data, '/hospital/data-hospital-location', 'hospital_location_name', 'uuid', 'branch_hospital_location_uuid', 'hospitalCreate', null, 'add');
});

var no_insert_data_hospital_branch = 0;
$(document).on("click", "#insert-data-hospital-branch", function () {
    // append file input when trigger click
    const branch_hospital_country = $("#branch_hospital_country").val();
    const branch_hospital_country_label = $("#branch_hospital_country option:selected").text();
    const branch_hospital_location_uuid = $("#branch_hospital_location_uuid").val();
    const branch_hospital_location_uuid_label = $("#branch_hospital_location_uuid option:selected").text();
    const branch_hospital_phone = $("#branch_hospital_phone").val();
    const branch_hospital_map_location = $("#branch_hospital_map_location").val();
    const branch_hospital_address = $("#branch_hospital_address").val();
    // get option label in selected option
    if (branch_hospital_country == "" || branch_hospital_location_uuid == "" || branch_hospital_phone == "" || branch_hospital_map_location == "" || branch_hospital_address == "") {

        if (branch_hospital_country == "") {
            $("#branch_hospital_country").trigger('focus');
        }

        if (branch_hospital_location_uuid == "") {
            $("#branch_hospital_location_uuid").trigger('focus');
        }

        if (branch_hospital_phone == "") {
            $("#branch_hospital_phone").trigger('focus');
        }

        if (branch_hospital_map_location == "") {
            $("#branch_hospital_map_location").trigger('focus');
        }

        if (branch_hospital_address == "") {
            $("#branch_hospital_address").trigger('focus');
        }

        return false;
    }
    // validate if value input not matches with value before in td
    let check = false;
    let label = '';
    $("#show-branch-hospital tr").each(function () {
        if ($(this).find("td:eq(1)").text().toLowerCase() == branch_hospital_phone.toLowerCase() || $(this).find("td:eq(2)").text().toLowerCase() == branch_hospital_map_location.toLowerCase() || $(this).find("td:eq(3)").text().toLowerCase() == branch_hospital_address.toLowerCase()) {
            check = true;
            if ($(this).find("td:eq(1)").text().toLowerCase() == branch_hospital_phone.toLowerCase()) {
                label = 'Phone';
            } else if ($(this).find("td:eq(2)").text().toLowerCase() == branch_hospital_map_location.toLowerCase()) {
                label = 'Map Location';
            } else if ($(this).find("td:eq(3)").text().toLowerCase() == branch_hospital_address.toLowerCase() + ' - ' + branch_hospital_location_uuid_label.toLowerCase()) {
                label = 'Address';
            }
        }
    });
    if (check) {
        Swal.fire({
            title: 'Warning!',
            text: label + ' already exists',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    if ($("#show-state").find("tr").length >= 10) {
        Swal.fire({
            title: 'Warning!',
            text: 'Branch reach maximum 10 data',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    let html = '';
    html += '<tr>';
    html += '<td>';
    html += branch_hospital_country_label;
    html += '<input type="hidden" class="form-control" name="branch_hospital_country[]" value="' + branch_hospital_country + '" required>';
    html += '<div class="invalid-feedback" data-id="branch_hospital_country"></div>';
    html += '</td>';
    html += '<td>';
    html += branch_hospital_phone;
    html += '<input type="hidden" class="form-control" name="branch_hospital_phone[]" value="' + branch_hospital_phone + '" required>';
    html += '<div class="invalid-feedback" data-id="branch_hospital_phone"></div>';
    html += '</td>';
    html += '<td>';
    html += branch_hospital_map_location;
    html += '<input type="hidden" class="form-control" name="branch_hospital_map_location[]" value="' + branch_hospital_map_location + '" required>';
    html += '<div class="invalid-feedback" data-id="branch_hospital_map_location"></div>';
    html += '</td>';
    html += '<td>';
    html += branch_hospital_address + ' - ' + branch_hospital_location_uuid_label;
    html += '<input type="hidden" class="form-control" name="branch_hospital_address[]" value="' + branch_hospital_address + '" required>';
    html += '<input type="hidden" class="form-control" name="branch_hospital_location_uuid_label[]" value="' + branch_hospital_location_uuid_label + '" required>';
    html += '<div class="invalid-feedback" data-id="branch_hospital_address"></div>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger delete-data-hospital-branch" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#show-branch-hospital").append(html);
    $("#branch_hospital_country").val("");
    $("#branch_hospital_location_uuid").val("");
    $("#branch_hospital_location_uuid").html("<option value=''>-- Choose your location --</option>");
    $("#branch_hospital_phone").val("");
    $("#branch_hospital_map_location").val("");
    $("#branch_hospital_address").val("");
    updateInsertDataNumberHospitalBranch("show-branch-hospital");
    if ($("#show-branch-hospital").find("tr").length > 0) {
        $("#branch_hospital_country").attr("required", false);
        $("#branch_hospital_location_uuid").attr("required", false);
        $("#branch_hospital_phone").attr("required", false);
        $("#branch_hospital_map_location").attr("required", false);
        $("#branch_hospital_address").attr("required", false);
    } else {
        $("#branch_hospital_country").attr("required", true);
        $("#branch_hospital_location_uuid").attr("required", true);
        $("#branch_hospital_phone").attr("required", true);
        $("#branch_hospital_map_location").attr("required", true);
        $("#branch_hospital_address").attr("required", true);
    }
})

$(document).on("click", ".delete-data-hospital-branch", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumberHospitalBranch("show-branch-hospital");
    if ($("#show-branch-hospital").find("tr").length > 0) {
        $("#branch_hospital_country").attr("required", false);
        $("#branch_hospital_location_uuid").attr("required", false);
        $("#branch_hospital_phone").attr("required", false);
        $("#branch_hospital_map_location").attr("required", false);
        $("#branch_hospital_address").attr("required", false);
    } else {
        $("#branch_hospital_country").attr("required", true);
        $("#branch_hospital_location_uuid").attr("required", true);
        $("#branch_hospital_phone").attr("required", true);
        $("#branch_hospital_map_location").attr("required", true);
        $("#branch_hospital_address").attr("required", true);
    }
});


function updateInsertDataNumberHospitalBranch(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    no_insert_data_hospital_branch = $("#" + id_table + " tr").length;
}

// create Hospital Location
// $(document).on('submit', '#locationCreate', function (e) {
//     e.preventDefault();
//     let formData = $(this).serializeArray();

//     post(url + '/hospital/create-hospital-location', 'hospital-location-ui-table', 'locationCreate', formData, 'show-state');
// });