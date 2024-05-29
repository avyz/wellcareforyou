// Add
$(document).on('submit', '#specialistCreate', function (e) {
    e.preventDefault();
    const data = $(this).serializeArray();
    post(url + '/doctor/create-doctor-specialist', 'specialist-ui-table', 'specialistCreate', data);
});

// Edit
$(document).on('click', '#editSpecialist', function () {
    // console.log(menu_id);
    var doctor_specialist_id = $(this).data("specialist_id");
    $.ajax({
        url: url + '/doctor/edit-doctor-specialist',
        type: 'GET',
        data: {
            doctor_specialist_id: doctor_specialist_id,
            // lang_code: metaLanguage,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            $('#edit_doctor_specialist_id').val(doctor_specialist_id);
            $('#edit_specialist_name').val(data.specialist.specialist_name);
            $('.edit_specialist_desc textarea').val('');
            data.specialist_desc.forEach(function (item) {
                var edit_specialist_desc = $('#edit_specialist_desc_' + item.lang_code);
                edit_specialist_desc.val(item.specialist_desc);
            });
            // $('#edit_specialist_desc').val(data.specialist_desc);
            // $('#specialistEdit select[name="lang_code"]').val(data.lang_code);
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

$(document).on('submit', '#specialistEdit', function (e) {
    e.preventDefault();
    let data = $(this).serializeArray();
    data.push({ name: 'type', value: 'edit' });
    var formData = {};
    $.each(data, function () {
        formData[this.name] = this.value;
    });
    put(url + '/doctor/edit-doctor-specialist', 'specialist-ui-table', 'specialistEdit', formData);
});

// Doctor Section

// Add
var input_doctor_language = document.querySelector('#doctor_language');
var input_doctor_hospital = document.querySelector('#doctor_hospital');
var input_doctor_specialist = document.querySelector('#doctor_specialist');

if (input_doctor_language) {
    makeTags(input_doctor_language, 'doctor_language', 'Type to search language', 6, 'value', ['value'], '/setting/search-language', function (item) {
        return { value: item.language, id: item.lang_code };
    });
}

if (input_doctor_specialist) {
    makeTags(input_doctor_specialist, 'doctor_specialist', 'Type to search specialist', 6, 'value', ['value'], '/doctor/search-specialist', function (item) {
        return { value: item.specialist_name, id: item.uuid };
    });
}

if (input_doctor_hospital) {
    makeTags(input_doctor_hospital, 'doctor_hospital', 'Type to search hospital', 6, 'value', ['value'], '/hospital/search-hospital', function (item) {
        return { value: item.hospital_name, id: item.uuid };
    });
}

var no_insert_data_education = 0;
$(document).on("click", "#insert-data-doctor-education", function () {
    // append file input when trigger click
    const doctor_education = $("#doctor_education").val();
    const doctor_education_location = $("#doctor_education_location").val();
    const doctor_education_year = $("#doctor_education_year").val();
    if (doctor_education == "" || doctor_education_location == "" || doctor_education_year == "") {
        if (doctor_education == "") {
            $("#doctor_education").trigger('focus');
        }
        if (doctor_education_location == "") {
            $("#doctor_education_location").trigger('focus');
        }
        if (doctor_education_year == "") {
            $("#doctor_education_year").trigger('focus');
        }
        return false;
    }
    // validate if value input not matches with value before in td
    let check = false;
    $("#show-doctor-education tr").each(function () {
        if ($(this).find("td:eq(1)").text().toLowerCase() == doctor_education.toLowerCase()) {
            check = true;
        }
    });
    if (check) {
        Swal.fire({
            title: 'Warning!',
            text: 'Education already exists',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    if ($("#show-doctor-education").find("tr").length >= 10) {
        Swal.fire({
            title: 'Warning!',
            text: 'Education reach maximum 10 data',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    let html = '';
    html += '<tr>';
    html += '<td>';
    html += doctor_education;
    html += '<input type="hidden" class="form-control" name="doctor_education[]" value="' + doctor_education + '" required>';
    html += '<div class="invalid-feedback" data-id="doctor_education"></div>';
    html += '</td>';
    html += '<td>';
    html += doctor_education_location;
    html += '<input type="hidden" class="form-control" name="doctor_education_location[]" value="' + doctor_education_location + '" required>';
    html += '<div class="invalid-feedback" data-id="doctor_education_location"></div>';
    html += '</td>';
    html += '<td>';
    html += doctor_education_year;
    html += '<input type="hidden" class="form-control" name="doctor_education_year[]" value="' + doctor_education_year + '" required>';
    html += '<div class="invalid-feedback" data-id="doctor_education_year"></div>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger delete-data-education" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#show-doctor-education").append(html);
    $("#doctor_education").val("");
    $("#doctor_education_location").val("");
    $("#doctor_education_year").val("");
    updateInsertDataNumber("show-doctor-education");
})

$(document).on("click", ".delete-data-education", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumber("show-doctor-education");
});


function updateInsertDataNumber(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    no_insert_data_education = $("#" + id_table + " tr").length;
}

var no_insert_data_employment = 0;
$(document).on("click", "#insert-data-doctor-employment", function () {
    // append file input when trigger click
    const doctor_employment = $("#doctor_employment").val();
    const doctor_employment_start_year = $("#doctor_employment_start_year").val();
    const doctor_employment_end_year = $("#doctor_employment_end_year").val();
    if (doctor_employment == "" || doctor_employment_start_year == "" || doctor_employment_end_year == "") {
        if (doctor_employment == "") {
            $("#doctor_employment").trigger('focus');
        }
        if (doctor_employment_start_year == "") {
            $("#doctor_employment_start_year").trigger('focus');
        }
        if (doctor_employment_end_year == "") {
            $("#doctor_employment_end_year").trigger('focus');
        }
        return false;
    }

    if (parseInt(doctor_employment_start_year) > parseInt(doctor_employment_end_year)) {
        Swal.fire({
            title: 'Warning!',
            text: 'Employment start year must be less than employment end year',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }

    // validate if value input not matches with value before in td
    let check = false;
    $("#show-doctor-employment tr").each(function () {
        if ($(this).find("td:eq(1)").text().toLowerCase() == doctor_employment.toLowerCase()) {
            check = true;
        }
    });
    if (check) {
        Swal.fire({
            title: 'Warning!',
            text: 'Employment already exists',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    if ($("#show-doctor-employment").find("tr").length >= 10) {
        Swal.fire({
            title: 'Warning!',
            text: 'Employment reach maximum 10 data',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: false
        });
        return false;
    }
    let html = '';
    html += '<tr>';
    html += '<td>';
    html += doctor_employment;
    html += '<input type="hidden" class="form-control" name="doctor_employment[]" value="' + doctor_employment + '" required>';
    html += '<div class="invalid-feedback" data-id="doctor_employment"></div>';
    html += '</td>';
    html += '<td>';
    html += doctor_employment_start_year + ' - ' + doctor_employment_end_year;
    html += '<input type="hidden" class="form-control" name="doctor_employment_year[]" value="' + doctor_employment_start_year + ' - ' + doctor_employment_end_year + '" required>';
    html += '<div class="invalid-feedback" data-id="doctor_employment_year"></div>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger delete-data-employment" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#show-doctor-employment").append(html);
    $("#doctor_employment").val("");
    $("#doctor_employment_start_year").val("");
    $("#doctor_employment_end_year").val("");
    updateInsertDataNumber("show-doctor-employment");
})

$(document).on("click", ".delete-data-employment", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumber("show-doctor-employment");
});


function updateInsertDataNumber(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    no_insert_data_employment = $("#" + id_table + " tr").length;
}

$(document).on('submit', '#doctorCreate', function (e) {
    e.preventDefault();
    var tags_language = getTagifyValue('doctor_language');

    var tags_specialist = getTagifyValue('doctor_specialist');

    var tags_hospital = getTagifyValue('doctor_hospital');

    let formData = new FormData(this);

    tags_language.forEach(function (tag) {
        formData.append('doctor_language[]', tag.id);
    });

    tags_specialist.forEach(function (tag) {
        formData.append('doctor_specialist[]', tag.id);
    });

    tags_hospital.forEach(function (tag) {
        formData.append('doctor_hospital[]', tag.id);
    });

    // debug result data
    // console.log(...formData.entries());
    // return false;

    postWithImage(url + '/doctor/create-doctor', 'doctors-ui-table', 'doctorCreate', formData, ['show-doctor-education', 'show-doctor-employment'], false, true);
});

// Edit
$(document).on('click', '#editDoctor', function () {
    // console.log(menu_id);
    var doctor_id = $(this).data("doctor_id");
    $.ajax({
        url: url + '/doctor/edit-doctor',
        type: 'GET',
        data: {
            doctor_id: doctor_id,
            // lang_code: metaLanguage,
            type: 'view'
        },
        dataType: 'json',
        success: function (data) {
            data = data.data;
            // Access the data returned from the AJAX request here
            $('#edit_doctor_specialist_id').val(doctor_specialist_id);
            $('#edit_specialist_name').val(data.specialist.specialist_name);
            $('.edit_specialist_desc textarea').val('');
            data.specialist_desc.forEach(function (item) {
                var edit_specialist_desc = $('#edit_specialist_desc_' + item.lang_code);
                edit_specialist_desc.val(item.specialist_desc);
            });
            // $('#edit_specialist_desc').val(data.specialist_desc);
            // $('#specialistEdit select[name="lang_code"]').val(data.lang_code);
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

// end doctor section