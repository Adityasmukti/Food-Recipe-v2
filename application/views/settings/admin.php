<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Application Settings</title>

  <!-- Header -->
  <?php $this->load->view('header'); ?>
  <link href="<?= base_url("assets/css/wysiwyg/editor.css") ?>" type="text/css" rel="stylesheet" />
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
              <li class="breadcrumb-item active" aria-current="page">Admin Application</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Admin Application</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <?php if (!empty($this->session->flashdata('greenalert'))) { ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('greenalert') ?></div>
              <?php } ?>
              <!--  -->
              <form id="manage" action="<?= base_url("settings/actionadmin") ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="appname">Application Name</label>
                  <input type="text" class="form-control" name="appname" id="appname" placeholder="Application Name" value="<?= $appname ?>" required />
                </div>

                <div class="form-group">
                  <label for="name">Copyright</label>
                  <input type="text" class="form-control" name="copyright" id="copyright" placeholder="Copyright" value="<?= $copyright ?>" required />
                </div>

                <div class="form-group">
                  <label for="version">Version</label>
                  <input type="text" class="form-control" name="version" id="version" placeholder="Application Version" value="<?= $version ?>" required />
                </div>

                <div class="form-group">
                  <label for="txtEditorContent">About</label>
                  <textarea name="txtEditorContent" id="txtEditorContent"></textarea>
                  <textarea id="about" name="about" hidden><?= htmlspecialchars_decode($about) ?></textarea>
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
  <script src="<?= base_url("assets/js/wysiwyg/editor.js") ?>"></script>
  <script>
    $(document).ready(function() {
      $("#txtEditorContent").Editor();
      $("#txtEditorContent").Editor("setText", $('#about').val());
      $("input:submit").click(function() {
        $('#about').text($('#txtEditorContent').Editor("getText"));
      });
    });
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-success").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <!-- End Script -->
</body>

</html>