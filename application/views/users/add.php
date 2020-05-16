<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add User - <?= $this->session->userdata('name');?></title>

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
              <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <!--  -->
              <form id="manage" action="<?= base_url("users/addaction") ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="auth_access">Access</label>
                  <select id="auth_access" name="auth_access" class="form-control">
                    <option selected value="USER">USER</option>
                    <option value="ADMIN">ADMIN</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="auth_email">Email</label>
                  <input type="email" class="form-control" name="auth_email" id="auth_email" placeholder="Email" value="" required />
                </div>
                <hr>
                <div class="form-group">
                  <a href="<?= base_url('users') ?>" class="btn btn-primary float-right">Back</a>
                  <input type="submit" value="Save" class="btn btn-primary float-right mr-3">
                </div>
              </form>
              <!--  -->
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