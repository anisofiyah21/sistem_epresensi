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
                     <div class="card-body">
                         <h4 class="card-title font-16 mt-0">Daftar Presensi</h4>
                         <div class="table-responsive">
                             <table class=" table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr class="text-center text-dark">
                                         <th scope="col">#</th>
                                         <th scope="col">Hari</th>
                                         <th scope="col">Tanggal</th>
                                         <th scope="col">Jam</th>
                                         <th scope="col">Presensi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $i = 1; ?>
                                     <?php foreach ($presensi_list as $presensiguru) : ?>
                                         <tr class="text-dark text-center">
                                             <th scope="row"><?= $i; ?></th>
                                             <td><?= $presensiguru['hari']; ?></td>
                                             <td><?= $presensiguru['tanggal']; ?></td>
                                             <td><?= $presensiguru['jam_masuk'] . "-" . $presensiguru['jam_pulang']; ?></td>
                                             <td align="center">
                                                 <div class="btn-group">
                                                     <a href="<?= base_url('presensi/presensimasukguru/') . encrypt_url($presensiguru['kode']); ?>" class="btn btn-primary">Masuk</a>
                                                     <a href="<?= base_url('presensi/presensipulangguru/') . encrypt_url($presensiguru['kode']); ?>" class="btn btn-success">Pulang</a>
                                                     <a href="<?= base_url('presensi/izinguru/') . encrypt_url($presensiguru['kode']); ?>" class="btn btn-warning">Izin</a>
                                                 </div>
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
 </div>
 <!-- end wrapper -->

 <?= $this->session->flashdata('pesan'); ?>