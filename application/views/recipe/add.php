<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Add Recipe</title>

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
              <li class="breadcrumb-item active" aria-current="page">Add Recipe</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Add Recipe</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <form action="<?= base_url('recipe/addaction') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="recipe_name">Recipe Name</label>
                  <input type="text" id="recipe_name" name="recipe_name" class="form-control" value="" placeholder="Recipe Name" required>
                </div>

                <div class="form-group">
                  <label for="category">Category</label>
                  <select name="category[]" id="category" class="form-control" multiple="multiple" style="display: none;" require>
                    <?php foreach ($category as $v) { ?>
                      <option value="<?= $v->category_id ?>"><?= $v->category_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="recipe_ingredient">Recipe Ingredient</label>
                  <textarea class="form-control" id="recipe_ingredient" name="recipe_ingredient" rows="4" placeholder="Recipe Ingredient" required></textarea>
                </div>

                <div class="form-group">
                  <label for="recipe_instruction">Recipe Instuction</label>
                  <textarea class="form-control" id="recipe_instruction" name="recipe_instruction" rows="4" placeholder="Recipe Instuction" required></textarea>
                </div>

                <div class="form-group">
                  <label for="recipe_image">Recipe Image</label>
                  <input type="file" class="form-control-file" id="recipe_image" name="recipe_image">
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="recipe_notif" name="recipe_notif" id="recipe_notif">
                  <label class="form-check-label" for="recipe_notif">
                    Send Notification
                  </label>
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
  <!-- Page level custom scripts -->
  <script src="<?= base_url('assets/js/') ?>popper.min.js"></script>
  <script src="<?= base_url('assets/vendor/bsmultiselect/dist/js/') ?>BsMultiSelect.js"></script>
  <!-- Page level custom scripts -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#category").bsMultiSelect();
    });
  </script>
  <!-- End Script -->
</body>

</html>