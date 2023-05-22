

       

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                    <!-- DataTales Example -->
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <a href="<?= base_url('admin/tambahuser'); ?>" class="btn btn-primary mb-3"><i class="fa fa-user-plus"></i>Tambah Data User</a>
                            <div class= "table-responsive">
                                <table class=" table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="text-center text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Role_id</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($DataUser as $sm) : ?>
                                     <tr class="text-dark text-center">
                                        <th scope="row"><?= $i; ?></th>
                                            <td><?= $sm['name']; ?></td>
                                            <td><?= $sm['email']; ?></td>
                                            <td><?= $sm['password']; ?></td>
                                            <td><?= $sm['role_id'] == 1 ? "Admin" : "Guru"; ?></td>
                                            <td class="text-center" width="160px">
                                            <a href="<?= base_url('Admin/editdatauser/'); ?><?= $sm['id']; ?>" class="badge badge-success"><i class="fa fa-pen"></i>Edit</a>
                                            <a href="<?= base_url('Admin/hapususer/'); ?><?= $sm['id']; ?>" class="badge badge-danger" data-toggle="modal" data-target="#deleteUserModal"><i class="fa fa-trash"></i>Hapus</a>
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
               

<!-- deleteuser Modal-->
    <div class="modal fade" id="deleteUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin ingin menghapus data ini?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('Admin/hapususer/'); ?><?= $sm['id']; ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>



