function previewImg() {
    const fileName = document.querySelector("#cover");
    const previewImg = document.querySelector(".preview-img");


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