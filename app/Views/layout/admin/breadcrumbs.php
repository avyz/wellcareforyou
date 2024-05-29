<!--  BEGIN BREADCRUMBS  -->
<div class="secondary-nav px-md-1 <?php if (session()->get('is_master') == 0 && session()->get('is_admin') == 0) : ?>is-user-nav<?php endif; ?>">
    <div class="breadcrumbs-container container-xxl px-md-4" data-page-heading="Sales">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="btn-toggle sidebarCollapse ps-0 px-md-3" data-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>
            <div class="d-flex breadcrumb-content">
                <div class="page-header">

                    <div class="page-title">
                    </div>

                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <?php if ($dataMenu) : ?>
                                <?php foreach ($breadcrumbs as $b) : ?>
                                    <li class="breadcrumb-item" <?php if ($b['url'] == '#') : ?> aria-current="page" <?php endif; ?>><?= $b['segment'] ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ol>
                    </nav>

                </div>
            </div>
            <?php if (session()->get('is_master') != 0 || session()->get('is_admin') != 0) : ?>
                <ul class="navbar-nav flex-row ms-auto breadcrumb-action-dropdown">
                    <li class="nav-item more-dropdown">
                        <div class="dropdown custom-dropdown-icon pe-0">
                            <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Settings</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down custom-dropdown-arrow">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">

                                <a href="/setting/misc" class="dropdown-item d-flex align-items-center" data-value="Settings" data-icon="<i class=&quot;ri-tools-fill&quot;></i>" href="javascript:void(0);">
                                    <i class="ri-tools-fill"></i> Settings Website
                                </a>

                                <a href="/pages/pages" class="dropdown-item d-flex align-items-center" data-value="Edit" data-icon="<i class=&quot;ri-edit-circle-line&quot;></i>" href="javascript:void(0);">
                                    <i class="ri-edit-circle-line"></i> Edit Website
                                </a>
                            </div>

                        </div>
                    </li>
                </ul>
            <?php endif; ?>
        </header>
    </div>
</div>
<!--  END BREADCRUMBS  -->