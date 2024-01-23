<?= $this->extend($layout); ?>

<?= $this->section($section); ?>
<!-- Start Hero Area -->
<div class="hero-area">
    <div class="swiper hero-slide">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image:url(/assets/website/images/hero/wellcareforyou.jpg)">
                <div class="container">
                    <div class="hero-content px-4">
                        <h1>Our strength is your well-being</h1>
                        <p>Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                        <div class="hero-btn">
                            <a href="/about" class="default-btn">Learn more</a>
                            <a href="/contact-us" class="default-btn active">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide" style="background-image:url(/assets/website/images/hero/wellcareforyou.jpg)">
                <div class="container">
                    <div class="hero-content px-4">
                        <h1>We want to heal the patient</h1>
                        <p>Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                        <div class="hero-btn">
                            <a href="/about" class="default-btn">Learn more</a>
                            <a href="/contact-us" class="default-btn active">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide" style="background-image:url(/assets/website/images/hero/wellcareforyou.jpg)">
                <div class="container">
                    <div class="hero-content px-4">
                        <h1>Need your expertise</h1>
                        <p>Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.</p>
                        <div class="hero-btn">
                            <a href="/about" class="default-btn">Learn more</a>
                            <a href="/contact-us" class="default-btn active">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="swiper-pagination"></div>
    <!-- <div class="pagination-btn">
    </div> -->

    <!-- <ul class="socila-link">
        <li>
            <a href="https://www.facebook.com/" target="_blank">
                <img src="/assets/website/images/svg-icon/facebook.svg" alt="Image">
            </a>
        </li>
        <li>
            <a href="https://www.twitter.com/" target="_blank">
                <img src="/assets/website/images/svg-icon/twitter.svg" alt="Image">
            </a>
        </li>
        <li>
            <a href="https://www.linkedin.com/" target="_blank">
                <img src="/assets/website/images/svg-icon/linkedin.svg" alt="Image">
            </a>
        </li>
    </ul> -->
</div>
<!-- End Hero Area -->

<!-- Country Area -->
<div class="country-area pt-100 pb-70">
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

<!-- Start Futcher Area -->
<div class="futcher-area pt-70 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-4 col-md-4">
                <div class="single-futcher">
                    <div class="icon-one d-flex justify-content-between">
                        <i class="flaticon-consultation opacity0"></i>
                        <i class="flaticon-consultation opacity1"></i>
                    </div>
                    <h3>Find a lab, Clinic & Hospital</h3>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 col-md-4">
                <div class="single-futcher">
                    <div class="icon-one d-flex justify-content-between">
                        <i class="flaticon-search opacity0"></i>
                        <i class="flaticon-search opacity1"></i>
                    </div>
                    <h3>Visit a Doctors</h3>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 col-md-4">
                <div class="single-futcher">
                    <div class="icon-one d-flex justify-content-between">
                        <i class="flaticon-drugs opacity0"></i>
                        <i class="flaticon-drugs opacity1"></i>
                    </div>
                    <h3>Find a Pharmacy</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Futcher Area -->

<!-- Mini Appointment -->
<div class="futcher-area py-5 bg-color-main">
    <div class="px-5 text-center">
        <h2 class="text-white">
            We Take Care Your Health
            <a href="#appointment">
                <button type="button" class="border border-3 btn btn-outline-blue mt-2 ms-0 ms-md-2 mt-md-0">Make an appointment today</button>
            </a>
        </h2>
    </div>
</div>
<!-- End -->

<!-- Start Who We Are Area -->
<div class="who-we-are-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="mr-44">
                    <div class="row align-items-end">
                        <div class="col-lg-7 col-md-6">
                            <div class="who-we-are-img img-1">
                                <img src="/assets/website/images/about/about-1.jpg" alt="image">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="who-we-are-img-2">
                                <h3>Connect With <span>Wellcareforyou</span> Health Care</h3>
                                <img src="/assets/website/images/about/about-2.jpg" alt="image">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="who-we-are-img-3">
                                <img src="/assets/website/images/about/about-3.jpg" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ml-44">
                    <div class="who-we-are-content">
                        <span class="top-title">WHO WE ARE</span>
                        <h2>We have been providing services to patients for over 20 years</h2>
                        <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</p>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="single-who-we-are">
                                <i class="flaticon-hands"></i>
                                <h3>1K+ Healing Hands</h3>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single-who-we-are">
                                <i class="flaticon-doctor"></i>
                                <h3>Experience Doctors</h3>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single-who-we-are">
                                <i class="flaticon-handshake"></i>
                                <h3>Advanced Healthcare</h3>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="single-who-we-are">
                                <i class="flaticon-pharmacy"></i>
                                <h3>50+ Pharmacies</h3>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Proin eget tortor risus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Who We Are Area -->

<!-- Start Our Specialist Area -->
<div class="our-department-area bg-color-f8f9fa pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="top-title">OUR SPECIALIST</span>
            <h2>Our hospital has all kinds of specialist, so you can get all kinds of treatment</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-1.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Dental
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Dental
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-2.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Orthopedics
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Orthopedics
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-3.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Neurosciences
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Neurosciences
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-4.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Cancer care
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Cancer care
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-5.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Gastroenterology
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Gastroenterology
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-6.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Medicine
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Medicine
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-7.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Cardiology
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Cardiology
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="single-our-department">
                    <img src="/assets/website/images/department/department-8.jpg" alt="Image">

                    <div class="department-content one">
                        <h3>
                            <a href="#">
                                Surgery
                            </a>
                        </h3>

                        <p>Pellentesque nec, egestas non nisi. Sed porttitor lectus nibh.</p>
                    </div>

                    <div class="department-content hover">
                        <div class="icon">
                            <i class="flaticon-fracture"></i>
                        </div>
                        <h3>
                            <a href="#">
                                Surgery
                            </a>
                        </h3>
                        <p>Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Sed porttitor lectus nibh.</p>
                        <!-- <a href="#" class="read-more">
                            Read More
                            <i class="ri-arrow-right-line"></i>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Our Department Area -->

<!-- Start Choose Us Area -->
<div class="choose-us-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="choose-us-content">
                    <span class="top-title">WHY CHOOSE US</span>
                    <h2>Our hospital has professional doctors who provide low cost 24 hour service</h2>
                    <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat.</p>

                    <ul>
                        <li>
                            <span>1</span>
                            <h3>Modern Technology</h3>
                            Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                        </li>
                        <li class="active">
                            <span>2</span>
                            <h3>Professional Doctors</h3>
                            Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                        </li>
                        <li>
                            <span>3</span>
                            <h3>Affordable Price</h3>
                            Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="choose-us-img ml-86">
                    <img src="/assets/website/images/choose-us-img.jpg" alt="Image">

                    <div class="ambulance-services d-flex">
                        <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                        <div class="ambulance-info">
                            <span>24/7 Hours Service</span>
                            <a href="tel:1-23-456-789">1-23-456-789</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Choose Us Area -->

<!-- Start Our Team Area -->
<div class="our-team-area bg-color-f1f5f8 pt-100 pb-70">
    <div class="container">
        <div class="section-title team-title">
            <span class="top-title">OUR DOCTORS</span>
            <h2>We have all the professional doctors in our hospital</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-team">
                    <img src="/assets/website/images/team/team-1.jpg" alt="Image">
                    <h3>
                        <a href="#">Glenn Arredondo</a>
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

            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-team">
                    <img src="/assets/website/images/team/team-2.jpg" alt="Image">
                    <h3>
                        <a href="#">Dorthy Winters</a>
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

            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-team">
                    <img src="/assets/website/images/team/team-3.jpg" alt="Image">
                    <h3>
                        <a href="#">Christopher Perreault</a>
                    </h3>
                    <span>Medicine Specialists</span>
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

            <div class="col-lg-3 col-sm-6 text-center">
                <div class="single-team">
                    <img src="/assets/website/images/team/team-4.jpg" alt="Image">
                    <h3>
                        <a href="#">Linda Flores</a>
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
        </div>

        <div class="mt-3 text-center">
            <a href="#">
                <button class="default-btn">
                    View All Doctors
                </button>
            </a>
        </div>
    </div>
</div>
<!-- End Our Team Area -->

<!-- Start Urgent Area -->
<div class="urgent-area pt-100">
    <div class="container">
        <div class="section-title services-title">
            <span class="top-title">OUR SERVICE</span>
            <h2>See our hospital's care services</h2>
        </div>

        <div class="urgent-slide owl-carousel owl-theme">
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                </div>
                <h3>Chest Pain</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                </div>
                <h3>Minor Injury</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                </div>
                <h3>Vaccinations</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-4.svg" alt="Image">
                </div>
                <h3>Minor Burns</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                </div>
                <h3>Chest Pain</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                </div>
                <h3>Minor Injury</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                </div>
                <h3>Vaccinations</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-4.svg" alt="Image">
                </div>
                <h3>Minor Burns</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                </div>
                <h3>Chest Pain</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-2.svg" alt="Image">
                </div>
                <h3>Minor Injury</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-3.svg" alt="Image">
                </div>
                <h3>Vaccinations</h3>
            </div>
            <div class="single-urgent">
                <div class="icon">
                    <img src="/assets/website/images/icon/icon-4.svg" alt="Image">
                </div>
                <h3>Minor Burns</h3>
            </div>
        </div>
    </div>
</div>
<!-- End Urgent Area -->

<!-- Start Solution Area -->
<div class="solution-area bg-color-f8f9fa pt-100 pb-70">
    <div class="container">
        <div class="section-title solution-title">
            <span class="top-title">SOLUTION</span>
            <h2>Some easy steps to get your proper solution</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <div class="icon">
                        <span>1</span>
                        <i class="flaticon-search"></i>
                    </div>
                    <h3>Search doctor</h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <div class="icon">
                        <span>2</span>
                        <i class="flaticon-search-1"></i>
                    </div>
                    <h3>Check doctor profile</h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <div class="icon">
                        <span>3</span>
                        <i class="flaticon-calendar"></i>
                    </div>
                    <h3>Doctor appointment</h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <div class="icon">
                        <span>4</span>
                        <i class="flaticon-think"></i>
                    </div>
                    <h3>Get first solution</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Solution Area -->

<!-- Start Client Area -->
<div class="client-area">
    <div class="ml100">
        <div class="client-bg pt-100 pb-70">
            <div class="container">
                <div class="section-title left-title">
                    <span class="top-title">OUR CLIENTS</span>
                    <h2>Our happy clients say about us</h2>
                </div>

                <div class="single-client client-slide owl-carousel owl-theme">
                    <div class="client-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="client-info d-flex align-items-center">
                                <img src="/assets/website/images/client/client-1.jpg" alt="Image">
                                <div class="ms-3">
                                    <h3>Ralph Gonzales</h3>
                                    <span>Patient</span>
                                </div>
                            </div>
                            <img src="/assets/website/images/client/quat.svg" class="quat" alt="Image">
                        </div>

                        <p>“Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur aliquet quam id dui posuere blandit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum diam amet quam vehicula elementum sed sit amet dui.”</p>
                    </div>

                    <div class="client-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="client-info d-flex align-items-center">
                                <img src="/assets/website/images/client/client-1.jpg" alt="Image">
                                <div class="ms-3">
                                    <h3>Ralph Gonzales</h3>
                                    <span>Patient</span>
                                </div>
                            </div>
                            <img src="/assets/website/images/client/quat.svg" class="quat" alt="Image">
                        </div>

                        <p>“Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur aliquet quam id dui posuere blandit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum diam amet quam vehicula elementum sed sit amet dui.”</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Client Area -->

<!-- Start Blog Area -->
<div class="blog-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="top-title">BLOG POST</span>
            <h2>See our latest blog post</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <a href="blog-details.html">
                        <img src="/assets/website/images/blog/blog-1.jpg" alt="Image">
                    </a>

                    <div class="blog-content">
                        <a href="blog-details.html" class="tag">Special</a>

                        <ul>
                            <li>
                                <a href="blog-details.html">
                                    <i class="ri-user-3-line"></i>
                                    Jonathan
                                </a>
                            </li>
                            <li>
                                <i class="ri-calendar-line"></i>
                                15 May, 2022
                            </li>
                            <li>
                                <a href="blog-details.html">
                                    <i class="ri-chat-3-line"></i>
                                    No comment
                                </a>
                            </li>
                        </ul>

                        <h3>
                            <a href="blog-details.html">How to live a healthy life without pain or disease</a>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <a href="blog-details.html">
                        <img src="/assets/website/images/blog/blog-2.jpg" alt="Image">
                    </a>

                    <div class="blog-content">
                        <a href="blog-details.html" class="tag">Health</a>

                        <ul>
                            <li>
                                <a href="blog-details.html">
                                    <i class="ri-user-3-line"></i>
                                    Stevens
                                </a>
                            </li>
                            <li>
                                <i class="ri-calendar-line"></i>
                                16 May, 2022
                            </li>
                            <li>
                                <a href="blog-details.html">
                                    <i class="ri-chat-3-line"></i>
                                    No comment
                                </a>
                            </li>
                        </ul>

                        <h3>
                            <a href="blog-details.html">Why would I give up all bad habits to stay good</a>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <a href="blog-details.html">
                        <img src="/assets/website/images/blog/blog-3.jpg" alt="Image">
                    </a>

                    <div class="blog-content">
                        <a href="blog-details.html" class="tag">First Aid</a>

                        <ul>
                            <li>
                                <a href="blog-details.html">
                                    <i class="ri-user-3-line"></i>
                                    Leonard
                                </a>
                            </li>
                            <li>
                                <i class="ri-calendar-line"></i>
                                17 May, 2022
                            </li>
                            <li>
                                <a href="blog-details.html">
                                    <i class="ri-chat-3-line"></i>
                                    No comment
                                </a>
                            </li>
                        </ul>

                        <h3>
                            <a href="blog-details.html">Everyone's home must have a first aid kit</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Area -->

<!-- As Seen On Area -->
<div class="as-seen-on-area bg-color-f8f9fa pt-100 pb-70">
    <div class="container">
        <div class="section-title solution-title">
            <span class="top-title">AS SEEN ON</span>
            <h2>Some media as seen on</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <img src="/assets/website/images/blog/blog-1.jpg" alt="Image">
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <img src="/assets/website/images/blog/blog-1.jpg" alt="Image">
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <img src="/assets/website/images/blog/blog-1.jpg" alt="Image">
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-solution">
                    <img src="/assets/website/images/blog/blog-1.jpg" alt="Image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Solution Area -->

<!-- Popular Search Area -->
<div class="popular-search-area bg-color-light-blue pt-70 pb-70">
    <div class="container">
        <div class="section-title solution-title mb-3">
            <span class="top-title text-blue">Popular Search</span>
            <h2 class="text-blue">Some popular who user search</h2>
        </div>
        <div class="text-center">
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem ipsum dolor sit amet</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, quis?</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
            <span class="btn btn-outline-blue px-1 py-0 my-1">
                <small style="font-size: 0.6rem;vertical-align:middle">Lorem, ipsum</small>
            </span>
        </div>
    </div>
</div>
<!-- End Solution Area -->


<?= $this->endSection(); ?>