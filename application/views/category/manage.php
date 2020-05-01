<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Categori</title>

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
              <form id="manage" action="<?= $edit ? base_url('category/edit/') . $urlencode : base_url('category/add'); ?>" method="post">
                <div class="form-group">
                  <label for="categorykode">category Id</label>
                  <input type="text" id="categorykode" name="categorykode" class="form-control" value="<?= $categoryid ?>" placeholder="Category Id" readonly>
                </div>
                <div class="form-group">
                  <label for="categoryname">Category Name</label>
                  <input type="text" id="categoryname" name="categoryname" class="form-control" value="<?= $category_name ?>" placeholder="Category Name" required>
                </div>
              </form>
              <!--  -->
            </div>
            <div class="card-footer">
              <a href="<?= base_url('category') ?>" class="btn btn-primary float-xl-right float-lg-right">Back</a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary float-xl-right float-lg-right mr-3" data-toggle="modal" data-target="#saveModal">
                Save Category
              </button>
              <!-- Modal -->
              <!-- Modal -->
              <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="saveModalLabel">Save <?= $edit ? "Change" : "New" ?> Category?</h5>
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