  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

              <!-- Sidebar Toggle (Topbar) -->
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
              </button>



              <!-- Topbar Navbar -->
              <ul class="navbar-nav ml-auto">

                  <div class="topbar-divider d-none d-sm-block"></div>

                  <!-- Nav Item - User Information -->
                  <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $tb_user['name']; ?></span>
                          <?php if ($tb_user['role_id'] == 1) : ?>
                              <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $tb_user['image']; ?>">
                          <?php else : ?>
                              <img class="img-profile rounded-circle" src="<?= base_url('assets/img/guru/') . $tb_user['image']; ?>">
                          <?php endif; ?>
                      </a>
                      <!-- Dropdown - User Information -->
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                          <a class="dropdown-item" href="<?= base_url('profil/profile'); ?>">
                              <i class="fas fa-fw-solid fa-address-card mr-2 text-gray-400"></i>
                              My Profile
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= base_url('profil/edit'); ?>">
                              <i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i>
                              Edit Profile
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= base_url('profil/changepassword'); ?>">
                              <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                              Ubah Password
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                              Logout
                          </a>
                      </div>
                  </li>

              </ul>

          </nav>
          <!-- End of Topbar -->