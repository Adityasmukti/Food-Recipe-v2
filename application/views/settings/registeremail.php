<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register Email Settings - <?= $this->session->userdata('name');?></title>

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
              <li class="breadcrumb-item active" aria-current="page">Register EMail</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Register Email</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <?php if (!empty($this->session->flashdata('greenalert'))) { ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('greenalert') ?></div>
              <?php } ?>
              <!--  -->
              <form id="manage" action="<?= base_url("settings/actionregisteremail") ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="protocol">Protocol</label>
                  <input type="text" class="form-control" name="protocol" id="protocol" placeholder="Protocol" value="<?= $protocol ?>" required />
                </div>

                <div class="form-group">
                  <label for="smtp_host">SMTP Host</label>
                  <input type="text" class="form-control" name="smtp_host" id="smtp_host" placeholder="SMTP Host" value="<?= $smtp_host ?>" required />
                </div>

                <div class="form-group">
                  <label for="smtp_port">SMTP Port</label>
                  <input type="text" class="form-control" name="smtp_port" id="smtp_port" placeholder="SMTP Port" value="<?= $smtp_port ?>" required />
                </div>

                <div class="form-group">
                  <label for="smtp_user">SMTP User</label>
                  <input type="email" class="form-control" name="smtp_user" id="smtp_user" placeholder="SMTP User" value="<?= $smtp_user ?>" required />
                </div>

                <div class="form-group">
                  <label for="smtp_pass">SMTP Password</label>
                  <input type="text" class="form-control" name="smtp_pass" id="smtp_pass" placeholder="SMTP Password" value="<?= $smtp_pass ?>" required />
                </div>

                <div class="form-group">
                  <label for="senderemail">Sender Email</label>
                  <input type="email" class="form-control" name="senderemail" id="senderemail" placeholder="Sender Email" value="<?= $senderemail ?>" required />
                </div>

                <div class="form-group">
                  <label for="sendername">Sender Name</label>
                  <input type="text" class="form-control" name="sendername" id="sendername" placeholder="Sender Name" value="<?= $sendername ?>" required />
                </div>

                <div class="form-group">
                  <label for="subject">Subject Email</label>
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject Email" value="<?= $subject ?>" required />
                </div>

                <div class="form-group">
                  <label for="txtEditorContent">Message</label>
                  <p>Note : </p>
                  you can use {NAME} for target name, {EMAIL} for target email, and {PASSWORD} for password login
                  <textarea name="txtEditorContent" id="txtEditorContent"></textarea>
                  <textarea id="message" name="message" hidden><?= htmlspecialchars_decode($message) ?></textarea>
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
      $("#txtEditorContent").Editor("setText", $('#message').val());
      $("input:submit").click(function() {
        $('#message').text($('#txtEditorContent').Editor("getText"));
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