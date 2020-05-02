<ul class="navbar-nav bg-secondary sidebar sidebar-black accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div> -->
    <img src="<?= base_url("upload/img/" . $this->session->userdata('logo')) ?>" alt="" width="50px" class="image rounded-circle">
    <div class="sidebar-brand-text mx-3"><?= $this->session->userdata('name'); ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Recipe -->
  <li class="nav-item <?php echo $this->uri->segment(1) === "recipe" ? "active" : "";
                      echo $this->uri->segment(1) == "" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('recipe') ?>">
      <i class="fas fa-fw fa-hamburger"></i>
      <span>Recipe</span></a>
  </li>

  <!-- Nav Item - Notification -->
  <li class="nav-item <?= $this->uri->segment(1) == "notification" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('notification') ?>">
      <i class="fas fa-fw fa-bell"></i>
      <span>Notification</span></a>
  </li>

  <!-- Nav Item - Category -->
  <li class="nav-item <?= $this->uri->segment(1) == "category" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('category') ?>">
      <i class="fas fa-fw fa-list"></i>
      <span>Category</span></a>
  </li>

  <!-- Nav Item - Users -->
  <li class="nav-item <?= $this->uri->segment(1) == "users" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('users') ?>">
      <i class="fas fa-fw fa-user"></i>
      <span>Users</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Addons
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item <?= $this->uri->segment(1) == "settings" ? "active" : ""; ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Setting</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= base_url('settings/application') ?>">Application</a>
        <a class="collapse-item" href="<?= base_url('settings/fcm') ?>">FCM</a>
        <a class="collapse-item" href="<?= base_url('settings/email') ?>">Email</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - About -->
  <li class="nav-item <?= $this->uri->segment(1) == "about" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('about') ?>">
      <i class="fas fa-fw fa-info"></i>
      <span>About</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>