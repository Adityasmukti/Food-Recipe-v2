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
            <h1 class="h3 mb-0 text-gray-800"><?= $pageheading; ?></h1>
            <a href="<?= base_url('recipe/add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Recipe</a>
          </div>

          <!-- Card -->
          <div class="card shadow mb-4">
            <!-- Card Body -->
            <div class="card-body">
              <!-- Alert -->
              <?php if ($error) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?= $message; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php }
              if ($info) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= $message; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php } ?>
              <!-- End Alert -->
              <!-- filter select -->
              <form method="get" action="<?= base_url('recipe/index') ?>">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="kategori">Category</label>
                    <select id="kategori" name="category" class="form-control">
                      <option selected value="">Choose...</option>
                      <?php foreach ($kategori as $v) { ?>
                        <option value='<?= $v->category_id ?>' <?= $idkategori == $v->category_id ? 'selected' : '' ?>><?= $v->category_name ?></option>";
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
                      <th>Recipe Id</th>
                      <th>Recipe Name</th>
                      <th>Image</th>
                      <th>Ingredient</th>
                      <th>Instruction</th>
                      <th>Category</th>
                      <th>Detail</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0;
                    foreach ($table as $value) { ?>
                      <tr>
                        <td><?= $value->recipe_id ?></td>
                        <td><?= $value->recipe_name ?></td>
                        <td style="width: 100px;" class="text-center">
                          <a href="<?= base_url('upload/img/') . $value->recipe_image ?>" data-toggle="lightbox">
                            <img src="<?= base_url('upload/img/thumb/') . $value->recipe_image ?>" alt="" class="rounded-circle" style="max-width:100%; max-height:100%;">
                          </a>
                        </td>
                        <td><?= $value->recipe_ingredient ?></td>
                        <td><?= $value->recipe_instruction ?></td>
                        <td><?= $value->category ?></td>
                        <td class="text-center" style="width: 40px;">
                          <a href="<?= base_url('recipe/detail/') . $id[$i]; ?>" class="btn-sm btn-primary mb-2"><i class="fas fa-search"></i></a>
                        </td>
                        <td class="text-center" style="width: 100px;">
                          <a href="<?= base_url('recipe/edit/') . $id[$i]; ?>" class="btn-sm btn-primary mb-2"><i class="fas fa-edit"></i></a>
                          <a href="#" data-toggle="modal" data-target="#deleteModal<?= $value->recipe_id ?>" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                          <!-- Logout Modal-->
                          <div class="modal fade" id="deleteModal<?= $value->recipe_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                  <form action="<?= base_url('recipe'); ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $id[$i] ?>">
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
    $('#kategori').change(function() {
      $(this).closest('form').trigger('submit');
    });
  </script>
  <!-- End Script -->
</body>

</html>