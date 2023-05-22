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
                                        <a href="<?= base_url('admin/datamapel'); ?>" class="btn btn-warning btn-flat">
                                        <i class="fas fa-undo fa-sm fa-fw mr-2"></i>Kembali</a>
                                    </div>
                                </div>
                            <div class="col-lg">
                               <form action="<?= base_url('admin/tambahmapel'); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="code" class="col-sm-3 col-form-label">Kode</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="code" name="code">
                                        <?= form_error('code', '<small class="text-danger pl-3">', '</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 col-form-label">Nama Mapel</label>
                                    <div class="col-sm">
                                        <input type="text" class="form-control" id="name" name="name">
                                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>');?>
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

               





