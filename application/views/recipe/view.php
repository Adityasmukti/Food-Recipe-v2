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
            <h1 class="h3 mb-0 text-gray-800">Recipe</h1>
            <a href="<?= base_url('recipe/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Recipe</a>
          </div>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
              <!-- filter select -->
              <form method="get" action="<?= base_url('recipe') ?>">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                      <option selected value="">Choose...</option>
                      <?php foreach ($category as $v) { ?>
                        <option value='<?= $v->category_id ?>' <?= $category_id == $v->category_id ? 'selected' : '' ?>><?= $v->category_name ?></option>";
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </form>
              <!-- end filter select -->
              <div class="dropdown-divider mb-4"></div>
              <!-- Tabel -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Recipe Name</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($data as $value) { ?>
                      <tr>
                        <td style="width: 30px" class="text-center"><?= $i ?></td>
                        <td><?= $value->recipe_name ?></td>
                        <td style="width: 100px;" class="text-center">
                          <a href="<?= base_url('upload/img/') . $value->recipe_image ?>" data-toggle="lightbox">
                            <img src="<?= base_url('upload/img/') . $value->recipe_image ?>" alt="" class="rounded" style="max-width:100%; max-height:100%;">
                          </a>
                        </td>
                        <td><?= $value->category ?></td>
                        <td class="text-center" style="width: 130px;">
                          <a href="<?= base_url("recipe/detail/$value->recipe_id") ?>" class="btn-sm btn-primary mb-2" data-toggle="tooltip" title="Detail"><i class="fas fa-eye"></i></a>
                          <a href="<?= base_url("recipe/edit/$value->recipe_id") ?>" class="btn-sm btn-primary mb-2" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="#" data-toggle="modal" data-target="#deleteModal<?= $i ?>" class="btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                          <!-- Logout Modal-->
                          <div class="modal fade" id="deleteModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete data?</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Are you sure for delete Recipe data.</div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                  <form action="<?= base_url('recipe/delete'); ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $value->recipe_id ?>">
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

      //initialize lightbox
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });
    });

    //initialize datatable
    $('#dataTable').dataTable({
      "pageLength": 25,
      "lengthMenu": [25, 50, 75, 100, 150, 200]
    });

    //trigger submit for filter
    $('#category_id').change(function() {
      $(this).closest('form').trigger('submit');
    });
  </script>
  <!-- End Script -->
</body>

</html>