<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin::Aside Brand -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="main-page.php">
                <img alt="Logo" style="width:100px;height:35px;" src="assets/media/logos/logo_color1.svg" />
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
        </div>
    </div>

    <!-- end:: Aside Brand -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="main-page.php" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-graphic"></i><span class="kt-menu__link-text">Κεντρική Σελίδα</span></a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">ΛΕΙΤΟΥΡΓΙΕΣ</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

            

                <li class="kt-menu__item  kt-menu__item--submenu <?php active('animals-management.php', 'no') ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="animals-management.php" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-interface-3"></i><span class="kt-menu__link-text">Διαχείριση Ζώων</span><span class="kt-menu__link-badge"><span id="insert_animals_notification" class="kt-badge-sm kt-badge--warning <?php check_non_updated_infants() ?>"></span></span></a>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu <?php active('milk-production.php', 'yes'); active('meat-production.php', 'yes'); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-clipboard"></i><span class="kt-menu__link-text">Παραγωγή</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Παραγωγή</span></span></li>
                            <li class="kt-menu__item <?php active('milk-production.php', 'no') ?>" aria-haspopup="true"><a href="milk-production.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Γαλακτοπαραγωγή</span></a></li>
                            <li class="kt-menu__item <?php active('meat-production.php', 'no') ?>" aria-haspopup="true"><a href="meat-production.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Κρεατοπαραγωγή</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu <?php active('medical.php', 'no');?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="medical.php" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon la la-stethoscope"></i><span class="kt-menu__link-text">Ιατρικές Παρατηρήσεις</span></a>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu <?php active('reproduction.php', 'yes'); active('reproduction_statics.php', 'yes'); ?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon la la-intersex"></i><span class="kt-menu__link-text">Αναπαραγωγή</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item <?php active('reproduction.php', 'no');?>" aria-haspopup="true"><a href="reproduction.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Αναπαραγωγική Διαχείριση</span></a></li>
                            <li class="kt-menu__item <?php active('reproduction_statics.php', 'no');?>" aria-haspopup="true"><a href="reproduction_statics.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Στατιστικά Αναπαραγωγής </span></a></li>
                        </ul>
                    </div>
                </li>


                <li class="kt-menu__item  kt-menu__item--submenu <?php active('economics.php', 'no');?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="economics.php" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon la la-dollar"></i><span class="kt-menu__link-text">Οικονομικά</span></a>
                </li>

                
                
                
            </ul>
        </div>
    </div>

</div>