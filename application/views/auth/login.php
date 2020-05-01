<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

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
                <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-laugh-wink"></i> Food Recipe</h1>
                <?php if ($error) { ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } ?>
              </div>
              <form class="user" method="post" action="<?= base_url('auth') ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Password" name="password" required>
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block text-gray-900" name="submit" value="Login" placeholder="Login">
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
      setTimeout(() => {
        $(".alert").hide()
      }, 5000);
    });
  </Script>
  <!-- End Script -->
</body>

</html>