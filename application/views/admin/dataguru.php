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
                <div class="card-body">
                    <a href="<?= base_url('admin/tambahguru'); ?>" class="btn btn-primary mb-3"><i class="fa fa-user-plus"></i>Tambah Data Guru</a>
                    <div class="table-responsive">
                        <table class=" table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Mapel</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($DataGuru as $sn) : ?>
                                    <tr class="text-dark text-center">
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sn['nip']; ?></td>
                                        <td><?= $sn['name']; ?></td>
                                        <?php $mapel = $this->db->get_where('tb_mapel', ['id' => $sn['mapel_id']])->row(); ?>
                                        <td><?= $mapel->nama_mapel; ?></td>
                                        <td><?= $sn['email']; ?></td>
                                        <td><img src="<?= base_url('assets/img/guru/') . $sn['image']; ?>" width="100"></td>
                                        <td class="text-center" width="160px">
                                            <a href="<?= base_url('Admin/editdataguru/'); ?><?= $sn['id']; ?>" class="badge badge-success"><i class="fa fa-pen"></i>Edit</a>
                                            <a href="<?= base_url('Admin/hapusguru/'); ?><?= $sn['id']; ?>" class="badge badge-danger" data-toggle="modal" data-target="#deleteGuruModal"><i class="fa fa-trash"></i>Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteGuruModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Guru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin ingin menghapus data ini?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a href="<?= base_url('Admin/hapusguru/'); ?><?= $sn['id']; ?>" class="btn btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>