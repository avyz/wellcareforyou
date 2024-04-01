// var Theme = 'light';

// /*
//          =================================
//              Revenue Monthly | Options
//          =================================
//      */
// var options1 = {
//     chart: {
//         fontFamily: 'Poppins, sans-serif',
//         height: 365,
//         type: 'area',
//         zoom: {
//             enabled: false
//         },
//         dropShadow: {
//             enabled: true,
//             opacity: 0.2,
//             blur: 10,
//             left: -7,
//             top: 22
//         },
//         toolbar: {
//             show: false
//         },
//     },
//     colors: ['#1b55e2', '#e7515a'],
//     dataLabels: {
//         enabled: false
//     },
//     markers: {
//         discrete: [{
//             seriesIndex: 0,
//             dataPointIndex: 7,
//             fillColor: '#000',
//             strokeColor: '#000',
//             size: 5
//         }, {
//             seriesIndex: 2,
//             dataPointIndex: 11,
//             fillColor: '#000',
//             strokeColor: '#000',
//             size: 4
//         }]
//     },
//     subtitle: {
//         text: '$10,840',
//         align: 'left',
//         margin: 0,
//         offsetX: 110,
//         offsetY: 20,
//         floating: false,
//         style: {
//             fontSize: '18px',
//             color: '#4361ee'
//         }
//     },
//     title: {
//         text: 'Total Profit',
//         align: 'left',
//         margin: 0,
//         offsetX: -10,
//         offsetY: 20,
//         floating: false,
//         style: {
//             fontSize: '18px',
//             color: '#0e1726',
//             fontWeight: 500
//         },
//     },
//     stroke: {
//         show: true,
//         curve: 'smooth',
//         width: 2,
//         lineCap: 'square'
//     },
//     series: [{
//         name: 'Expenses',
//         data: [16800, 16800, 15500, 14800, 15500, 17000, 21000, 16000, 15000, 17000, 14000, 17000]
//     }, {
//         name: 'Income',
//         data: [16500, 17500, 16200, 17300, 16000, 21500, 16000, 17000, 16000, 19000, 18000, 19000]
//     }],
//     labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
//     xaxis: {
//         axisBorder: {
//             show: false
//         },
//         axisTicks: {
//             show: false
//         },
//         crosshairs: {
//             show: true
//         },
//         labels: {
//             offsetX: 0,
//             offsetY: 5,
//             style: {
//                 fontSize: '12px',
//                 fontFamily: 'Poppins, sans-serif',
//                 cssClass: 'apexcharts-xaxis-title',
//             },
//         }
//     },
//     yaxis: {
//         labels: {
//             formatter: function (value, index) {
//                 return (value / 1000) + 'K'
//             },
//             offsetX: -15,
//             offsetY: 0,
//             style: {
//                 fontSize: '12px',
//                 fontFamily: 'Poppins, sans-serif',
//                 cssClass: 'apexcharts-yaxis-title',
//             },
//         }
//     },
//     grid: {
//         borderColor: '#e0e6ed',
//         strokeDashArray: 5,
//         xaxis: {
//             lines: {
//                 show: true
//             }
//         },
//         yaxis: {
//             lines: {
//                 show: false,
//             }
//         },
//         padding: {
//             top: -50,
//             right: 0,
//             bottom: 0,
//             left: 5
//         },
//     },
//     legend: {
//         position: 'top',
//         horizontalAlign: 'right',
//         offsetY: -50,
//         fontSize: '16px',
//         fontFamily: 'Quicksand, sans-serif',
//         markers: {
//             width: 10,
//             height: 10,
//             strokeWidth: 0,
//             strokeColor: '#fff',
//             fillColors: undefined,
//             radius: 12,
//             onClick: undefined,
//             offsetX: -5,
//             offsetY: 0
//         },
//         itemMargin: {
//             horizontal: 10,
//             vertical: 20
//         }

//     },
//     tooltip: {
//         theme: Theme,
//         marker: {
//             show: true,
//         },
//         x: {
//             show: false,
//         }
//     },
//     fill: {
//         type: "gradient",
//         gradient: {
//             type: "vertical",
//             shadeIntensity: 1,
//             inverseColors: !1,
//             opacityFrom: .19,
//             opacityTo: .05,
//             stops: [100, 100]
//         }
//     },
//     responsive: [{
//         breakpoint: 575,
//         options: {
//             legend: {
//                 offsetY: -50,
//             },
//         },
//     }]
// }

// /*
//         ================================
//             Revenue Monthly | Render
//         ================================
//     */
// var chart1 = new ApexCharts(
//     document.querySelector("#revenueMonthly"),
//     options1
// );

// chart1.render();

var currentUrl = window.location.href;
var origin = window.location.origin;

if (currentUrl.split("/").length > 4) {
    currentUrl = origin + "/" + currentUrl.replace("#_=_", '').split("/")[3] + "/" + currentUrl.replace("#_=_", '').split("/")[4]
} else {
    currentUrl = origin + "/" + currentUrl.replace("#_=_", '').split("/")[3]
}


// Menemukan elemen <a> yang sesuai dengan path URL
var navLinks = $('.menu-link-sidebar');
navLinks.map((index, link) => {
    // // Memeriksa apakah path URL cocok dengan link URL
    if (!link.classList.contains('single-menu')) {
        if (currentUrl.split("?")[0] === link.children[0].href) {
            var parent = link.parentNode.parentNode;
            parent.classList.add('active');
            parent.children[0].setAttribute("aria-expanded", "true");
            parent.children[1].classList.add('show');
            link.classList.add('active');
        }
    } else {
        if (currentUrl.split("?")[0] === link.children[0].href) {
            link.classList.add('active');
        }
    }
})

// Fungsi untuk menyimpan status tab ke dalam local storage
function saveTabStatus(tabId) {
    localStorage.setItem('activeTab', tabId);
} saveTabStatus

// Fungsi untuk memuat status tab dari local storage
function loadTabStatus() {
    return localStorage.getItem('activeTab');
}

// Fungsi untuk mengaktifkan tab berdasarkan status yang tersimpan
function activateSavedTab() {
    localStorage.removeItem('activeTab');
    var activeTabId = loadTabStatus();
    if (activeTabId) {
        var tabs = $(".menutab>.nav-link");
        tabs.map(function (index, tab) {
            let tabSelector = tab.getAttribute('id').split('-')[0];
            if (tabSelector != activeTabId) {
                tab.classList.remove('active');
            }
        });
        var tabContents = $('.tab-content>.tab-pane');
        tabContents.map(function (index, content) {
            content.classList.remove('active')
            content.classList.remove('show')
            // console.log(content);
        });
        // Aktifkan tab yang sesuai
        $("#" + activeTabId + "-tab").addClass('active');
        // Tampilkan konten tab yang sesuai
        $("#" + activeTabId + '-tab-pane').addClass('active show');
        // Update target BS
        $("#create-btn").attr("data-bs-target", "#" + activeTabId + "CreateModal");
        $("#create-btn").attr("data-section-tab", activeTabId + "Create");
    }
    var tabs_active = $(".menutab>.nav-link.active");
    if (tabs_active.length > 0) {
        const selection_active = tabs_active.attr('id').split('-')[0];
        const canCreate = $("#" + selection_active + "-tab").data("create");
        if (canCreate == 1) {
            $("#create-btn").attr("data-bs-target", "#" + selection_active + "CreateModal");
            $("#create-btn").attr("data-section-tab", "#" + selection_active + "Create");
            $("#create-btn").show();
        } else {
            $("#create-btn").attr("data-bs-target", "");
            $("#create-btn").attr("data-section-tab", "");
            $("#create-btn").hide();
        }
    }
}

// Jalankan fungsi untuk memuat status tab ketika halaman dimuat
window.onload = function () {
    activateSavedTab();
}

// Fungsi event handler untuk menangani klik tab
function handleTabClick(tabId) {
    // Hapus kelas 'active' dari semua tab
    // var tabs = document.querySelectorAll('.tab');
    var tabs = $(".menutab>.nav-link");
    tabs.map(function (index, tab) {
        // console.log(tab);
        tab.classList.remove('active');
    });


    $("#create-btn").attr("data-bs-target", "");
    $("#create-btn").attr("data-section-tab", "");

    // Aktifkan tab yang diklik
    // document.getElementById(tabId).classList.add('active');
    $("#" + tabId + '-tab').addClass('active');
    // Sematkan konten tab yang sesuai
    // var tabContents = document.querySelectorAll('.tab-content');
    var tabContents = $('.tab-content>.tab-pane');
    tabContents.map(function (index, content) {
        content.classList.remove('active')
        content.classList.remove('show')
        // console.log(content);
    });

    // document.getElementById(tabId + '-tab-pane').style.display = 'block';
    $("#" + tabId + '-tab-pane').addClass('active show');
    // Update target BS
    const canCreate = $("#" + tabId + "-tab").data("create");
    if (canCreate == 1) {
        $("#create-btn").show();
        $("#create-btn").attr("data-bs-target", "#" + tabId + "CreateModal");
        $("#create-btn").attr("data-section-tab", tabId + "Create");
        // Simpan status tab yang aktif ke dalam local storage
        saveTabStatus(tabId);
    } else {
        $("#create-btn").hide();
        $("#create-btn").attr("data-bs-target", "");
        $("#create-btn").attr("data-section-tab", "");
    }
}

function updateCsrfToken(token) {
    $('meta[name="csrf-token"]').attr('content', token);

}

function getDropdown(data_values, link, value_name, value_id, name_selector, id_selector, key_name, type = '', edit_values = '') {
    $.ajax({
        url: url + link,
        type: 'GET',
        data: data_values,
        dataType: 'json',
        success: function (data) {
            let html = '';
            html += '<option value="">-- Choose your selection --</option>'
            if (data[key_name]) {
                for (const [key, value] of Object.entries(data[key_name])) {
                    if (type == 'add') {
                        html += '<option value="' + value[value_id] + '">' + value[value_name] + '</option>'
                    } else {
                        if (value[value_id] != data_values[edit_values]) {
                            html += '<option value="' + value[value_id] + '">' + value[value_name] + '</option>'
                        } else {
                            html += '<option value="' + value[value_id] + '" selected>' + value[value_name] + '</option>'
                        }
                    }
                };
            }
            $("#" + id_selector + " select[name='" + name_selector + "']").html(html);
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
}

// Fungsi untuk onchange tanggal
function dateVal(e, date_end) {
    var date_start = $(e).val();
    if (date_start != "") {
        $("#" + date_end).val(date_start).attr('min', date_start).attr('readonly', false);

        // Tambahkan 7 hari ke tanggal start untuk mendapatkan tanggal max
        var maxDate = new Date(date_start);
        maxDate.setDate(maxDate.getDate() + 7);

        // Format tanggal menjadi YYYY-MM-DD
        var maxDateString = maxDate.toISOString().split('T')[0];

        // Set atribut max ke input date_end
        $("#" + date_end).attr('max', maxDateString);
    } else {
        $("#" + date_end).val("").attr('min', "").attr('max', "").attr('readonly', true);

    }
}

function toggleClick(e, target_after, target_before) {
    $(e).toggleClass('expand');

    if ($(e).hasClass('expand')) {
        $(e).addClass(target_after);
        $(e).removeClass(target_before);
    } else {
        $(e).removeClass(target_after);
        $(e).addClass(target_before);
    }
}

// Expand Children in datatable
function clickChildren(e, link, value_id, func = null, variable_datatable = null) {

    var tr = $(e).closest('tr');
    var row = variable_datatable.row(tr);

    if (row.child.isShown()) {
        // Tutup tabel anak jika sudah terbuka
        row.child.hide();
        tr.removeClass('shown');
    } else {
        // Ambil data untuk baris saat ini
        var rowData = row.data();
        // console.log(rowData);
        // Kirim permintaan Ajax untuk memuat data tabel anak
        $.ajax({
            url: url + link,
            type: 'GET',
            data: { id: rowData[value_id] },
            dataType: 'json',
            success: function (response) {
                // Tampilkan data tabel anak di bawah baris utama
                row.child(func(response)).show();
                tr.addClass('shown');
            }
        });
    }

}
// Expand Children Tab in datatable
function clickChildrenTab(e, link, value_id, func = null, parent_url = null, parent_id = null) {
    $.ajax({
        url: url + parent_url,
        type: 'GET',
        data: { id: parent_id },
        dataType: 'json',
        success: function (response) {
            // Temukan baris terdekat yang mengandung elemen e
            var tr = $(e).closest('tr');
            if (tr.hasClass('shown')) {
                // Sembunyikan tabel anak jika sudah terbuka
                tr.removeClass('shown');
                tr.next('tr.child-row').remove(); // Hapus tabel anak jika sudah ada
            } else {
                var rowData = response[0];
                // Kirim permintaan Ajax untuk memuat data tabel anak
                $.ajax({
                    url: url + link,
                    type: 'GET',
                    data: { id: rowData[value_id] },
                    dataType: 'json',
                    success: function (response) {
                        // Buat baris baru untuk tabel anak
                        var childRow = $('<tr class="child-row"><td colspan="10"></td></tr>');
                        // Masukkan tabel anak di bawah baris utama
                        tr.after(childRow);
                        // Tambahkan kelas 'shown' ke baris utama
                        tr.addClass('shown');
                        // Isi tabel anak dengan data yang diterima dari respons Ajax
                        var childCell = childRow.find('td');
                        childCell.append(func(response));
                    }
                });
            }
        }
    });

    // var rowData = tr.find('td').map(function () {
    //     // Periksa apakah ada elemen input di dalam <td>
    //     var inputElement = $(this).find('input');
    //     if (inputElement.length > 0) {
    //         // Jika ada elemen input, kembalikan nilai dari input tersebut
    //         return inputElement.val();
    //     } else {
    //         // Jika tidak ada elemen input, kembalikan nilai teks dari <td>
    //         return $(this).text();
    //     }
    // }).get();

    // console.log(rowData);

    // if (tr.next().hasClass('child-row')) {
    //     // Tutup tabel anak jika sudah terbuka
    //     tr.next().remove();
    // } else {
    //     // Kirim permintaan Ajax untuk memuat data tabel anak
    //     $.ajax({
    //         url: url + link,
    //         type: 'GET',
    //         data: { id: rowData[value_id] },
    //         dataType: 'json',
    //         success: function (response) {
    //             // Tampilkan data tabel anak di bawah baris utama
    //             // row.child().show();
    //             tr.after(func(response));
    //         }
    //     });
    // }

}

function validationButtons(e = null) {
    var tabs_active = $(e);
    tabs_active.data('edit') === 1 ? $(".buttons-edit").attr("disabled", false) : $(".buttons-edit").attr("disabled", true);
    tabs_active.data('delete') === 1 ? $(".buttons-delete").show() : $(".buttons-delete").hide();
    tabs_active.data('buttons_csv') === 1 ? $(".buttons-csv").show() : $(".buttons-csv").hide();
    tabs_active.data('buttons_excel') === 1 ? $(".buttons-excel").show() : $(".buttons-excel").hide();
    tabs_active.data('buttons_print') === 1 ? $(".buttons-print").show() : $(".buttons-print").hide();
}

// function changeFileInput(e, label, name, match_value_file_name) {
//     $("#" + label).text(e.files[0].name);
//     $(e).attr("name", name);
//     // Untuk conditional di server side
//     $("#" + match_value_file_name).val(e.files[0].name);
// }

// $(document).on("click", "#submit-data", function (e) {
//     $(e).attr('disabled', true);
//     setTimeout(() => {
//         $(e).attr('disabled', false);
//     }, 3000);
//     $(e).submit();
// });

function previewImg(selector, previewImgClass) {
    const fileName = document.querySelector("#" + selector);
    const previewImg = document.querySelector("." + previewImgClass);


    // Ambil gambar dari root file
    const fileCover = new FileReader();
    // Get nama file nya
    fileCover.readAsDataURL(fileName.files[0]);
    // Load gambar
    fileCover.onload = function (e) {
        if (fileName.files[0].type == 'image/jpg' || fileName.files[0].type == 'image/jpeg' || fileName.files[0].type == 'image/png') {
            previewImg.src = e.target.result;
        } else {
            Swal.fire({
                title: "Error",
                text: "File yang anda masukkan tidak valid",
                icon: "error",
                timer: 0,
                showConfirmButton: true
            });
        }
    }
}