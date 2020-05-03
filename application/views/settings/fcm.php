<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FCM Settings</title>

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
              <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Settings</a></li>
              <li class="breadcrumb-item active" aria-current="page">FCM</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">FCM</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <?php if (!empty($this->session->flashdata('greenalert'))) { ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('greenalert') ?></div>
              <?php } ?>
              <!--  -->
              <form id="manage" action="<?= base_url("settings/actionfcm") ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="fcmtoken">FCM Token</label>
                  <textarea class="form-control" id="fcmtoken" name="fcmtoken" rows="4" placeholder="FCM Token" required><?= $fcmtoken ?></textarea>
                </div>
                <hr>
                <div class="form-group">
                  <a href="<?= base_url('recipe') ?>" class="btn btn-primary float-right">Back</a>
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

  <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
</body>

</html>