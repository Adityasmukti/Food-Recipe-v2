<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Header -->
  <?php $this->load->view('header'); ?>
  <!-- End Header -->
  <style>
  </style>
</head>

<body id="page-top" class="bg-gradient-primary">
  <!-- Page Wrapper -->
  <div class="container register">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-12">
        <div class="card o-hidden border-0 shadow-lg my-5 center">
          <div class="card-body p-0">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-laugh-wink"></i> Food Recipe</h1>
                <?php if ($error) { ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } ?>
                <div class="alert alert-warning alert-dismissible fade show validated" role="alert">
                  <span class="message"></span>
                </div>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/register') ?>" onsubmit="return validateForm()">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstname" id="firstname" placeholder="First Name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastname" id="lastname" placeholder="Last Name" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="repeatpassword" id="repeatpassword" placeholder="Repeat Password" required>
                  </div>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block text-gray-900" name="submit" value="Register Account" placeholder="Register Account">
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <!-- End of Page Wrapper -->
  <!-- Script -->
  <?php $this->load->view('script'); ?>
  <Script>
    $(document).ready(function() {
      $(".validated").hide();
      setTimeout(() => {
        $(".alert").hide()
      }, 5000);
    });

    function validateForm() {
      if ($("#password").val() != $("#repeatpassword").val()) {
        $(".validated").show();
        $(".validated .message").text("Password tidak sesuai!");
        setTimeout(() => {
          $(".validated").hide()
        }, 3000);
        return false;
      }
    }
  </Script>
  <!-- End Script -->
</body>

</html>