   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

           <!-- Begin Page Content -->
           <div class="container-fluid">
               <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
               <div class="row">
                   <div class="col-lg-6">
                       <?= $this->session->flashdata('message'); ?>
                   </div>
               </div>

               <div class="card mb-3 col-lg-6 text-dark">
                   <div class="row g-0">
                       <div class="col-md-4">
                           <?php if ($tb_user['role_id'] == 1) : ?>
                               <img src="<?= base_url('assets/img/profile/') . $tb_user['image']; ?>" class="card-img">
                           <?php else : ?>
                               <img src="<?= base_url('assets/img/guru/') . $tb_user['image']; ?>" class="card-img">
                           <?php endif; ?>
                       </div>
                       <div class="col-md-8">
                           <div class="card-body">
                               <h5 class="card-title"><?= $tb_user['name']; ?></h5>
                               <p class="card-text"><?= $tb_user['email']; ?></p>
                               <p class="card-text"><?= $tb_user['role_id'] == 1 ? "Admin" : "Guru"; ?></p>
                               <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $tb_user['date_created']); ?></small></p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   </div>