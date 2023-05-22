  <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                     <div class="col-lg-8">
                     <?= $this->session->flashdata('message'); ?>
                     </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 col-lg-8">
                        <div class="card-body">
                            <a href="<?= base_url('admin/tambahmapel'); ?>" class="btn btn-primary mb-3"><i class="fa fa-user-plus"></i>Tambah Data Mapel</a>
                            <div class= "table-responsive">
                                <table class=" table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="text-center text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Mapel</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($DataMapel as $so) : ?>
                        <tr class="text-dark text-center">
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $so['kode']; ?></td>
                            <td><?= $so['nama_mapel']; ?></td>
                            <td class="text-center" width="160px">
                                <a href="<?= base_url('Admin/editdatamapel/'); ?><?= $so['id']; ?>" class="badge badge-success"><i class="fa fa-pen"></i>Edit</a>
                                <a href="<?= base_url('Admin/hapusmapel/'); ?><?= $so['id']; ?>" class="badge badge-danger" data-toggle="modal" data-target="#deleteMapelModal"><i class="fa fa-trash"></i>Hapus</a>
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
    </div>



        <div class="modal fade" id="deleteMapelModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Mapel</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('Admin/hapusmapel/'); ?><?= $so['id']; ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
               




