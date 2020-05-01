<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>User</title>

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
          <!-- breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $button; ?></li>
            </ol>
          </nav>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $button; ?></h1>
          </div>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <!--  -->
              <form id="manage" action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                  <label for="varchar">Name <?php echo form_error('auth_name') ?></label>
                  <input type="text" class="form-control" name="auth_name" id="auth_name" placeholder="Auth Name" value="<?php echo $auth_name; ?>" />
                </div>
                <div class="form-group">
                  <label for="varchar">Username <?php echo form_error('auth_user') ?></label>
                  <input type="text" class="form-control" name="auth_user" id="auth_user" placeholder="Auth User" value="<?php echo $auth_user; ?>" />
                </div>
                <div class="form-group">
                  <label for="varchar">Auth Email <?php echo form_error('auth_email') ?></label>
                  <input type="text" class="form-control" name="auth_email" id="auth_email" placeholder="Auth Email" value="<?php echo $auth_email; ?>" />
                </div>
                <div class="form-group">
                  <label for="varchar">Auth Pws <?php echo form_error('auth_pws') ?></label>
                  <input type="text" class="form-control" name="auth_pws" id="auth_pws" placeholder="Auth Pws" value="<?php echo $auth_pws; ?>" />
                </div>
                <div class="form-group">
                  <label for="varchar">Image <?php echo form_error('auth_image') ?></label>
                  <input type="text" class="form-control" name="auth_image" id="auth_image" placeholder="Auth Image" value="<?php echo $auth_image; ?>" />
                </div>
                <input type="hidden" name="auth_id" value="<?php echo $auth_id; ?>" />
              </form>
              <!--  -->
            </div>
            <div class="card-footer">
              <a href="<?= base_url('users') ?>" class="btn btn-primary float-xl-right float-lg-right">Back</a>
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
  <!-- End Script -->
</body>

</html>