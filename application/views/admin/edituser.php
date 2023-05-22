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
                               <form action="<?= base_url('Admin/prosesedituser'); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $tb_user['id']; ?>">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="name" name="name" value="<?= $tb_user['name']; ?>" required>
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $tb_user['email']; ?>" required>
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm">
                                        <input type="password" class="form-control" id="password" name="password" value="<?= $tb_user['password']; ?>" required>
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label for="role_id" class="col-sm-3 col-form-label">Role_id</label>
                                    <div class="col-sm">
                                        <select name="role_id" class="form-control" id="role_id">
                                            <?php foreach($role_id as $r) : ?>
                                                <?php if($r == $tb_user['role_id'] ) : ?>

                                                     <option value="<?= $r; ?>" selected><?= $r == 1 ? "Admin" : "Guru"; ?></option>
                                                <?php else : ?>
                                                     <option value="<?= $r; ?>"><?= $r == 1 ? "Admin" : "Guru"; ?></option>
                                                <?php endif; ?>
                                           <?php endforeach; ?>
                                        </select>  
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Ubah</button>
                                    <button type="Reset" class="btn btn-secondary btn-flat">Ulangi</button>
                                </div>
                            </form>
                                
                        
        </div>
    </div>
</div>
</div>
</div>
</div>