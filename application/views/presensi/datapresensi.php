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
                         <h5 class="card-title font-16 mt-0">Daftar Presensi</h5>
                         <a href="<?= base_url('presensi/tambahpresensi'); ?>" class="btn btn-primary mb-3"><i class="fa fa-user-plus"></i>Tambah Data Presensi</a>
                         <div class="table-responsive">
                             <table class=" table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr class="text-center text-dark">
                                         <th scope="col">#</th>
                                         <th scope="col">Kode</th>
                                         <th scope="col">Hari</th>
                                         <th scope="col">Tanggal</th>
                                         <th scope="col">Jam</th>
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php $i = 1; ?>
                                     <?php foreach ($presensi_list as $presensi) : ?>
                                         <tr class="text-dark text-center">
                                             <th scope="row"><?= $i; ?></th>
                                             <td><?= $presensi['kode']; ?></td>
                                             <td><?= $presensi['hari']; ?></td>
                                             <td><?= $presensi['tanggal']; ?></td>
                                             <td><?= $presensi['jam_masuk'] . "-" . $presensi['jam_pulang']; ?></td>
                                             <td align="center">
                                                 <div class="btn-group">
                                                     <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Presensi</button>
                                                     <div class="dropdown-menu">
                                                         <a class="dropdown-item" href="<?= base_url('presensi/presensimasuk/') . encrypt_url($presensi['kode']); ?>">Masuk</a>
                                                         <a class="dropdown-item" href="<?= base_url('presensi/presensipulang/') . encrypt_url($presensi['kode']); ?>">Pulang</a>
                                                     </div>
                                                 </div>
                                                 <div class="btn-group ml-3">
                                                     <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                                                     <div class="dropdown-menu">
                                                         <a class="dropdown-item" href="<?= base_url('Presensi/editdatapresensi/'); ?><?= $presensi['QR']; ?>" target="_blank">Edit</a>
                                                         <a href="<?= base_url('presensi/listpermohonan/') . encrypt_url($presensi['kode']); ?>" class=" dropdown-item"> Lihat Permohonan Izin</a>
                                                         <a href="<?= base_url('Presensi/hapusabsen/'); ?><?= $presensi['id']; ?>" class=" dropdown-item btn-hapus"> Hapus</a>
                                                     </div>
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
 