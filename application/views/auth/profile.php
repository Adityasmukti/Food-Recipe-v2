<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Profile - <?= $this->session->userdata('name'); ?></title>

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
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <!--  -->
              <?php if (!empty($this->session->flashdata('redalert'))) { ?>
                <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('redalert') ?></div>
              <?php } ?>
              <?php if (!empty($this->session->flashdata('greenalert'))) { ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('greenalert') ?></div>
              <?php } ?>
              <div class="form-group">
                <label for="auth_email">Email</label>
                <input type="email" id="auth_email" name="auth_email" class="form-control" value="<?= $data->auth_email; ?>" placeholder="Email" readonly>
              </div>
              <form id="manage" action="<?= base_url('profile/actionprofile'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" id="auth_id" name="auth_id" class="form-control" value="<?= $data->auth_id ?>">
                <div class="form-group">
                  <label for="auth_fullname">Name</label>
                  <input type="text" id="auth_fullname" name="auth_fullname" class="form-control" value="<?= $data->auth_fullname ?>" placeholder="Name" required>
                </div>
                <div class="form-group">
                  <label for="auth_pws">Password</label>
                  <input type="password" id="auth_pws" name="auth_pws" class="form-control" value="" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="auth_pws2">Retype Password</label>
                  <input type="password" id="auth_pws2" name="auth_pws2" class="form-control" value="" placeholder="Retype Password">
                </div>
                <div class="form-group">
                  <label for="auth_image">User image</label><br>
                  <img src="<?= empty($data->auth_image) ? base_url("upload/img/default.png") : base_url("upload/img/$data->auth_image") ?>" alt="" width="200px">
                  <p></p>
                  <input type="file" class="form-control-file" id="auth_image" name="auth_image">
                  <input type="hidden" id="auth_image_old" name="auth_image_old" class="form-control" value="<?= $data->auth_image ?>">
                </div>
                <hr>
                <div class="form-group">
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
  <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-info").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-danger").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-primary").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <!-- End Script -->
</body>

</html>