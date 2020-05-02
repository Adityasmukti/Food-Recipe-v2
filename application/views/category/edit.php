<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit Categori</title>

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
              <li class="breadcrumb-item"><a href="<?= base_url('category') ?>">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
          </nav>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <!--  -->
              <form id="manage" action="<?= base_url('category/editaction'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" id="category_id" name="category_id" class="form-control" value="<?= $data->category_id ?>">
                <input type="hidden" id="category_image_old" name="category_image_old" class="form-control" value="<?= $data->category_image ?>">
                <div class="form-group">
                  <label for="category_name">Category Name</label>
                  <input type="text" id="category_name" name="category_name" class="form-control" value="<?= $data->category_name ?>" placeholder="Category Name" required>
                </div>
                <div class="form-group">
                  <label for="category_image">Category Image</label><br>
                  <img src="<?= base_url("upload/img/$data->category_image") ?>" alt="" width="400px">
                  <input type="file" class="form-control-file" id="category_image" name="category_image">
                </div>
                <hr>
                <div class="form-group">
                  <a href="<?= base_url('category') ?>" class="btn btn-primary float-right">Back</a>
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
  <!-- End Script -->
</body>

</html>