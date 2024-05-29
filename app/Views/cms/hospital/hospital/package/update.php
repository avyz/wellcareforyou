<?= $this->extend($layout); ?>

<?= $this->section($section); ?>

<style>
    /* sticky toolbar */
    #edit-toolbar-container-package {
        position: sticky;
        top: 101px;
        z-index: 100;
        background-color: #f1f1f1;
    }
</style>

<div class="row layout-top-spacing">
    <div class="main-content">
        <div class="container">
            <?php if (session()->getFlashdata('notif')) : ?>
                <?= session()->getFlashdata('notif') ?>
            <?php endif; ?>

            <div class="invalid-feedback" id="edit_hospital_uuid_validation"></div>
            <div class="invalid-feedback" id="edit_hospital_name_validation"></div>
            <div class="invalid-feedback" id="edit_hospital_code_validation"></div>
            <div class="invalid-feedback" id="edit_package_title_validation"></div>
            <div class="invalid-feedback" id="edit_lang_uuid_validation"></div>
            <div class="invalid-feedback" id="edit_lang_code_validation"></div>

            <!-- <form action="#" method="post" enctype="multipart/form-data"> -->
            <input type="hidden" name="edit_hospital_uuid" id="edit_hospital_uuid" value="<?= $data['hospital_uuid'] ?>">
            <input type="hidden" name="edit_hospital_package_uuid" id="edit_hospital_package_uuid" value="<?= $data['hospital_package_uuid'] ?>">
            <input type="hidden" name="edit_hospital_name" id="edit_hospital_name" value="<?= $data['hospital_name'] ?>">
            <input type="hidden" name="edit_hospital_code" id="edit_hospital_code" value="<?= $data['hospital_code'] ?>">
            <input type="hidden" name="edit_lang_code" id="edit_lang_code" value="<?= $data['lang_code'] ?>">
            <div class="row my-3">
                <div class="col-5 col-md-4">
                    <div class="form-group pb-2">
                        <label>Choose Language :</label>
                        <select class="form-control" name="edit_lang_uuid">
                            <option value="" selected disabled>-- Choose your menu language --</option>
                            <?php foreach ($language_list as $d) : ?>
                                <option value="<?= $d['uuid'] ?>" <?php if ($d['lang_code'] == $data['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="edit_package_title">Title :</label>
                <input type="text" class="form-control" id="edit_package_title" name="edit_package_title" value="<?= $data['package']['package_title'] ?>" placeholder="Title">
            </div>

            <!-- <div id="editor"></div> -->

            <!-- The toolbar will be rendered in this container. -->
            <div id="edit-toolbar-container-package"></div>

            <!-- This container will become the editable. -->
            <div id="edit-editor-package">
            </div>

            <div class="d-flex justify-content-end my-3">
                <button id="update-package" class="btn btn-primary">Save</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<script src="/assets/cms/js/ckeditor/ckeditor-classic.js"></script>

<script>
    ClassicEditor.create(document.querySelector('#edit-editor-package'), {
            // plugins: ['AutoImage'],
            toolbar: ['undo', 'redo', '|', 'heading', '|', 'alignment', 'indent', '|', 'bold', 'italic', 'underline', 'fontSize', 'fontColor', '|', 'findAndReplace', 'imageUpload', 'bulletedList', 'numberedList', 'link'],

            // image: {
            //     toolbar: [
            //         'toggleImageCaption', 'imageTextAlternative', '|',
            //         'imageStyle:block', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight', 'imageStyle:customStyle'
            //     ],
            //     styles: ['block', 'alignLeft', 'alignCenter', 'alignRight', 'customStyle'],
            // },
            fontSize: {
                options: [
                    9,
                    11,
                    13,
                    'default',
                    17,
                    19,
                    21,
                    23,
                    25,
                    27
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            htmlSupport: {
                allow: [{
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            simpleUpload: {
                uploadUrl: url + '/hospital/package-image/insert',
            },
        }).then(editor => {
            // Handler untuk tombol simpan
            // console.log(Array.from(editor.ui.componentFactory.names()));
            const toolbarContainer = document.querySelector('#edit-toolbar-container-package');

            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

            //         editor.setData(`<div class="who-we-are-content">
            //     <span class="top-title">WHO WE ARE</span>
            //     <h2>We have been providing services to patients for over 20 years</h2>
            //     <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</p>
            // </div>`);

            // Show package content
            editor.setData(`<?= $data['package']['package'] ?>`);

            $("#update-package").on("click", function() {
                const content = editor.getData();
                // console.log(content);
                // return;
                const formData = {
                    edit_package: content,
                    edit_lang_uuid: $("select[name='edit_lang_uuid']").val(),
                    edit_hospital_uuid: $("#edit_hospital_uuid").val(),
                    edit_hospital_name: $("#edit_hospital_name").val(),
                    edit_hospital_code: $("#edit_hospital_code").val(),
                    edit_lang_code: $("#edit_lang_code").val(),
                    edit_package_title: $("#edit_package_title").val(),
                    edit_hospital_package_uuid: $("#edit_hospital_package_uuid").val(),
                };

                postContentEditor(url + '/hospital/hospital/package/data-update', formData);
                // make ajax request to save content
                // $.ajax({
                //     url: url + '/hospital/hospital/package/post',
                //     type: 'POST',
                //     data: {
                //         package: content,
                //         lang_uuid: $("select[name='lang_uuid']").val(),
                //         hospital_uuid: $("#hospital_uuid").val(),
                //         hospital_name: $("#hospital_name").val(),
                //         hospital_code: $("#hospital_code").val(),
                //         lang_code: $("#lang_code").val(),
                //     },
                //     headers: {
                //         'X-CSRF-TOKEN': csrfToken,
                //     },
                //     dataType: 'json',
                //     success: function(response) {
                //         updateCsrfToken(response.token);
                //         $('.sweet-alert').html(response.notification);
                //         setTimeout(function() {
                //             window.location.href = response.redirect;
                //         }, 2000);
                //     }
                // });
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>

<?= $this->endSection(); ?>