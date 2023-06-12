<!-- Page header -->
 <div class="page-header d-print-none">
     <div class="container-xl">
         <div class="row g-2 align-items-center">
             <div class="col">
                 <!-- Page pre-title -->
                 <div class="page-pretitle">
                     Buttons
                 </div>
                 <h2 class="page-title">
                     List Buttons
                 </h2>
             </div>
             <!-- Page title actions -->
             <div class="col-auto ms-auto d-print-none">
                 <div class="btn-list">
                     <a href="<?php echo site_url('buttons/create'); ?>" class="btn btn-primary d-none d-sm-inline-block">
                         <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                             <path d="M12 5l0 14" />
                             <path d="M5 12l14 0" />
                         </svg>
                         New button
                     </a>
                     <a href="#" class="btn btn-primary d-sm-none btn-icon">
                         <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                             <path d="M12 5l0 14" />
                             <path d="M5 12l14 0" />
                         </svg>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Page body -->
 <div class="page-body">
     <div class="container-xl">
         <div class="card">
             <div class="card-body">

                 <div class="card">
                     <div class="table-responsive">
                         <table class="table table-vcenter card-table">
                             <thead>
                                 <tr>
                                     <th>Buttons Description</th>
                                     <th>Status</th>
                                     <th class="w-1"></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($files as $key => $file) : ?>
                                   
                                     <tr>
                                         <td> <?php echo $file["filename"] ?></td>
                                         <td> <span class="badge bg-green">Acive</span></td>
                                         <td>
                                             <div class="btn-list flex-nowrap">
                                                 <a href="<?php echo site_url('buttons/edit/' . $file["b64_filename"]); ?>" class="btn btn-primary">Edit</a>
                                                 <a href="<?php echo site_url('buttons/deploy/' . $file["b64_filename"]); ?>" class="btn btn-dark">Deploy</a>
                                                 <a href="<?php echo site_url('buttons/delete/' . $file["b64_filename"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

                                             </div>


                                         </td>
                                     </tr>

                                 <?php endforeach ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>