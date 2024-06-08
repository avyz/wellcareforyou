function previewImg(selector, previewImgClass) {
    const fileName = document.querySelector("#" + selector);
    const previewImg = document.querySelector("." + previewImgClass);


    // Ambil gambar dari root file
    const fileCover = new FileReader();
    // Get nama file nya
    fileCover.readAsDataURL(fileName.files[0]);
    // Load gambar
    fileCover.onload = function (e) {
        if (fileName.files[0].type == 'image/jpg' || fileName.files[0].type == 'image/jpeg' || fileName.files[0].type == 'image/png' || fileName.files[0].type == 'image/svg+xml' || fileName.files[0].type == 'image/webp') {
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

function updateCsrfToken(token) {
    $('meta[name="csrf-token"]').attr('content', token);
}

// function dataAjax(data = null) {
//     return data;
// }