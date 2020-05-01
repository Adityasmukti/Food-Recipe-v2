<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header -->
  <?php $this->load->view('header'); ?>
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
            <h1 class="h3 mb-0 text-gray-800"><?= $pageheading; ?></h1>
          </div>
          <div class="card">
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
            </div>
            <div class="card-body">
              <form id="manage" method="POST" action="<?= $action ?>" enctype="multipart/form-data">

                <div class="card mb-4">
                  <div class="card-body">
                    <img src="" alt="" srcset="">
                    <div class="form-group">
                      <label for=""></label>
                      <img src="<?= base_url("upload/img/thumb/$auth_image") ?>" alt="<?= $auth_image ?>" class="rounded-circle Image" style="width: 150px; height: 150px;">
                    </div>
                    <input type="file" name="fileimage" id="fileimage">
                  </div>
                </div>

                <div class="card mb-4">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name <?php echo form_error('auth_name') ?></label>
                      <input type="text" class="form-control" name="auth_name" id="auth_name" placeholder="Auth Name" value="<?php echo $auth_name; ?>" />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username <?php echo form_error('auth_user') ?></label>
                      <input type="text" class="form-control" name="auth_user" id="auth_user" placeholder="Auth Name" value="<?php echo $auth_user; ?>" />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email <?php echo form_error('auth_email') ?></label>
                      <input type="email" class="form-control" name="auth_email" id="auth_email" placeholder="Auth Name" value="<?php echo $auth_email; ?>" />
                    </div>

                  </div>
                </div>

                <div class="card mb-4">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="password">Password <?php echo form_error('repeatpassword') ?></label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
                    </div>
                    <div class="form-group">
                      <label for="repeatpassword">Repeat Password</label>
                      <input type="password" class="form-control" name="repeatpassword" id="repeatpassword" placeholder="Repeat Password" value="" />
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="fcmtoken">FCM Token <?php echo form_error('fcmtoken') ?></label>
                      <textarea class="form-control" name="fcmtoken" id="fcmtoken" rows="3"><?php echo $fcmtoken; ?></textarea>
                    </div>
                  </div>
                </div>


              </form>
            </div>
            <div class="card-footer">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary float-xl-right float-lg-right mr-3" data-toggle="modal" data-target="#saveModal">
                Save User
              </button>
              <!-- Modal -->
              <!-- Modal -->
              <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="saveModalLabel">Save?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      You sure have entered the correct data, please click confirm?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-save" form="manage" class="btn btn-primary">Confirm</button>
                    </div>
                  </div>
                </div>
              </div>
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
  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
  <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>
  <!-- Page level custom scripts -->
  <!-- End Script -->
</body>

</html>