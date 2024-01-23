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
                <div class="mt-2 mt-xl-0 col-md-12 col-lg-6">
                    <select class="form-select" name="hospital" id="hospital">
                        <option value="" selected>Select Hospital</option>
                        <option value="hospital1">Hospital 1</option>
                        <option value="hospital2">Hospital 2</option>
                        <option value="hospital3">Hospital 3</option>
                        <option value="hospital4">Hospital 4</option>
                        <option value="hospital5">Hospital 5</option>
                    </select>
                </div>
                <div class="mt-2 mt-xl-0 col-md-12 col-lg-6">
                    <select class="form-select" name="location" id="location">
                        <option value="" selected>Select Location</option>
                        <option value="location1">Location 1</option>
                        <option value="location2">Location 2</option>
                        <option value="location3">Location 3</option>
                        <option value="location4">Location 4</option>
                        <option value="location5">Location 5</option>
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

<!-- Start Hospital Area -->
<div class="hospital-area pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Hospital, Urgent Care, and Other Health Facility Locations</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="/hospitals/Hospitals in Atlanta">
                        <img src="/assets/website/images/hospital/hospital-1.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="/hospitals/Hospitals in Atlanta">
                                Hospitals in Atlanta
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                DKI Jakarta 11825, Indonesia
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95544</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-2.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in atlanta
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                DKI Jakarta 11825, Indonesia
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95544</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-3.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in austin
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                7722 N Mopac Expy Ste 3004, Austin, TX, 78878
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95545</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-4.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in baltimore
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                2998 Maryland Ave, Baltimore, MK, 19221
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95546</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-5.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in boston
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                7535 Boylston MK 5th Fl, Boston, MK, 889952
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95547</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-6.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in buffalo
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                3355 Kensington Ave, Buffalo, MK, 1586547
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95548</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-7.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in chicago
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                7755 West Chi 63rd St, Chicago, IL 258314
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95549</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-8.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in cleveland
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                9922 Euclid Avenue, Cleveland, OH 33885
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95510</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-hospital">
                    <a href="hospital-details.html">
                        <img src="/assets/website/images/hospital/hospital-9.jpg" alt="Image">
                    </a>
                    <div class="hospital-content">
                        <h3>
                            <a href="hospital-details.html">
                                Hospitals in washington DC
                            </a>
                        </h3>
                        <ul>
                            <li>
                                <span>Address:</span>
                                3578 St NW Ste 110, Washington, DC 900752
                            </li>
                            <li>
                                <span>Phone:</span>
                                <a href="tel:-(616)-999-95544">(616) 999-95511</a>
                            </li>
                        </ul>

                        <a href="appointment.html" class="default-btn active">
                            Book an appointment
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="pagination-area">
                    <a href="hospital.html" class="next page-numbers">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                    <span class="page-numbers current" aria-current="page">1</span>
                    <a href="hospital.html" class="page-numbers">2</a>
                    <a href="hospital.html" class="page-numbers">3</a>

                    <a href="hospital.html" class="next page-numbers">
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hospital Area -->

<?= $this->endSection(); ?>