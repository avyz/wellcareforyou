 <!--  BEGIN NAVBAR  -->
 <div class="header-container">
     <header class="header navbar navbar-expand-sm expand-header container-xxl px-xxl-5">
         <ul class="navbar-item theme-brand flex-row  text-center">
             <li class="nav-item theme-logo">
                 <a href="/dashboard">
                     <img src="/assets/website/images/logo_white.png" class="navbar-logo" alt="logo">
                 </a>
             </li>
         </ul>

         <ul class="navbar-item flex-row ms-lg-auto ms-0 action-area">
             <li class="nav-item dropdown language-dropdown">
                 <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="/assets/website/images/lang/<?= $language_row['lang_icon'] ?>" class="flag-width rounded-circle" alt="flag">
                 </a>
                 <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                     <?php foreach ($dataMenu['language'] as $d) : ?>
                         <a class="dropdown-item d-flex" href="/dashboard?lang=<?= $d['lang_code'] ?>"><img src="/assets/website/images/lang/<?= $d['lang_icon'] ?>" class="flag-width rounded-circle" alt="flag"> <span class="align-self-center"> <?= strtoupper($d['lang_code']) ?></span></a>
                     <?php endforeach; ?>
                     <!-- <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="/assets/website/images/lang/flag-icon-indonesia.png" class="flag-width rounded-circle" alt="flag"> <span class="align-self-center"> ID</span></a> -->
                 </div>
             </li>
             <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                 <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <div class="avatar-container">
                         <div class="avatar avatar-sm avatar-indicators avatar-online">
                             <img alt="avatar" src="/assets/cms/img/<?= session()->get('photo') ? session()->get('photo') : 'profile_white.png' ?>" class="rounded-circle">
                         </div>
                     </div>
                 </a>

                 <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                     <div class="user-profile-section">
                         <div class="media mx-auto">
                             <div class="emoji me-2">
                                 &#x1F44B;
                             </div>
                             <div class="media-body">
                                 <h5><?= session()->get('nama_lengkap') ?></h5>
                             </div>
                         </div>
                     </div>
                     <div class="dropdown-item">
                         <a href="user-profile.html">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                             </svg> <span>Profile</span>
                         </a>
                     </div>
                     <div class="dropdown-item">
                         <a href="/lockscreen">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                 <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                 <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                             </svg> <span>Lock Screen</span>
                         </a>
                     </div>
                     <div class="dropdown-item">
                         <a href="/logout">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                 <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                 <polyline points="16 17 21 12 16 7"></polyline>
                                 <line x1="21" y1="12" x2="9" y2="12"></line>
                             </svg> <span>Log Out</span>
                         </a>
                     </div>
                 </div>

             </li>
         </ul>
     </header>
 </div>
 <!--  END NAVBAR  -->