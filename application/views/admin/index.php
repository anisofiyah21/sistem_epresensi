 <!-- Begin Page Content -->
 <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
 <div class="text-center text-gray-800">
 <h5 class="mark">Selamat Datang <span class="mark"><?= $tb_user['name']; ?></span> di Sistem E-Presensi Guru SMK Ifadah</h5>
</div>
<br>

                  <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Data User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                 <h3 class="mt-3"><?= $total_user; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw-solid fa-folder-plus fa-2x text-gray-300"></i>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Data Mapel</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <h3 class="mt-3 align"><?= $total_mapel; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw-solid fa-folder-open fa-2x text-gray-300"></i>
                                        </div>
                                         
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Presensi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <h3 class="mt-3 align"><?= $total_presensi; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw-regular fa-qrcode fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                      
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Laporan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                 <h3 class="mt-3 align"><?= $total_laporan; ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw-solid fa-file-signature fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           