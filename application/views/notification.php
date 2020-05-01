<!DOCTYPE html>
<html lang="en">

<head>
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $pageheading; ?></h1>
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
              <?php if ($info) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= $message ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php } ?>
              <!--  -->
              <form id="manage" action="<?= base_url('notification/') ?>" method="post">
                <div class="form-group">
                  <label for="categorykode">Notification Title</label>
                  <input type="text" id="notificationtitle" name="notificationtitle" class="form-control" placeholder="Notification Title" required>
                </div>
                <div class="form-group">
                  <label for="categoryname">Notification Content</label>
                  <textarea type="text" id="notificationconten" name="notificationconten" class="form-control" placeholder="Notification Content" rows="4" required></textarea>
                </div>
              </form>
              <!--  -->
            </div>
            <div class="card-footer">
              <a href="<?= base_url('notification') ?>" class="btn btn-primary float-xl-right float-lg-right">Back</a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary float-xl-right float-lg-right mr-3" data-toggle="modal" data-target="#saveModal">
                Send Notification
              </button>
              <!-- Modal -->
              <!-- Modal -->
              <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="saveModalLabel">Send Notification?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      You sure have entered the correct data, please click confirm?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-save" name="btn-save" form="manage" class="btn btn-primary">Confirm</button>
                      <input type="checkbox" class="custom-control-input" form="manage" name="customCheck1" value="tes" id="customCheck1">
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