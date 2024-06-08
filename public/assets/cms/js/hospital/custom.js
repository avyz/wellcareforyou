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
    const country_uuid = $("#country_uuid").val();
    // get option label in selected option
    const country_uuid_label = $("#country_uuid option:selected").text();
    if (hospital_location_name == "" || country_uuid == "") {
        if (country_uuid == "") {
            $("#country_uuid").trigger('focus');
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
    html += country_uuid_label;
    html += '<input type="hidden" class="form-control" name="country_uuid[]" value="' + country_uuid + '" required>';
    html += '<div class="invalid-feedback" data-id="country_uuid"></div>';
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
    $("#country_uuid").val("");
    updateInsertDataNumber("show-state");
    if ($("#show-state").find("tr").length > 0) {
        $("#hospital_location_name").attr("required", false);
        $("#country_uuid").attr("required", false);
    } else {
        $("#hospital_location_name").attr("required", true);
        $("#country_uuid").attr("required", true);
    }
})

$(document).on("click", ".delete-data-location", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumber("show-state");
    if ($("#show-state").find("tr").length > 0) {
        $("#hospital_location_name").attr("required", false);
        $("#country_uuid").attr("required", false);
    } else {
        $("#hospital_location_name").attr("required", true);
        $("#country_uuid").attr("required", true);
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
    const country_id = $(this).data('country_id');
    $.ajax({
        url: url + '/hospital/edit-hospital-location',
        type: 'GET',
        data: {
            country_id: country_id,
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
                html += value.country;
                html += '<input type="hidden" class="form-control" name="action_type[]" value="edit_value">';
                html += '<input type="hidden" class="form-control" name="location_id[]" value="' + value.uuid + '" required>';
                html += '<input type="hidden" class="form-control" name="edit_country_uuid[]" value="' + value.country_uuid + '" required>';
                html += '<div class="invalid-feedback" data-id="edit_country_uuid"></div>';
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
            $("#edit_country_uuid").val(country_id);
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
    const edit_country_uuid = $("#edit_country_uuid").val();
    // get option label in selected option
    const edit_country_uuid_label = $("#edit_country_uuid option:selected").text();
    if (edit_hospital_location_name == "" || edit_country_uuid == "") {
        if (edit_country_uuid == "") {
            $("#edit_country_uuid").trigger('focus');
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
    html += edit_country_uuid_label;
    html += '<input type="hidden" class="form-control" name="action_type[]" value="add_value">';
    html += '<input type="hidden" class="form-control" name="edit_country_uuid[]" value="' + edit_country_uuid + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_country_uuid"></div>';
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
    // $("#edit_country_uuid").val("");
    editUpdateInsertDataNumber("edit-show-state");
    if ($("#edit-show-state").find("tr").length > 0) {
        $("#edit_hospital_location_name").attr("required", false);
        $("#edit_country_uuid").attr("required", false);
    } else {
        $("#edit_hospital_location_name").attr("required", true);
        $("#edit_country_uuid").attr("required", true);
    }
})

$(document).on("click", ".edit-delete-data-location", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    editUpdateInsertDataNumber("edit-show-state");
    if ($("#edit-show-state").find("tr").length > 0) {
        $("#edit_hospital_location_name").attr("required", false);
        $("#edit_country_uuid").attr("required", false);
    } else {
        $("#edit_hospital_location_name").attr("required", true);
        $("#edit_country_uuid").attr("required", true);
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
function formatHospitalChildTable(data) {
    let html = '';
    if (data.length > 0) {
        html += '<div class="table-responsive">';
        html += '<table class="table dt-table-hover" style="width:100%">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>No</th>';
        html += '<th>Hospital</th>';
        html += '<th>Phone</th>';
        html += '<th>Address</th>';
        html += '<th>Action</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        $.each(data, function (index, value) {
            html += '<tr>';
            html += `<td>${value.number}</td>`;
            html += `<td>${value.hospital_name}<br><span><i>${value.hospital_code}</i></span><br><small class="badge badge-success"><i>Hospital Branch</i></small></td>`;
            html += `<td>${value.hospital_phone}</td>`;
            html += `<td><a class="text-primary" href="${value.hospital_map_location}" target="_blank">${value.hospital_address} - ${value.hospital_location_name}</a></td>`;
            html += '<td><a href="javascript:void(0)" onclick="del(this, ' + "'" + `/hospital/hospital-branch/deleted` + "'" + ', ' + "'" + `Are you sure want to delete address` + "?'" + ', ' + "'" + `DELETE` + "'" + ')" data-id_datatable="hospital-ui-table" data-namesec="hospital_address" data-id="' + value.uuid + '" class="ms-1 buttons-delete"><button class="btn px-2 py-1 btn-danger"><i class="ri-delete-bin-line"></i></button></a></td>';
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
    html += '<input type="hidden" class="form-control" name="branch_hospital_location_uuid_input[]" value="' + branch_hospital_location_uuid + '" required>';
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
})

$(document).on("click", ".delete-data-hospital-branch", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumberHospitalBranch("show-branch-hospital");
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
$(document).on('submit', '#hospitalCreate', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    postWithImage(url + '/hospital/create-hospital', 'hospital-ui-table', 'hospitalCreate', formData, 'show-branch-hospital');
});

// Edit Hospital Location
$(document).on('click', '#editHospital', function () {
    const hospital_id = $(this).data('hospital_id');
    const hospital_image = $(this).data('hospital_image');
    const hospital_name = $(this).data('hospital_name');
    const hq_hospital_country = $(this).data('hq_hospital_country');
    const hq_hospital_location_uuid = $(this).data('hq_hospital_location_uuid');
    const hq_hospital_phone = $(this).data('hq_hospital_phone');
    const hq_hospital_map_location = $(this).data('hq_hospital_map_location');
    const hq_hospital_address = $(this).data('hq_hospital_address');
    $.ajax({
        url: url + '/hospital/edit-hospital',
        type: 'GET',
        data: {
            hospital_id: hospital_id,
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
                html += value.hospital_country;
                html += '<input type="hidden" class="form-control" name="action_type[]" value="edit_value">';
                html += '<input type="hidden" class="form-control" name="hospital_branch_id[]" value="' + value.uuid + '" required>';
                html += '</td>';
                html += '<td>';
                html += value.hospital_phone;
                html += '<input type="hidden" class="form-control" name="edit_branch_hospital_phone[]" value="' + value.hospital_phone + '" required>';
                html += '<div class="invalid-feedback" data-id="edit_branch_hospital_phone"></div>';
                html += '</td>';
                html += '<td>';
                html += value.hospital_map_location;
                html += '<input type="hidden" class="form-control" name="edit_branch_hospital_map_location[]" value="' + value.hospital_map_location + '" required>';
                html += '<div class="invalid-feedback" data-id="edit_branch_hospital_map_location"></div>';
                html += '</td>';
                html += '<td>';
                html += value.hospital_address + ' - ' + value.hospital_location_name;
                html += '<input type="hidden" class="form-control" name="edit_branch_hospital_address[]" value="' + value.hospital_address + '" required>';
                html += '<input type="hidden" class="form-control" name="edit_branch_hospital_location_uuid_input[]" value="' + value.hospital_location_uuid + '" required>';
                html += '<div class="invalid-feedback" data-id="edit_branch_hospital_address"></div>';
                html += '</td>';
                html += '<td>';
                html += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-hospital-branch" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
                html += '</td>';
                html += '</tr>';
            }
            );
            $("#edit-show-branch-hospital").html(html);
            $("#edit-show-hospital-image img").attr('src', url + '/assets/website/images/hospital/' + hospital_image);
            $("#edit_hospital_image").val(hospital_image);
            $("#edit_hospital_id").val(hospital_id);
            // $("#edit-show-hospital-image img").attr('src', url + '/assets/website/images/hospital/' + hospital_image).html("<b>" + hospital_image + "</b>");
            // $("#edit-show-hospital-image").text(hospital_image);
            $("#edit_hospital_name").val(hospital_name);
            $("#edit_hq_hospital_country").val(hq_hospital_country);
            getDropdown({ id: hq_hospital_country, location_uuid: hq_hospital_location_uuid, method: 'get_data' }, '/hospital/data-hospital-location', 'hospital_location_name', 'uuid', 'edit_hq_hospital_location_uuid', 'hospitalEdit', null, 'edit', 'location_uuid');
            // $("#edit_hq_hospital_location_uuid").val(hq_hospital_location_uuid);
            $("#edit_hq_hospital_phone").val(hq_hospital_phone);
            $("#edit_hq_hospital_map_location").val(hq_hospital_map_location);
            $("#edit_hq_hospital_address").val(hq_hospital_address);
            editUpdateInsertDataNumberHospitalBranch("edit-show-branch-hospital");
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

var edit_no_insert_data_hospital_branch = 0;
$(document).on("click", "#edit-insert-data-hospital-branch", function () {
    // append file input when trigger click
    const edit_branch_hospital_country = $("#edit_branch_hospital_country").val();
    const edit_branch_hospital_country_label = $("#edit_branch_hospital_country option:selected").text();
    const edit_branch_hospital_phone = $("#edit_branch_hospital_phone").val();
    const edit_branch_hospital_map_location = $("#edit_branch_hospital_map_location").val();
    const edit_branch_hospital_address = $("#edit_branch_hospital_address").val();
    const edit_branch_hospital_location_uuid = $("#edit_branch_hospital_location_uuid").val();
    const edit_branch_hospital_location_uuid_label = $("#edit_branch_hospital_location_uuid option:selected").text();
    // get option label in selected option
    if (edit_branch_hospital_country == "" || edit_branch_hospital_phone == "" || edit_branch_hospital_map_location == "" || edit_branch_hospital_address == "") {

        if (edit_branch_hospital_country == "") {
            $("#edit_branch_hospital_country").trigger('focus');
        }

        if (edit_branch_hospital_phone == "") {
            $("#edit_branch_hospital_phone").trigger('focus');
        }

        if (edit_branch_hospital_map_location == "") {
            $("#edit_branch_hospital_map_location").trigger('focus');
        }

        if (edit_branch_hospital_address == "") {
            $("#edit_branch_hospital_address").trigger('focus');
        }

        return false;
    }
    // validate if value input not matches with value before in td
    let check = false;
    let label = '';
    $("#edit-show-branch-hospital tr").each(function () {
        if ($(this).find("td:eq(1)").text().toLowerCase() == edit_branch_hospital_phone.toLowerCase() || $(this).find("td:eq(2)").text().toLowerCase() == edit_branch_hospital_map_location.toLowerCase() || $(this).find("td:eq(3)").text().toLowerCase() == edit_branch_hospital_address.toLowerCase()) {
            check = true;
            if ($(this).find("td:eq(1)").text().toLowerCase() == edit_branch_hospital_phone.toLowerCase()) {
                label = 'Phone';
            } else if ($(this).find("td:eq(2)").text().toLowerCase() == edit_branch_hospital_map_location.toLowerCase()) {
                label = 'Map Location';
            } else if ($(this).find("td:eq(3)").text().toLowerCase() == edit_branch_hospital_address.toLowerCase() + ' - ' + edit_branch_hospital_location_uuid_label.toLowerCase()) {
                label = 'Address';
            }
        }
    }
    );
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
    if ($("#edit-show-branch-hospital").find("tr").length >= 10) {
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
    html += edit_branch_hospital_country_label;
    html += '<input type="hidden" class="form-control" name="action_type[]" value="add_value">';
    html += '<input type="hidden" class="form-control" name="edit_branch_hospital_country[]" value="' + edit_branch_hospital_country + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_branch_hospital_country"></div>';
    html += '</td>';
    html += '<td>';
    html += edit_branch_hospital_phone;
    html += '<input type="hidden" class="form-control" name="edit_branch_hospital_phone[]" value="' + edit_branch_hospital_phone + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_branch_hospital_phone"></div>';
    html += '</td>';
    html += '<td>';
    html += edit_branch_hospital_map_location;
    html += '<input type="hidden" class="form-control" name="edit_branch_hospital_map_location[]" value="' + edit_branch_hospital_map_location + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_branch_hospital_map_location"></div>';
    html += '</td>';
    html += '<td>';
    html += edit_branch_hospital_address + ' - ' + edit_branch_hospital_location_uuid_label;
    html += '<input type="hidden" class="form-control" name="edit_branch_hospital_address[]" value="' + edit_branch_hospital_address + '" required>';
    html += '<input type="hidden" class="form-control" name="edit_branch_hospital_location_uuid_input[]" value="' + edit_branch_hospital_location_uuid + '" required>';
    html += '<div class="invalid-feedback" data-id="edit_branch_hospital_address"></div>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-hospital-branch" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#edit-show-branch-hospital").append(html);
    $("#edit_branch_hospital_country").val("");
    $("#edit_branch_hospital_location_uuid").val("");
    $("#edit_branch_hospital_location_uuid").html("<option value=''>-- Choose your location --</option>");
    $("#edit_branch_hospital_phone").val("");
    $("#edit_branch_hospital_map_location").val("");
    $("#edit_branch_hospital_address").val("");
    editUpdateInsertDataNumberHospitalBranch("edit-show-branch-hospital");
});

$(document).on("click", ".edit-delete-data-hospital-branch", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    editUpdateInsertDataNumberHospitalBranch("edit-show-branch-hospital");
});

function editUpdateInsertDataNumberHospitalBranch(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    edit_no_insert_data_hospital_branch = $("#" + id_table + " tr").length;
}

// HQ
$(document).on('change', '#hospitalEdit select[name="edit_hq_hospital_country"]', function () {
    let edit_hq_hospital_country = $(this).val();
    const data = {
        id: edit_hq_hospital_country,
        method: 'get_data'
    };
    getDropdown(data, '/hospital/data-hospital-location', 'hospital_location_name', 'uuid', 'edit_hq_hospital_location_uuid', 'hospitalEdit', null, 'add');
});

$(document).on('change', '#edit_branch_hospital_country', function () {
    let edit_branch_hospital_country = $(this).val();
    const data = {
        id: edit_branch_hospital_country,
        method: 'get_data'
    };
    getDropdown(data, '/hospital/data-hospital-location', 'hospital_location_name', 'uuid', 'edit_branch_hospital_location_uuid', 'hospitalEdit', null, 'add');
});

$(document).on('submit', '#hospitalEdit', function (e) {
    e.preventDefault();
    let data = new FormData(this);
    putWithImage(url + '/hospital/edit-hospital', 'hospital-ui-table', 'hospitalEdit', data, 'edit-show-branch-hospital');
});
// End

// DecoupledEditor.create(document.querySelector('#editor'))
//     .then(editor => {
//         const toolbarContainer = document.querySelector('#toolbar-container');

//         toolbarContainer.appendChild(editor.ui.view.toolbar.element);
//     })
//     .catch(error => {
//         console.error(error);
//     });

