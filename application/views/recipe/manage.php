<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Recipe</title>

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
              <li class="breadcrumb-item"><a href="<?= base_url('recipes') ?>">Recipe</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $state; ?></li>
            </ol>
          </nav>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $state; ?></h1>
          </div>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <?php if ($error) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <?= $message ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php } ?>
              <!--  -->
              <form id="manage" action="<?= $edit ? base_url('recipe/edit/') . $urlencode : base_url('recipe/add'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="recipekode">Recipe Id</label>
                  <input type="text" id="recipekode" name="recipekode" class="form-control" value="<?= $recipeid ?>" placeholder="Recipe Id" readonly>
                </div>
                <div class="form-group">
                  <label for="recipename">Recipe Name</label>
                  <input type="text" id="recipename" name="recipename" class="form-control" value="<?= $recipe_name ?>" placeholder="Recipe Name" required>
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <select name="category[]" id="category" class="form-control" multiple="multiple" style="display: none;">
                    <?php foreach ($kategori as $v) { ?>
                      <option <?php if ($edit || $error) {
                                  foreach ($categorirecipe as $value) {
                                    if ($v->category_id === $value) echo "selected";
                                  }
                                } ?> value="<?= $v->category_id ?>"><?= $v->category_name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Ingredient">Recipe Ingredient</label>
                  <textarea class="form-control" id="Ingredient" name="ingredient" rows="4" placeholder="Ingredient" required><?= $recipe_ingredient; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="Instuction">Recipe Instuction</label>
                  <textarea class="form-control" id="Instuction" name="instuction" rows="4" placeholder="Instuction" required><?= $recipe_instruction; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="fileimage">Recipe Image</label>
                  <input type="file" class="form-control-file" id="fileimage" name="fileimage">
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="sendnotif" name="sendnotif" id="sendnotif" <?php echo $cbdisabled?"disabled":"checked"?> >
                  <label class="form-check-label" for="sendnotif">
                    Send Notification
                  </label>
                </div>
              </form>
              <!--  -->
            </div>
            <div class="card-footer">
              <a href="<?= base_url('recipe') ?>" class="btn btn-primary float-xl-right float-lg-right">Back</a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary float-xl-right float-lg-right mr-3" data-toggle="modal" data-target="#saveModal">
                Save Recipe
              </button>
              <!-- Modal -->
              <!-- Modal -->
              <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="saveModalLabel">Save <?= $edit ? "Change" : "New" ?> Recipe?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      You sure have entered the correct data, please click confirm?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-save" form="manage" class="btn btn-primary">Confirm</button>
                    </div>
                  </div>
                </div>
              </div>
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
      $("#btn-save").click(function() {
        setTimeout(function() {
          $('#saveModal').modal('hide');
        }, 1000);
      })
    });
  </script>
  <!-- End Script -->
</body>

</html>