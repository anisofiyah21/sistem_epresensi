<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Hari <?= $tb_kodepresensi->hari; ?> Tanggal <?= $tb_kodepresensi->tanggal; ?> </h1>
                <?= $this->session->flashdata('message'); ?>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="row">
                        <?php if ($berakhir == "masih") : ?>
                            <div class="col-lg-8 offset-lg-2 text-center text-gray-800 mt-3">
                                <h1>SCAN HERE!</h1>
                                <div class="mt-4">
                                    <img src=" <?= base_url('assets/app-assets/qr/img/') . $tb_kodepresensi->QR; ?>">
                                </div>
                                <a href="<?= base_url('pdf/exportqr/') . encrypt_url($tb_kodepresensi->kode); ?>" target="_blank" class="btn btn-primary mt-2 ml-auto">Export QR</a>
                            </div>
                        <?php else : ?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="alert alert-success mb-0" role="alert">
                                                <h4 class="alert-heading mt-0 font-18">Well done!</h4>
                                                <p>Presensi Telah Berakhir</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-2 text-gray-800">Sudah Presensi</h4>
                                    <div class="friends-suggestions">
                                        <div class="row" id="sudah-absen">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-2 text-gray-800">Belum Presensi</h4>
                                    <div class="friends-suggestions">
                                        <div class="row" id="belum-absen">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end wrapper -->

            <?= $this->session->flashdata('pesan'); ?>

            <script>
                setInterval(() => {
                    $.ajax({
                        type: "POST",
                        data: {
                            content: "<?= $tb_kodepresensi->kode; ?>"
                        },
                        url: "<?= base_url('Presensi/sudah_absen') ?>",
                        async: !0,
                        success: function(e) {
                            $("#sudah-absen").html(e)
                        }
                    })
                }, 1e3), setInterval(() => {
                    $.ajax({
                        type: "POST",
                        data: {
                            content: "<?= $tb_kodepresensi->kode; ?>"
                        },
                        url: "<?= base_url('Presensi/belum_absen_masuk') ?>",
                        async: !0,
                        success: function(e) {
                            $("#belum-absen").html(e)
                        }
                    })
                }, 1e3);
            </script>