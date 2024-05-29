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
    updateInsertDataNumberDoctorEducation("show-doctor-education");
})

$(document).on("click", ".delete-data-education", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumberDoctorEducation("show-doctor-education");
});


function updateInsertDataNumberDoctorEducation(id_table) {
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
    updateInsertDataNumberDoctorEmployment("show-doctor-employment");
})

$(document).on("click", ".delete-data-employment", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    updateInsertDataNumberDoctorEmployment("show-doctor-employment");
});


function updateInsertDataNumberDoctorEmployment(id_table) {
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
var input_edit_doctor_language = document.querySelector('#edit_doctor_language');
var input_edit_doctor_hospital = document.querySelector('#edit_doctor_hospital');
var input_edit_doctor_specialist = document.querySelector('#edit_doctor_specialist');

if (input_edit_doctor_language) {
    makeTags(input_edit_doctor_language, 'edit_doctor_language', 'Type to search language', 6, 'value', ['value'], '/setting/search-language', function (item) {
        return { value: item.language, id: item.lang_code };
    });
}

if (input_edit_doctor_specialist) {
    makeTags(input_edit_doctor_specialist, 'edit_doctor_specialist', 'Type to search specialist', 6, 'value', ['value'], '/doctor/search-specialist', function (item) {
        return { value: item.specialist_name, id: item.uuid };
    });
}

if (input_edit_doctor_hospital) {
    makeTags(input_edit_doctor_hospital, 'edit_doctor_hospital', 'Type to search hospital', 6, 'value', ['value'], '/hospital/search-hospital', function (item) {
        return { value: item.hospital_name, id: item.uuid };
    });
}

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
            var data_doctor = data.data_doctor;
            var data_doctor_language = data.data_language;
            var data_doctor_specialist = data.data_specialist;
            var data_doctor_hospital = data.data_hospital;
            var data_doctor_biography = data.data_biography;
            var data_doctor_education = data.data_education;
            var data_doctor_employment = data.data_employment;
            var data_doctor_worktime = data.data_worktime;

            // console.log(data);
            // return false;
            // Access the data returned from the AJAX request here
            $('#edit_doctor_image_new').val("");
            $('#edit_doctor_id').val(doctor_id);
            $("#edit-show-doctor-image img").attr('src', url + '/assets/website/images/doctor/' + data_doctor.doctor_image);
            $('#edit_doctor_image').val(data_doctor.doctor_image);
            $('#edit_doctor_name').val(data_doctor.doctor_name);
            $('#edit_doctor_gender').val(data_doctor.doctor_gender);
            $('#edit_doctor_phone').val(data_doctor.doctor_phone);

            const json_doctor_language = data_doctor_language.map(function (item) {
                return { value: item.language, id: item.lang_code };
            });

            const json_doctor_hospital = data_doctor_hospital.map(function (item) {
                return { value: item.hospital_name, id: item.hospital_uuid };
            });

            const json_doctor_specialist = data_doctor_specialist.map(function (item) {
                return { value: item.specialist_name, id: item.doctor_specialist_uuid };
            });

            // console.log(json_doctor_language);


            // $('#edit_doctor_language').attr("value", JSON.stringify(json_doctor_language));
            addTagifyValue('edit_doctor_language', json_doctor_language);

            makeTagifyWhiteListFromAjax('/setting/data-language-for-tags', 'edit_doctor_language', function (item) {
                return { value: item.language, id: item.lang_code };
            });

            addTagifyValue('edit_doctor_hospital', json_doctor_hospital);

            makeTagifyWhiteListFromAjax('/hospital/data-hospital-tags', 'edit_doctor_hospital', function (item) {
                return { value: item.hospital_name, id: item.uuid };
            });

            addTagifyValue('edit_doctor_specialist', json_doctor_specialist);

            makeTagifyWhiteListFromAjax('/doctor/data-specialist-tags', 'edit_doctor_specialist', function (item) {
                return { value: item.specialist_name, id: item.uuid };
            });

            // console.log(tagify_value);
            // console.log(json_doctor_language);

            data_doctor_biography.forEach(function (item) {
                var edit_doctor_biography = $('#edit_doctor_biography_' + item.lang_code);
                edit_doctor_biography.val(item.doctor_biography);
            });

            data_doctor_worktime.forEach(function (item) {
                if (item.worktime_start_time != '00:00') {
                    var edit_doctor_worktime_start_ = $('#edit_doctor_worktime_start_' + item.worktime_day);
                    edit_doctor_worktime_start_.val(item.worktime_start_time);
                }
                if (item.worktime_end_time != '00:00') {
                    var edit_doctor_worktime_end_ = $('#edit_doctor_worktime_end_' + item.worktime_day);
                    edit_doctor_worktime_end_.val(item.worktime_end_time);
                }
            });

            // Access the data returned from the AJAX request here
            let html_education = '';
            if (data_doctor_education) {
                data_doctor_education?.map(function (value, index) {
                    html_education += '<tr>';
                    html_education += '<td>';
                    html_education += value.doctor_education;
                    html_education += '<input type="hidden" class="form-control" name="action_type_education[]" value="edit_value">';
                    html_education += '<input type="hidden" class="form-control" name="doctor_education_id[]" value="' + value.uuid + '" required>';
                    html_education += '<input type="hidden" class="form-control" name="edit_doctor_education[]" value="' + doctor_education + '" required>';
                    html_education += '</td>';
                    html_education += '<td>';
                    html_education += value.doctor_education_location;
                    html_education += '<input type="hidden" class="form-control" name="edit_doctor_education_location[]" value="' + value.hospital_phone + '" required>';
                    // html_education += '<div class="invalid-feedback" data-id="edit_branch_hospital_phone"></div>';
                    html_education += '</td>';
                    html_education += '<td>';
                    html_education += value.doctor_education_year;
                    html_education += '<input type="hidden" class="form-control" name="edit_doctor_education_year[]" value="' + value.doctor_education_year + '" required>';
                    // html_education += '<div class="invalid-feedback" data-id="edit_branch_hospital_map_location"></div>';
                    html_education += '</td>';
                    html_education += '<td>';
                    html_education += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-education" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
                    html_education += '</td>';
                    html_education += '</tr>';
                });
            }
            $("#edit-show-doctor-education").html(html_education);

            let html_employment = '';
            if (data_doctor_employment) {
                data_doctor_employment?.map(function (value, index) {
                    html_employment += '<tr>';
                    html_employment += '<td>';
                    html_employment += value.doctor_employment;
                    html_employment += '<input type="hidden" class="form-control" name="action_type_employment[]" value="edit_value">';
                    html_employment += '<input type="hidden" class="form-control" name="doctor_employment_id[]" value="' + value.uuid + '" required>';
                    html_employment += '<input type="hidden" class="form-control" name="edit_doctor_employment[]" value="' + value.doctor_employment + '" required>';
                    html_employment += '</td>';
                    html_employment += '<td>';
                    html_employment += value.doctor_employment_year;
                    html_employment += '<input type="hidden" class="form-control" name="edit_doctor_employment_year[]" value="' + value.doctor_employment_year + '" required>';
                    html_employment += '</td>';
                    html_employment += '<td>';
                    html_employment += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-employment" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
                    html_employment += '</td>';
                    html_employment += '</tr>';
                });
            }
            $("#edit-show-doctor-employment").html(html_employment);

            $("#edit_doctor_address").val(data_doctor.doctor_address);

            editUpdateInsertDataNumberDoctorEducation("edit-show-doctor-education");
            editUpdateInsertDataNumberDoctorEmployment("edit-show-doctor-employment");
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

var edit_no_insert_data_education = 0;
$(document).on("click", "#edit-insert-data-doctor-education", function () {
    // append file input when trigger click
    const doctor_education = $("#edit_doctor_education").val();
    const doctor_education_location = $("#edit_doctor_education_location").val();
    const doctor_education_year = $("#edit_doctor_education_year").val();
    if (doctor_education == "" || doctor_education_location == "" || doctor_education_year == "") {
        if (doctor_education == "") {
            $("#edit_doctor_education").trigger('focus');
        }
        if (doctor_education_location == "") {
            $("#edit_doctor_education_location").trigger('focus');
        }
        if (doctor_education_year == "") {
            $("#edit_doctor_education_year").trigger('focus');
        }
        return false;
    }
    // validate if value input not matches with value before in td
    let check = false;
    $("#edit-show-doctor-education tr").each(function () {
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
    if ($("#edit-show-doctor-education").find("tr").length >= 10) {
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
    html += '<input type="hidden" class="form-control" name="action_type_education[]" value="add_value">';
    html += '<input type="hidden" class="form-control" name="edit_doctor_education[]" value="' + doctor_education + '" required>';
    html += '</td>';
    html += '<td>';
    html += doctor_education_location;
    html += '<input type="hidden" class="form-control" name="edit_doctor_education_location[]" value="' + doctor_education_location + '" required>';
    html += '</td>';
    html += '<td>';
    html += doctor_education_year;
    html += '<input type="hidden" class="form-control" name="edit_doctor_education_year[]" value="' + doctor_education_year + '" required>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-education" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#edit-show-doctor-education").append(html);
    $("#edit_doctor_education").val("");
    $("#edit_doctor_education_location").val("");
    $("#edit_doctor_education_year").val("");
    editUpdateInsertDataNumberDoctorEducation("edit-show-doctor-education");
});

function editUpdateInsertDataNumberDoctorEducation(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    edit_no_insert_data_education = $("#" + id_table + " tr").length;
}

$(document).on("click", ".edit-delete-data-education", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    editUpdateInsertDataNumberDoctorEducation("edit-show-doctor-education");
});

var edit_no_insert_data_employment = 0;
$(document).on("click", "#edit-insert-data-doctor-employment", function () {
    // append file input when trigger click
    const doctor_employment = $("#edit_doctor_employment").val();
    const doctor_employment_start_year = $("#edit_doctor_employment_start_year").val();
    const doctor_employment_end_year = $("#edit_doctor_employment_end_year").val();
    if (doctor_employment == "" || doctor_employment_start_year == "" || doctor_employment_end_year == "") {
        if (doctor_employment == "") {
            $("#edit_doctor_employment").trigger('focus');
        }
        if (doctor_employment_start_year == "") {
            $("#edit_doctor_employment_start_year").trigger('focus');
        }
        if (doctor_employment_end_year == "") {
            $("#edit_doctor_employment_end_year").trigger('focus');
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
    $("#edit-show-doctor-employment tr").each(function () {
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
    if ($("#edit-show-doctor-employment").find("tr").length >= 10) {
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
    html += '<input type="hidden" class="form-control" name="action_type_employment[]" value="add_value">';
    html += '<input type="hidden" class="form-control" name="edit_doctor_employment[]" value="' + doctor_employment + '" required>';
    html += '</td>';
    html += '<td>';
    html += doctor_employment_start_year + ' - ' + doctor_employment_end_year;
    html += '<input type="hidden" class="form-control" name="edit_doctor_employment_year[]" value="' + doctor_employment_start_year + ' - ' + doctor_employment_end_year + '" required>';
    html += '</td>';
    html += '<td>';
    html += '<a href="javascript:void(0)" type="button" class="text-danger edit-delete-data-employment" style="cursor:pointer"><i class="ri-delete-bin-line"></i></a>';
    html += '</td>';
    html += '</tr>';
    $("#edit-show-doctor-employment").append(html);
    $("#edit_doctor_employment").val("");
    $("#edit_doctor_employment_start_year").val("");
    $("#edit_doctor_employment_end_year").val("");
    editUpdateInsertDataNumberDoctorEmployment("edit-show-doctor-employment");
});

$(document).on("click", ".edit-delete-data-employment", function () {
    // remove file input when trigger click
    $(this).closest("tr").remove();
    editUpdateInsertDataNumberDoctorEmployment("edit-show-doctor-employment");
});

function editUpdateInsertDataNumberDoctorEmployment(id_table) {
    $("#" + id_table + " tr").each(function (index) {
        $(this).find('.invalid-feedback').each(function (indexFeedback) {
            let data_id = $(this).data("id");
            $(this).attr('id', data_id + '_validation_' + index);
        })
    });
    edit_no_insert_data_employment = $("#" + id_table + " tr").length;
}

$(document).on('submit', '#doctorEdit', function (e) {
    e.preventDefault();
    var tags_language = getTagifyValue('edit_doctor_language');

    var tags_specialist = getTagifyValue('edit_doctor_specialist');

    var tags_hospital = getTagifyValue('edit_doctor_hospital');

    let formData = new FormData(this);

    tags_language.forEach(function (tag) {
        formData.append('edit_doctor_language[]', tag.id);
    });

    tags_specialist.forEach(function (tag) {
        formData.append('edit_doctor_specialist[]', tag.id);
    });

    tags_hospital.forEach(function (tag) {
        formData.append('edit_doctor_hospital[]', tag.id);
    });

    putWithImage(url + '/doctor/edit-doctor', 'doctors-ui-table', 'doctorEdit', formData, ['edit-show-doctor-education', 'edit-show-doctor-employment'], false, true);
});

// end doctor section