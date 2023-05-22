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
                         <h5 class="card-title font-16 mt-0">Laporan Presensi</h5>
                         <div class="row">
                             <div class="col-lg-6">
                                 <div class="form-group">
                                     <label for="bulan">Pilih Bulan/Tahun</label>
                                     <input type="month" class="form-control bulan">
                                 </div>
                                 <button type="button" class="btn btn-primary cari">Cari</button>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>
 <script>
     $('.cari').click(function() {
         var bulan = $('.bulan').val();
         if (bulan == '') {
             alert('pilih Bulan/Tahun terlebihdahulu');
         } else {
             var href = "<?= base_url('admin/cetak_laporan/') ?>" + bulan;
             document.location.href = href;
         }
     })
 </script>