<?= $this->extend($layout); ?>

<?= $this->section($section); ?>

<style>
    /* sticky toolbar */
    #toolbar-container-package {
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

            <div class="invalid-feedback" id="hospital_uuid_validation"></div>
            <div class="invalid-feedback" id="hospital_name_validation"></div>
            <div class="invalid-feedback" id="hospital_code_validation"></div>
            <div class="invalid-feedback" id="package_title_validation"></div>
            <div class="invalid-feedback" id="lang_uuid_validation"></div>
            <div class="invalid-feedback" id="lang_code_validation"></div>

            <!-- <form action="#" method="post" enctype="multipart/form-data"> -->
            <input type="hidden" name="hospital_uuid" id="hospital_uuid" value="<?= $data['hospital_uuid'] ?>">
            <input type="hidden" name="hospital_name" id="hospital_name" value="<?= $data['hospital_name'] ?>">
            <input type="hidden" name="hospital_code" id="hospital_code" value="<?= $data['hospital_code'] ?>">
            <input type="hidden" name="lang_code" id="lang_code" value="<?= $data['lang_code'] ?>">
            <div class="row my-3">
                <div class="col-5 col-md-4">
                    <div class="form-group pb-2">
                        <label>Choose Language :</label>
                        <select class="form-control" name="lang_uuid">
                            <option value="" selected disabled>-- Choose your menu language --</option>
                            <?php foreach ($language_list as $d) : ?>
                                <option value="<?= $d['uuid'] ?>" <?php if ($d['lang_code'] == $language_row['lang_code']) : ?>selected<?php endif; ?>><?= $d['language'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="package_title">Title :</label>
                <input type="text" class="form-control" id="package_title" name="package_title" placeholder="Title">
            </div>

            <!-- <div id="editor"></div> -->

            <!-- The toolbar will be rendered in this container. -->
            <div id="toolbar-container-package"></div>

            <!-- This container will become the editable. -->
            <div id="editor-package">
            </div>

            <div class="d-flex justify-content-end my-3">
                <button id="save-package" class="btn btn-primary">Save</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<script src="/assets/cms/js/ckeditor/ckeditor-classic.js"></script>

<script>
    ClassicEditor.create(document.querySelector('#editor-package'), {
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
            const toolbarContainer = document.querySelector('#toolbar-container-package');

            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

            //         editor.setData(`<div class="who-we-are-content">
            //     <span class="top-title">WHO WE ARE</span>
            //     <h2>We have been providing services to patients for over 20 years</h2>
            //     <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</p>
            // </div>`);

            $("#save-package").on("click", function() {
                const content = editor.getData();
                // console.log(content);
                // return;
                const formData = {
                    package: content,
                    lang_uuid: $("select[name='lang_uuid']").val(),
                    hospital_uuid: $("#hospital_uuid").val(),
                    hospital_name: $("#hospital_name").val(),
                    hospital_code: $("#hospital_code").val(),
                    lang_code: $("#lang_code").val(),
                    package_title: $("#package_title").val(),
                };

                postContentEditor(url + '/hospital/hospital/package/data-post', formData);
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