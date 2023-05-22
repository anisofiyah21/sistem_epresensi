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
                         <a href="<?= base_url('admin/dataguru'); ?>" class="btn btn-warning btn-flat">
                             <i class="fas fa-undo fa-sm fa-fw mr-2"></i>Kembali</a>
                     </div>
                 </div>
                 <div class="col-lg">
                     <form action="<?= base_url('Admin/proseseditguru'); ?>" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="id" value="<?= $tb_guru['id']; ?>">
                         <input type="hidden" name="gambar_lama" value="<?= $tb_guru['image']; ?>">
                         <div class="form-group">
                             <label for="NIP" class="col-sm-5 col-form-label">NIP</label>
                             <div class="col-sm">
                                 <input type="text" class="form-control" id="NIP" name="nip" value="<?= $tb_guru['nip']; ?>">
                                 <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="name" class="col-sm-5 col-form-label">Nama Lengkap</label>
                             <div class="col-sm">
                                 <input type="text" class="form-control" id="name" name="name" value="<?= $tb_guru['name']; ?>">
                                 <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                             </div>
                         </div>
                         <!-- <div class="form-group">
                             <label for="JK" class="col-sm-5 col-form-label">Jenis Kelamin</label>
                             <div class="col-sm">
                                 <input type="text" class="form-control" id="JK" name="JK" value="<?php // echo  $tb_guru['JK']; 
                                                                                                    ?>">
                                 <?php // echo form_error('JK', '<small class="text-danger pl-3">', '</small>'); 
                                    ?>
                             </div>
                         </div> -->
                         <!-- <div class="form-group">
                             <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                             <div class="col-sm">
                                 <input type="text" class="form-control" id="address" name="address" value="<?php //echo $tb_guru['Alamat']; 
                                                                                                            ?>">
                                 <?php //echo form_error('address', '<small class="text-danger pl-3">', '</small>'); 
                                    ?>
                             </div>
                         </div> -->
                         <div class="form-group">
                             <label for="mapel" class="col-sm-3 col-form-label">Mapel</label>
                             <div class="col-sm">
                                 <select name="mapel_id" id="mapel" class="form-control" required>
                                     <option value="">Pilih</option>
                                     <?php foreach ($mapel as $mpl) : ?>
                                         <?= ($mpl->id != 1) ? '<option value="' . $mpl->id . '">' . $mpl->nama_mapel . '</option>' : '' ?>
                                     <?php endforeach; ?>
                                 </select>

                             </div>
                         </div>
                         <div class="form-group">
                             <label for="email" class="col-sm-3 col-form-label">Email</label>
                             <div class="col-sm">
                                 <input type="text" class="form-control" id="email" name="email" value="<?= $tb_guru['email']; ?>">
                                 <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                             </div>
                         </div>
                         <!-- <div class="form-group">
                             <label for="status" class="col-sm-3 col-form-label">Status</label>
                             <div class="col-sm">
                                 <select name="status" class="form-control" id="status">
                                     <?php foreach ($status as $s) : ?>
                                         <?php if ($s == $tb_guru['Status']) : ?>
                                             <option value="<?= $s; ?>" selected><?= $s == 1 ? "Aktif" : "Tidak Aktif"; ?></option>
                                         <?php else : ?>
                                             <option value="<?= $s; ?>"><?= $s == 1 ? "Aktif" : "Tidak Aktif"; ?></option>
                                         <?php endif; ?>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                         </div> -->

                         <div class="form-group">
                             <div class="col-sm-3">Foto</div>
                             <div class="col-sm">
                                 <div class="row">
                                     <div class="col-sm-3">
                                         <img src="<?= base_url('assets/img/guru/') . $tb_guru['image']; ?>" class="img-thumbnail">
                                     </div>
                                     <div class="col-sm">
                                         <div class="custom-file">
                                             <input type="file" class="custom-file-input" id="Foto" name="image">
                                             <label class="custom-file-label" for="Foto">Pilih Gambar</label>
                                         </div>
                                     </div>
                                 </div>
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