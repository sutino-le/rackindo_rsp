  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
      <!-- Brand Logo -->
      <a href="home_admin.php" class="brand-link">
          <img src="asset/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light"><b>PT. Rackindo</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="foto/<?php echo $ktp_nomor; ?>.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?php echo $nama_user; ?></a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-cogs"></i>
                          <p>
                              Master
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=nasional_holiday_view" class="nav-link">
                                  <i class="fas fa-calendar-times nav-icon" aria-hidden="true"></i>
                                  <p>National Holiday</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="home_admin.php?page=job_title" class="nav-link">
                                  <i class="fas fa-user-tie nav-icon" aria-hidden="true"></i>
                                  <p>Job Title</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="home_admin.php?page=shift_daily_view" class="nav-link">
                                  <i class="fas fa-calendar-alt nav-icon" aria-hidden="true"></i>
                                  <p>Shift Schedule</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="home_admin.php?page=group_schedule_view" class="nav-link">
                                  <i class="fas fa-calendar-week nav-icon" aria-hidden="true"></i>
                                  <p>Group Schedule</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="home_admin.php?page=ump_view" class="nav-link">
                                  <i class="fas fa-money-bill-alt nav-icon" aria-hidden="true"></i>
                                  <p>UMP</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-file-signature"></i>
                          <p>
                              Prosess Agreement
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=pkwt_list" class="nav-link">
                                  <i class="fas fa-file-signature  nav-icon" aria-hidden="true"></i>
                                  <p>Prosess Agreement</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="home_admin.php?page=pkwt_data" class="nav-link">
                                  <i class="fas fa-handshake  nav-icon" aria-hidden="true"></i>
                                  <p>Aprove Agreement</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-briefcase"></i>
                          <p>
                              HRIS
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=id_card_information" class="nav-link">
                                  <i class="fas fa-address-card  nav-icon" aria-hidden="true"></i>
                                  <p>ID Card Information</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-pencil-ruler"></i>
                          <p>
                              General Affairs
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=locker_view" class="nav-link">
                                  <i class="fas fa-box  nav-icon" aria-hidden="true"></i>
                                  <p>Locker View</p>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=item_view" class="nav-link">
                                  <i class="fas fa-box-open nav-icon" aria-hidden="true"></i>
                                  <p>Item View</p>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=item_up_view" class="nav-link">
                                  <i class="fa fa-shopping-cart nav-icon" aria-hidden="true"></i>
                                  <p>Purchase Proposal</p>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=item_use_view" class="nav-link">
                                  <i class="fas fa-external-link-alt  nav-icon"></i>
                                  <p>Item Usage</p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fas fa-fingerprint"></i>
                          <p>
                              Fingerprint
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=fingerprint_upload" class="nav-link">
                                  <i class="fa fa-upload nav-icon" aria-hidden="true"></i>
                                  <p>Upload Fingerprint</p>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=fingerprint_view" class="nav-link">
                                  <i class="fa fa-download  nav-icon" aria-hidden="true"></i>
                                  <p>Download Fingerprint</p>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="home_admin.php?page=generate_attendance" class="nav-link">
                                  <i class="fa fa-spinner  nav-icon" aria-hidden="true"></i>
                                  <p>Generate Attendance</p>
                              </a>
                          </li>
                      </ul>
                  </li>


                  <li class="nav-item">
                      <a href="organizational_structure_view.php" target="_blank" class="nav-link">
                          <i class="fas fa-sitemap"></i>
                          <p>Organizational Structure</p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="home_admin.php?page=vaccine_view" class="nav-link">
                          <i class="fas fa-syringe"></i>
                          <p>Data Vaccine</p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->

  </aside>