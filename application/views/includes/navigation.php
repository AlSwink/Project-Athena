<nav class="navbar navbar-expand-lg sticky-top navbar-dark p-0" style="background-color: #222426">
  <a class="navbar-brand pl-3 mr-lg-1" href="<?= site_url(); ?>">
    <img src="<?= base_url('assets/img/'.getSiteSetting('brand').''); ?>" height="35px"/>
  </a>
  <button class="navbar-toggler mr-2 border-0 text-right align-right" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse px-3 px-lg-1" id="menu">
      <span class="navbar-text border-dark border-left d-none d-sm-none d-md-none d-lg-block">
        &nbsp;
      </span>
      <ul class="navbar-nav mr-auto ">
        <li class="nav-item active">
          <a class="nav-link" href=""><i class="fas fa-home"></i> Home</a>
        </li>
        <?php foreach($this->session->userdata('user_menu') as $key => $menu){ ?>
          <li class="nav-item">
            <a class="nav-link main_menu" href="" data-target="<?= $menu['name']; ?>"><?= ($menu['icon'] ? '<i class="fas fa-'.$menu['icon'].'"></i>' : NULL); ?> <?= $menu['name']; ?></span></a>
          </li>
        <?php } ?>
      </ul>
      <form class="form-inline my-lg-0">
        <input class="form-control form-control-sm" type="search" placeholder="Ask Athena" aria-label="Search">
      </form>
      <span class="navbar-text pl-2 ml-2 border-left border-right border-dark d-none d-lg-block">
        <span class="clock" style="zoom: 0.29"></span>
      </span>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a id="notif" class="nav-link nav-mains" href="#" data-toggle="dropdown">
            <span class="fa-layers fa-fw">
            <i class="fas fa-bell"></i>
              <span id="badge"></span>
            </span><span class="d-lg-none"> Notifications</span>
          </a>
          <div id="notification_container" class="dropdown-menu dropdown-menu-right p-0" style="min-width: 25%">
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-mains" href="#" data-toggle="dropdown"><i class="fa fa-user-circle"></i><span class="d-lg-none"> Account</span></a>
          <div class="dropdown-menu dropdown-menu-right">
            <h6 class="dropdown-header"><?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname']; ?></h6>
            <a href="#" class="dropdown-item">My Profile</a>
            <a href="#" class="dropdown-item">Account Settings</a>
            <a href="#" class="dropdown-item">Activity Log</a>
            <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout <i class="fas fa-sign-out-alt"></i></a>
          </div>
        </li>
      </ul>
  </div>

</nav>

<div id="megamenu" class="collapse megamenu">
  <div id="megasubmenu" class="container-fluid py-2">

  </div>
</div>