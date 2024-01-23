<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>

<!-- Start Appointment Area -->
<div class="appointments-area ptb-100">
    <div class="container">
        <div class="appointments-conetnt pb-100">
            <h2>Make an appointment</h2>
            <div class="requestor">
                <h3>Requestor information</h3>

                <ul>
                    <li>
                        <span>ARE YOU THE PATIENT?</span>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Yes
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>
                    </li>
                </ul>

                <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>YOUR FIRST NAME</label>
                                <input type="text" class="form-control" placeholder="Edgar">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>YOUR LAST NAME</label>
                                <input type="text" class="form-control" placeholder="Matthews">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="appointments-form">
            <h2>Patient information</h2>

            <form>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>YOUR FIRST NAME</label>
                            <input type="text" class="form-control" placeholder="Edgar">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>YOUR LAST NAME</label>
                            <input type="text" class="form-control" placeholder="Matthews">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>GENDER</label>
                                    <select class="form-select form-control" aria-label="Default select example">
                                        <option selected>Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>EMAIL</label>
                                    <input type="email" class="form-control" placeholder="edgar@example.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>PHONE</label>
                            <input type="text" class="form-control" placeholder="***********">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>DATE OF BIRTH </label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>DATE APPOINTMENT</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>ADDRESS</label>
                            <input type="text" class="form-control" placeholder="your address here">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>CHOOSE DOCTOR NAME</label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>Ben Allen</option>
                                <option value="1">Ybarra Daek</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>SELECT DEPARTMENT</label>
                            <select class="form-select form-control" aria-label="Default select example">
                                <option selected>Cardiology</option>
                                <option value="1">Medicine</option>
                                <option value="2">Cardiology</option>
                                <option value="3">Surgery</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>APPOINTMENT NOTE</label>
                            <textarea class="form-control" cols="30" rows="10" placeholder="Reason for appointment"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="default-btn active">
                            Make an appointment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Appointment Area -->

<?= $this->endSection(); ?>