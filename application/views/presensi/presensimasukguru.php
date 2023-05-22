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
                        <div class="card-body">
                            <h4 class="card-title font-16 mt-0">Detail</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Waktu presensi</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($absenguru->absen_masuk == '0') : ?>
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
                                        <?php else : ?>
                                            <tr>
                                                <td>jam <?= date('H:i', $absenguru->absen_masuk); ?></td>
                                                <td>
                                                    <?php if ($absenguru->is_telat == 1) : ?>
                                                        <span class="badge badge-danger">Terlambat</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-primary">Tepat Waktu</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    $this->db->where('kode', $kode_presensi);
    $this->db->where('nip_guru', $tb_user['nip']);
    $hasil = $this->db->get()->row(); ?>
    <?php if ($hasil == NULL) : ?>

        //=============================================================
        var lastResult, countResults = 0;

        function onScanSuccess(e, t) {
            e !== lastResult && (++countResults, lastResult = e, $.ajax({
                type: "POST",
                data: {
                    content: e
                },
                url: "<?= base_url('Presensi/absen_masuk/') ?>",
                async: !0,
                success: function(e) {
                    "tidak_ada" == e && Swal.fire("Oops!", "QR code tidak terdeteksi", "error"), "berhasil" == e && Swal.fire({
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