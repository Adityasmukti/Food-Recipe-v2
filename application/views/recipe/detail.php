<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Detail Recipe</title>

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
              <li class="breadcrumb-item"><a href="<?= base_url('recipe') ?>">Recipe</a></li>
              <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Detail</h6>

            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="row">
                <div class="col-xl-8">
                  <div class="form-group">
                    <label for="recipename">Recipe Name</label>
                    <input type="text" id="recipename" class="form-control" value="<?= $data->recipe_name ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control" multiple="multiple" style="display: none;" disabled>
                      <?php foreach ($category as $v) { ?>
                        <option <?php foreach ($recipecategory as $value) {
                                  echo $v->category_id === $value->recipe_category_category ? "selected" : "";
                                } ?> value="<?= $v->category_id ?>"><?= $v->category_name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Ingredient">Ingredient</label>
                    <textarea class="form-control" id="Ingredient" rows="4" disabled><?= $data->recipe_ingredient; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="Instuction">Instuction</label>
                    <textarea class="form-control" id="Instuction" rows="4" disabled><?= $data->recipe_instruction; ?></textarea>
                  </div>
                  <!--  -->
                </div>
                <div class="col-xl-4 text-center">
                  <label for="Image">Recipe Image</label>
                  <div class="form-group">
                    <img src="<?= base_url('upload/img/') . $data->recipe_image ?>" alt="<?= $data->recipe_name ?>" class="rounded Image" style="max-width:100%; max-height:100%;">
                  </div>
                </div>
              </div>

            </div>
            <div class=" card-footer">
              <a href="<?= base_url('recipe') ?>" class="btn btn-primary float-xl-right float-lg-right">Back</a>
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
  <script src="<?= base_url('assets/js/') ?>popper.min.js"></script>
  <script src="<?= base_url('assets/vendor/bsmultiselect/dist/js/') ?>BsMultiSelect.js"></script>
  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function() {
      $(".Image").on("error", function() {
        $(this).attr('src', '<?= base_url('upload/img/'); ?>noimage.png');
      });
      $("#category").bsMultiSelect();
    });
  </script>
  <!-- End Script -->
</body>

</html>