<ul class="navbar-nav bg-secondary sidebar sidebar-black accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3"><?= $this->session->userdata('appname'); ?></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Recipe -->
  <li class="nav-item <?php echo $this->uri->segment(1) === "recipe" ? "active" : "";
                      echo $this->uri->segment(1) == "" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('recipe') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Recipe</span></a>
  </li>

  <!-- Nav Item - Notification -->
  <li class="nav-item <?= $this->uri->segment(1) == "notification" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('notification') ?>">
      <i class="fas fa-fw fa-heart"></i>
      <span>Notification</span></a>
  </li>

  <!-- Nav Item - Category -->
  <li class="nav-item <?= $this->uri->segment(1) == "category" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('category') ?>">
      <i class="fas fa-fw fa-info"></i>
      <span>Category</span></a>
  </li>

  <!-- Nav Item - Users -->
  <li class="nav-item <?= $this->uri->segment(1) == "users" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('users') ?>">
      <i class="fas fa-fw fa-user"></i>
      <span>Users</span></a>
  </li>

  <!-- Nav Item - Settings -->
  <li class="nav-item <?= $this->uri->segment(1) == "settings" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('settings') ?>">
      <i class="fas fa-fw fa-route"></i>
      <span>Settings</span></a>
  </li>

  <!-- Nav Item - About -->
  <li class="nav-item <?= $this->uri->segment(1) == "about" ? "active" : ""; ?>">
    <a class="nav-link" href="<?= base_url('about') ?>">
      <i class="fas fa-fw fa-calendar"></i>
      <span>About</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>