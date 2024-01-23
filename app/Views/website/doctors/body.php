<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<?= $this->include('layout/website/breadcrumbs') ?>

<!-- Country Area -->
<div class="country-area pt-70 pb-70">
    <div class="container px-5">
        <div class="section-title mb-1">
            <span class="top-title">CHOOSE COUNTRY</span>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 col-lg-10">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <img class="rounded-circle my-4" style="width: 25px;height:24px;" src="/assets/website/images/lang/flag-icon-china.png" alt="china">
                            <div>
                                China
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <img class="rounded-circle my-4" style="width: 25px;height:24px;" src="/assets/website/images/lang/flag-icon-indonesia.png" alt="indonesia">
                            <div>
                                Indonesia
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <img class="rounded-circle my-4" style="width: 25px;height:24px;" src="/assets/website/images/lang/flag-icon-malaysia.png" alt="malaysia">
                            <div>
                                Malaysia
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <img class="rounded-circle my-4" style="width: 25px;height:24px;" src="/assets/website/images/lang/flag-icon-singapura.png" alt="singapura">
                            <div>
                                Singapura
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <img class="rounded-circle my-4" style="width: 25px;height:24px;" src="/assets/website/images/lang/flag-icon-taiwan.png" alt="taiwan">
                            <div>
                                Taiwan
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <img class="rounded-circle my-4" style="width: 25px;height:24px;" src="/assets/website/images/lang/flag-icon-thailand.png" alt="thailand">
                            <div>
                                Thailand
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="/" method="post">
            <div class="mt-4 row justify-content-center">
                <div class="mt-2 mt-xl-0 col-md-12 col-lg-2">
                    <select class="form-select" name="hospital" id="hospital">
                        <option value="" selected>Select Hospital</option>
                        <option value="hospital1">Hospital 1</option>
                        <option value="hospital2">Hospital 2</option>
                        <option value="hospital3">Hospital 3</option>
                        <option value="hospital4">Hospital 4</option>
                        <option value="hospital5">Hospital 5</option>
                    </select>
                </div>
                <div class="mt-2 mt-xl-0 col-md-3 col-lg-4">
                    <select class="form-select" name="specialist" id="specialist">
                        <option value="" selected>Select Specialist</option>
                        <option value="specialist1">Specialist 1</option>
                        <option value="specialist2">Specialist 2</option>
                        <option value="specialist3">Specialist 3</option>
                        <option value="specialist4">Specialist 4</option>
                        <option value="specialist5">Specialist 5</option>
                    </select>
                </div>
                <div class="mt-2 mt-xl-0 col-md-3 col-lg-2">
                    <select class="form-select" name="location" id="location">
                        <option value="" selected>Select Location</option>
                        <option value="location1">Location 1</option>
                        <option value="location2">Location 2</option>
                        <option value="location3">Location 3</option>
                        <option value="location4">Location 4</option>
                        <option value="location5">Location 5</option>
                    </select>
                </div>
                <div class="mt-2 mt-xl-0 col-md-3 col-lg-2">
                    <select class="form-select" name="doctor_name" id="doctor_name">
                        <option value="" selected>Select Doctor</option>
                        <option value="doctor_name1">Doctor 1</option>
                        <option value="doctor_name2">Doctor 2</option>
                        <option value="doctor_name3">Doctor 3</option>
                        <option value="doctor_name4">Doctor 4</option>
                        <option value="doctor_name5">Doctor 5</option>
                    </select>
                </div>
                <div class="mt-2 mt-xl-0 col-md-3 col-lg-2">
                    <select class="form-select" name="doctor_gender" id="doctor_gender">
                        <option value="" selected>Select Gender</option>
                        <option value="doctor_gender1">Gender 1</option>
                        <option value="doctor_gender2">Gender 2</option>
                        <option value="doctor_gender3">Gender 3</option>
                        <option value="doctor_gender4">Gender 4</option>
                        <option value="doctor_gender5">Gender 5</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button class="py-2 default-btn px-auto d-flex justify-content-center" type="submit" style="width: 320px;max-width:100%">Search</button>
            </div>
        </form>
    </div>
</div>
<!-- End Country Area -->

<!-- Start Our Team Area -->
<div class="our-team-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-1.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Glenn Arredondo</a>
                    </h3>
                    <span>Family Physicians</span>
                    <div class="mt-3">
                        <a href="/doctors/profile/Glenn Arredondo">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="/doctors/appointment/Glenn Arredondo">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-2.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Dorthy Winters</a>
                    </h3>
                    <span>Family Physicians</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-3.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Christopher Perreault</a>
                    </h3>
                    <span>Gastroenterologists</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-4.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Linda Flores</a>
                    </h3>
                    <span>Gynecologists</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-5.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">James Sexton</a>
                    </h3>
                    <span>General Practitioner</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-6.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Margaret Hernandez</a>
                    </h3>
                    <span>Dermatology</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-7.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Jesse Gage</a>
                    </h3>
                    <span>Plastic Surgery</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-8.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Cara Farrington</a>
                    </h3>
                    <span>Family Medicine</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-9.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Harold Freeman</a>
                    </h3>
                    <span>Hepatology & Nutrition</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-10.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Barbara Puckett</a>
                    </h3>
                    <span>Internal Medicine</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-11.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Harris Jackson</a>
                    </h3>
                    <span>Subspecialty Care</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-team text-center">
                    <img src="/assets/website/images/team/team-12.jpg" alt="Image">
                    <h3>
                        <a href="doctor-details.html">Gudrun Phillips</a>
                    </h3>
                    <span>Radiologist</span>
                    <div class="mt-3">
                        <a href="#">
                            <button class="btn btn-info p-2">View Profile</button>
                        </a>
                        <a href="#">
                            <button class="default-btn p-2">Book Now</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="pagination-area">
                    <a href="find-a-doctor.html" class="next page-numbers">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                    <span class="page-numbers current" aria-current="page">1</span>
                    <a href="find-a-doctor.html" class="page-numbers">2</a>
                    <a href="find-a-doctor.html" class="page-numbers">3</a>

                    <a href="find-a-doctor.html" class="next page-numbers">
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Our Team Area -->

<?= $this->endSection(); ?>