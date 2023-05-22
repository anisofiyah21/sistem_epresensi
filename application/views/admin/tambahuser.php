 <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                     <div class="card shadow mb-4 col-lg-6 ml-1 row text-dark">
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-3 mt-2">
                                        <a href="<?= base_url('admin/datauser'); ?>" class="btn btn-warning btn-flat">
                                        <i class="fas fa-undo fa-sm fa-fw mr-2"></i>Kembali</a>
                                    </div>
                                </div>
                            <div class="col-lg">
                               <form action="<?= base_url('admin/tambahuser'); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="name" name="name">
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="email" name="email">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password1" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control" id="password1" name="password1">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password2" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control" id="password2" name="password2">
                                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role_id" class="col-sm-3 col-form-label">Role_id</label>
                                    <div class="col-sm">
                                        <select name="role_id" class="form-control" id="role_id">
                                            <option value="">- Pilih -</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Guru</option>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">
                                        <i class="fa fa-paper-plane"></i>Simpan</button>
                                    <button type="Reset" class="btn btn-secondary btn-flat">Ulangi</button>
                                </div>
                            </form>
                                
                        
        </div>
    </div>
</div>
</div>
</div>
</div>

               





