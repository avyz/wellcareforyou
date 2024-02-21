  <!--  BEGIN SIDEBAR  -->
  <div class="sidebar-wrapper sidebar-theme <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>user-sidebar-wrapper<?php endif; ?>">
      <nav id="sidebar">
          <div class="navbar-nav theme-brand flex-row text-center">
              <div class="nav-logo">
                  <div class="nav-item theme-logo">
                      <a href="/wc-admin/dashboard">
                          <img src="/assets/website/images/logo_white.png" class="navbar-logo" alt="logo">
                      </a>
                  </div>
              </div>
              <div class="nav-item sidebar-toggle">
                  <div class="btn-toggle sidebarCollapse">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">
                          <polyline points="11 17 6 12 11 7"></polyline>
                          <polyline points="18 17 13 12 18 7"></polyline>
                      </svg>
                  </div>
              </div>
          </div>
          <div class="shadow-bottom"></div>
          <ul class="list-unstyled menu-categories" id="accordionExample">
              <?php foreach ($sidebar as $s) : ?>
                  <li class="menu <?php if (empty($s['sidebar'])) : ?> menu-link-sidebar single-menu <?php endif; ?>">
                      <a href="<?php if (!empty($s['sidebar'])) : ?>#<?= $s['menu_slug'] ?><?php else : ?><?= $s['menu_url'] ?><?php endif; ?>" <?php if (!empty($s['sidebar'])) : ?> data-bs-toggle="collapse" aria-expanded="false" <?php endif; ?> class="dropdown-toggle">
                          <div class="menu-sidebar">
                              <?= $s['menu_icon'] ?>
                              <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                              </svg> -->
                              <span><?= $s['menu_name'] ?></span>
                          </div>
                          <?php if (!empty($s['sidebar'])) : ?>
                              <div>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                                      <polyline points="9 18 15 12 9 6"></polyline>
                                  </svg>
                              </div>
                          <?php endif; ?>
                      </a>
                      <?php if (!empty($s['sidebar'])) : ?>
                          <ul class="collapse submenu list-unstyled" id="<?= $s['menu_slug'] ?>" data-bs-parent="#<?= $s['menu_slug'] ?>">
                              <?php foreach ($s['sidebar'] as $sb) : ?>
                                  <li class="menu-link-sidebar">
                                      <a href="<?= $sb['menu_children_url'] ?>"> <?= $sb['menu_children_name'] ?> </a>
                                  </li>
                              <?php endforeach; ?>
                          </ul>
                      <?php endif; ?>
                  </li>
              <?php endforeach; ?>
              <!-- <li class="menu">
                  <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                      <div class="">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                              <polyline points="9 22 9 12 15 12 15 22"></polyline>
                          </svg>
                          <span>Dashboard</span>
                      </div>
                      <div>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                              <polyline points="9 18 15 12 9 6"></polyline>
                          </svg>
                      </div>
                  </a>
                  <ul class="collapse submenu list-unstyled" id="dashboard" data-bs-parent="#accordionExample">
                      <li class="menu-link-sidebar">
                          <a href="./index.html"> Analytics </a>
                      </li>
                      <li class="menu-link-sidebar">
                          <a href="/dashboard"> Sales </a>
                      </li>
                  </ul>
              </li> -->
              <!-- <li class="menu menu-link-sidebar single-menu">
                  <a href="/menu-management" class="dropdown-toggle">
                      <div>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                              <polyline points="9 22 9 12 15 12 15 22"></polyline>
                          </svg>
                          <span>Menus</span>
                      </div>
                  </a>
              </li> -->
          </ul>
      </nav>
  </div>
  <!-- END SIDEBAR -->