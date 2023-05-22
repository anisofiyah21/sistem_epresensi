 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

     <!-- Main Content -->
     <div id="content">

         <!-- Begin Page Content -->
         <div class="container-fluid">
             <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
             <div class="card shadow mb-4 col-lg-8 ml-1 row text-dark">
                 <div class="form-group row justify-content-end">
                     <div class="col-sm-3 mt-2">
                         <a href="<?= base_url('presensi/datapresensi'); ?>" class="btn btn-warning btn-flat">
                             <i class="fas fa-undo fa-sm fa-fw mr-2"></i>Kembali</a>
                     </div>
                 </div>

                 <div class="col-lg">
                     <form action="<?= base_url('presensi/tambahpresensi'); ?>" method="post" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                     <label for="kode">Kode</label>
                                     <input type="text" name="kode" class="form-control" value="<?= kode(); ?>" readonly>
                                 </div>
                             </div>
                             <div class="col">
                                 <div class="form-group">
                                     <label for="hari">Hari</label>
                                     <input type="text" name="hari" class="form-control" required>
                                 </div>
                             </div>
                             <div class="col">
                                 <div class="form-group">
                                     <label for="tanggal">Tanggal</label>
                                     <input type="date" name="tanggal" class="form-control" required>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                     <label for="jam_masuk">Jam Masuk</label>
                                     <input type="time" name="jam_masuk" class="form-control" required>
                                 </div>
                             </div>
                             <div class="col">
                                 <div class="form-group">
                                     <label for="jam_pulang">Jam Pulang</label>
                                     <input type="time" name="jam_pulang" class="form-control" required>
                                 </div>
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