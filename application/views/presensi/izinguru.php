<div class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title"><?= $title; ?></h4>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class=" card m-b-30">
                    <div class="card-body">
                        <h4 class="card-title font-16 mt-0 mb-3"><?= $title; ?> Hari <?= $tb_kodepresensi->hari; ?> Tanggal <?= $tb_kodepresensi->tanggal; ?> </h4>
                        <?php if ($list_izin) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="th">Keterangan</th>
                                            <th class="th">File</th>
                                            <th class="th">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td align="center"><?= $list_izin->keterangan; ?></td>
                                            <td align="center">
                                                <a href="<?= base_url('file/suket/') . encrypt_url($list_izin->surat_ket); ?>" class="btn btn-success">Unduh</a>
                                            </td>
                                            <td align="center">
                                                <?php if ($list_izin->izinkan == 0) : ?>
                                                    <a href="javascript:void(0);" class="badge badge-warning">Pending</a>
                                                <?php else : ?>
                                                    <a href="javascript:void(0);" class="badge badge-success">Di izinkan</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <?php if ($list_presensi) : ?>
                                <?php if ($list_presensi->absen_masuk == 0 && $list_presensi->absen_pulang == 0 && $list_presensi->izinkan === null) : ?>
                                    <form action="<?= base_url('presensi/kirim_izin'); ?>" method="POST" class="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" placeholder="misal: sakit demam" required>
                                            <input type="hidden" name="kode" class="form-control" value="<?= $this->uri->segment(3); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bukti</label><br>
                                            <input type="file" name="suket" required accept="image/*,.pdf,.doc,.docx">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                                    </form>
                                <?php else : ?>
                                    <p>Anda tidak dapat mengirimkan permohonan izin, Anda sudah melakukan presensi</p>
                                <?php endif; ?>
                            <?php else : ?>
                                <form action="<?= base_url('presensi/kirim_izin'); ?>" method="POST" class="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <input type="text" name="keterangan" class="form-control" placeholder="misal: sakit demam" required>
                                        <input type="hidden" name="kode" class="form-control" value="<?= $this->uri->segment(3); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Bukti</label><br>
                                        <input type="file" name="suket" required accept="image/*,.pdf,.doc,.docx">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>
</div>
<!-- end wrapper -->
<?= $this->session->flashdata('pesan'); ?>