<meta name="apple-mobile-web-app-capable" content="yes">
<div class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="h3 mb-4 text-gray-800"><?= $title; ?> Hari <?= $tb_kodepresensi->hari; ?> Tanggal <?= $tb_kodepresensi->tanggal; ?> </h4>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php if ($absenguru) : ?>
                        <?php if ($absenguru->absen_masuk != 0 && $absenguru->absen_pulang != 0) : ?>
                            <div class="card-body">
                                <h4 class="card-title font-16 mt-0">Detail</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Waktu Absen</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>jam <?= date('H:i', $absenguru->absen_pulang); ?></td>
                                                <td>
                                                    <?php if ($absenguru->keterangan == "Selesai Sebelum Waktu") : ?>
                                                        <span class="badge badge-danger">Selesai Sebelum Waktu</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-primary">Tepat Waktu</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($absenguru->absen_masuk != 0 && $absenguru->absen_pulang == 0) : ?>
                            <div class="card-body card-body-scan">
                                <h4 class="card-title font-16 mt-0">Scan Here!</h4>
                                <div id="qr-reader" style="width: 100%;"></div>
                            </div>
                        <?php endif; ?>
                        <?php if ($absenguru->absen_masuk == 0 && $absenguru->absen_pulang == 0) : ?>
                            <div class="card-body">
                                <h4 class="card-title font-16 mt-0">Detail</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Waktu Absen</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($absenguru->izinkan == '0') : ?>
                                                <tr align="center">
                                                    <td>-</td>
                                                    <td>
                                                        <span class="badge badge-warning">PENDING</span>
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <tr align="center">
                                                    <td>-</td>
                                                    <td>
                                                        <span class="badge badge-primary">IZIN</span>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="card-body card-body-scan">
                            <h4 class="card-title font-16 mt-0">Scan Here!</h4>
                            <div id="qr-reader" style="width: 100%;"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
</div>
<!-- end wrapper -->

<script>
    <?php
    $data1 = decrypt_url($this->uri->segment(3));
    $data2 = $this->session->userdata('NIP');
    $this->db->select("*");
    $this->db->from('tb_absen');
    $this->db->where('kode', $kode_absensi);
    $this->db->where('nip_guru', $tb_user['nip']);
    $hasil = $this->db->get()->row(); ?>
    <?php if ($hasil->absen_masuk != 0 && $hasil->absen_pulang == 0) : ?>

        //=============================================================
        var lastResult, countResults = 0;

        function onScanSuccess(e, a) {
            e !== lastResult && (++countResults, lastResult = e, $.ajax({
                type: "POST",
                data: {
                    content: e
                },
                url: "<?= base_url('Presensi/absen_pulang/') ?>",
                async: !0,
                success: function(e) {
                    "sudah_absen" == e && Swal.fire("Oops!", "Anda tidak bisa melakukan presensi pulang, dikarenakan belum melakukan presensi masuk,", "error"), "tidak_ada" == e && Swal.fire("Oops!", "QR code tidak terdeteksi", "error"), "berhasil" == e && Swal.fire({
                        title: "Berhasil",
                        text: "Anda sudah mengisi presensi",
                        icon: "success",
                        showCancelButton: !1,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "OK"
                    }).then(e => {
                        e.isConfirmed && location.reload()
                    })
                }
            }))
        }
        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 10,
            qrbox: 250
        });
        html5QrcodeScanner.render(onScanSuccess);

    <?php endif; ?>
</script>