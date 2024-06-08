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
    if (!link.classList.contains('menu-access')) {
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
    } else {
        if (!link.classList.contains('single-menu')) {
            if (currentUrl.split("?")[0] === link.children[0].href.split("?")[0]) {
                var parent = link.parentNode.parentNode;
                parent.classList.add('active');
                parent.children[0].setAttribute("aria-expanded", "true");
                parent.children[1].classList.add('show');
                link.classList.add('active');
            }
        } else {
            if (currentUrl.split("?")[0] === link.children[0].href.split("?")[0]) {
                link.classList.add('active');
            }
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

function changeLang(e, link_url, selection_name = null, modal_name = null, isRefresh = false) {
    menu_lang_code = $(e).val();
    if (isRefresh) {
        $('#' + selection_name).load(link_url + "?lang_code=" + menu_lang_code + "&type=edit");
    } else {
        updateLanguage(menu_lang_code);
        selection_name.ajax.url(link_url + "?lang_code=" + menu_lang_code).load();
        if (modal_name) {
            $("#" + modal_name + " select[name='lang_code']").val(menu_lang_code);
        } else {
            $("select[name='lang_code']").val(menu_lang_code);
        }
    }
}