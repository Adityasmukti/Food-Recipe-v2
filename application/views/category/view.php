<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Category - <?= $this->session->userdata('name');?></title>
  <!-- Header -->
  <?php $this->load->view('header'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" type="text/css">
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <a href="<?= base_url('category/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Category</a>
          </div>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
              <?php if (!empty($this->session->flashdata('redalert'))) { ?>
                <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('redalert') ?></div>
              <?php } ?>
              <?php if (!empty($this->session->flashdata('greenalert'))) { ?>
                <div class="alert alert-success" role="alert"><?= $this->session->flashdata('greenalert') ?></div>
              <?php } ?>
              <!-- Tabel -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Category Name</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($data as $value) { ?>
                      <tr>
                        <td style="width: 50px" class="text-center"><?= $i ?></td>
                        <td><?= $value->category_name ?></td>
                        <td style="width: 100px;" class="text-center">
                          <a href="<?= base_url('upload/img/') . $value->category_image ?>" data-toggle="lightbox">
                            <img src="<?= base_url('upload/img/') . $value->category_image ?>" alt="" class="rounded" style="max-width:100%; max-height:100%;">
                          </a>
                        </td>
                        <td class="text-center" style="width: 80px;">
                          <a href="<?= base_url("category/edit/$value->category_id") ?>" class="btn-sm btn-primary mb-2"><i class="fas fa-edit"></i></a>
                          <a href="#" data-toggle="modal" data-target="#deleteModal<?= $i ?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                          <!-- Logout Modal-->
                          <div class="modal fade" id="deleteModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete category?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Are you sure for delete Category data.</div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                  <form action="<?= base_url("category/delete"); ?>" method="post">
                                    <input type="hidden" name="category_id" id="category_id" value="<?= $value->category_id ?>">
                                    <input class="btn btn-danger" type="submit" name="delete" value="Delete">
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php $i++;
                    } ?>
                  </tbody>
                </table>
              </div>
              <!-- End Table -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTable').dataTable({
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 75, 100, 150, 200]
      });

      //initialize lightbox
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
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
  <script>
    window.setTimeout(function() {
      $(".alert-info").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-danger").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <script>
    window.setTimeout(function() {
      $(".alert-primary").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
  <!-- End Script -->
</body>

</html>