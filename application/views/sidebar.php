<ul class=" sidenav navbar-nav bg-gradient-primary sidebar sidebar-black accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center text-white" href="<?= base_url() ?>">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div> -->
    <img src="<?= base_url("upload/img/"  . (empty($this->session->userdata('logo')) ? "logo.png" : $this->session->userdata('logo'))) ?>" alt="" width="50px" class="image rounded-circle">
    <div class="sidebar-brand-text mx-3"><?= $this->session->userdata('name'); ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Category -->
  <li class="nav-item <?= $this->uri->segment(1) === "category" ? "active shadow" : ""; ?>">
    <a class="nav-link text-white" href="<?= base_url('category') ?>">
      <i class="fas fa-fw fa-list text-white"></i>
      <span>Category</span></a>
  </li>

  <!-- Nav Item - Recipe -->
  <li class="nav-item <?php echo $this->uri->segment(1) === "recipe" ? "active shadow" : "";
                      echo $this->uri->segment(1) === "" ? "active" : ""; ?>">
    <a class="nav-link text-white" href="<?= base_url('recipe') ?>">
      <i class="fas fa-fw fa-hamburger text-white"></i>
      <span>Recipe</span></a>
  </li>

  <!-- Nav Item - Notification -->
  <li class="nav-item <?= $this->uri->segment(1) === "notification" ? "active shadow" : ""; ?>">
    <a class="nav-link text-white" href="<?= base_url('notification') ?>">
      <i class="fas fa-fw fa-bell text-white"></i>
      <span>Notification</span></a>
  </li>

  <!-- Nav Item - Users -->
  <li class="nav-item <?= $this->uri->segment(1) === "users" ? "active shadow" : ""; ?>">
    <a class="nav-link text-white" href="<?= base_url('users') ?>">
      <i class="fas fa-fw fa-user text-white"></i>
      <span>Users</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading text-white">
    Addons
  </div>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item <?= $this->uri->segment(1) == "settings" ? "active" : ""; ?>">
    <a class="nav-link text-white <?= $this->uri->segment(2) == "" ? "collapsed" : ""; ?>" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
      <i class="fas fa-fw fa-wrench text-white"></i>
      <span>Setting</span>
    </a>
    <div id="collapsePages" class="collapse <?= $this->uri->segment(1) === "settings" ? "show" : ""; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-gradient-primary py-2 collapse-inner rounded">
        <a class="collapse-item text-white <?= $this->uri->segment(2) === "application" ? "active shadow" : ""; ?>" href="<?= base_url('settings/application') ?>">Application</a>
        <a class="collapse-item text-white <?= $this->uri->segment(2) === "fcm" ? "active shadow" : ""; ?>" href="<?= base_url('settings/fcm') ?>">FCM</a>
        <a class="collapse-item text-white <?= $this->uri->segment(2) === "registeremail" ? "active shadow" : ""; ?>" href="<?= base_url('settings/registeremail') ?>">Register Email</a>
        <a class="collapse-item text-white <?= $this->uri->segment(2) === "forgotpassemail" ? "active shadow" : ""; ?>" href="<?= base_url('settings/forgotpassemail') ?>">Forgot Password Email</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - About -->
  <li class="nav-item <?= $this->uri->segment(1) == "about" ? "active shadow" : ""; ?>">
    <a class="nav-link text-white" href="<?= base_url('about') ?>">
      <i class="fas fa-fw fa-info text-white"></i>
      <span>About</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>