<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                <?= $this->session->flashdata('message'); ?>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="row">
                        <div class="col-md">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="card-title font-16 mt-0 mb-3">Permohonan Izin <?= $tb_kodepresensi->hari; ?></h4>
                                    <?php if ($list_izin) : ?>
                                        <div class="table-responsive">
                                            <table id="dataTable" class="table table-bordered dt-responsive nowrap">
                                                <thead>
                                                    <tr align="center">
                                                        <th class="th">#</th>
                                                        <th class="th">Nama</th>
                                                        <th class="th">NIP</th>
                                                        <th class="th">Mapel</th>
                                                        <th class="th">Izin</th>
                                                        <th class="th">Surat_ket</th>
                                                        <th class="th">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($list_izin as $izin) : ?>
                                                        <tr align="center">
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $izin->nama_guru; ?></td>
                                                            <td><?= $izin->nip_guru; ?></td>
                                                            <td><?= $izin->mapel; ?></td>
                                                            <td><?= $izin->keterangan; ?></td>
                                                            <td>
                                                                <a href="<?= base_url('file/suket/') . encrypt_url($izin->surat_ket); ?>" class="btn btn-success">Unduh</a>
                                                            </td>
                                                            <td>
                                                                <?php if ($izin->izinkan == 0) : ?>
                                                                    <a href="<?= base_url('Presensi/izinkan/?tb_user=') . encrypt_url($izin->nip_guru) . '&tb_kodepresensi=' . encrypt_url($tb_kodepresensi->kode); ?>" class="badge badge-warning btn-izinkan">Pending</a>
                                                                <?php else : ?>
                                                                    <span class="badge badge-success">Di Izinkan</span>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php else : ?>
                                        <br>
                                        <a href="javascript:void(0);" class="btn btn-danger waves-effect waves-light btn-block">Tidak Ada Data</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end wrapper -->
        </div>
    </div>
</div>
</div>

<?= $this->session->flashdata('pesan'); ?>