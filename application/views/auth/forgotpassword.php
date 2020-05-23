<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login - <?= $this->session->userdata('name'); ?></title>

  <?php $this->load->view('header'); ?>
</head>

<body id="page-top" class="bg-gradient-primary">
  <!-- Page Wrapper -->
  <div class="container login">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-12">
        <div class="card o-hidden border-0 shadow-lg my-5 center">
          <div class="card-body p-0">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><img src="<?= base_url("upload/img/"  . (empty($this->session->userdata('logo')) ? "logo.png" : $this->session->userdata('logo'))) ?>" alt="" width="40px" class="image rounded-circle"> <?= $this->session->userdata('name'); ?></h1>
                <?php if (!empty($this->session->flashdata('redalert'))) { ?>
                  <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('redalert') ?></div>
                <?php } ?>
              <?php if (!empty($this->session->flashdata('greenalert'))) { ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('greenalert') ?></div>
              <?php } ?>
              </div>
              <form class="user" method="post" action="<?= base_url('forgotpassword/reset') ?>">
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="auth_email" aria-describedby="emailHelp" placeholder="Enter Email Address" name="auth_email" required>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block text-gray-900" name="submit" value="Reset" placeholder="Reset" style="font-size: 18px">
              </form>
              <p></p><a href="<?= base_url("login") ?>" class="float-right mr-3">Login</a>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <!-- End of Page Wrapper -->
  <!-- Script -->
  <?php $this->load->view('script'); ?>
  <script>
    window.setTimeout(function() {
      $(".alert-danger").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <!-- End Script -->
</body>

</html>