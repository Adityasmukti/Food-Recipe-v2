<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Users</title>

  <!-- Header -->
  <?php $this->load->view('header'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" type="text/css">
  <!-- End Header -->
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php $this->load->view('sidebar'); ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php $this->load->view('topbar'); ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <a href="<?= base_url('users/create') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add User</a>
          </div>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
              <!-- Alert -->

              <!-- End Alert -->
              <div class="dropdown-divider mb-4"></div>
              <!-- Tabel -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User Id</th>
                      <th>Access</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Image</th>
                      <th>Create</th>
                      <th>Verify</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($data as $users) {
                    ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $users->auth_access ?></td>
                        <td><?= $users->auth_name ?></td>
                        <td><?= $users->auth_user ?></td>
                        <td><?= $users->auth_email ?></td>
                        <td style="width: 100px;" class="text-center">
                          <a href="<?= base_url('upload/img/') . $users->auth_image ?>" data-toggle="lightbox">
                            <img src="<?= base_url('upload/img/') . $users->auth_image ?>" alt="" class="rounded-circle" style="width:100px; height:100px;">
                          </a>
                        </td>
                        <td><?= $users->auth_create ?></td>
                        <td class="text-center" style="width: 80px;">
                          <a href="#" data-toggle="modal" data-target="#verifyModal<?= $i ?>" class="btn-sm btn-info"><?= $users->auth_verify == "Y" ? "<i class='fa fa-check-square'>" : "" ?> </i></a>
                          <div class="modal fade" id="verifyModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Change Verify User?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Are you sure for change user data.</div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                  <a href="<?= base_url("users/verifychange/$users->auth_id") ?>" class="btn btn-success">Change</a>
                                </div>
                              </div>
                            </div>
                        </td>
                        <td class="text-center" style="width: 40px;">
                          <a href="#" data-toggle="modal" data-target="#deleteModal<?= $users->auth_id ?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                          <!-- Logout Modal-->
                          <div class="modal fade" id="deleteModal<?= $users->auth_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Are you sure for delete Recipe data.</div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                  <a href="<?= base_url("users/delete/$users->auth_id") ?>" class="btn btn-danger">Delete</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- End Table -->
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <?php $this->load->view('footer'); ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Script -->
  <?php $this->load->view('script'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#dataTable').dataTable({
        "pageLength": 25,
        "lengthMenu": [25, 50, 75, 100, 150, 200]
      });
      setTimeout(function() {
        $(".alert").fadeOut(1000);
      }, 2000);
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });
    });
  </script>
  <!-- End Script -->
</body>

</html>