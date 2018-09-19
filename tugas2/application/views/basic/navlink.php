<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Rotti Salem</a>

  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">

    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php echo @$dashboard;?>" href="<?php echo base_url();?>">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo @$tambahPeserta;?>" href="<?php echo base_url();?>peserta/tambah">
              <span data-feather="user"></span>
              Tambah Peserta
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo @$managepeserta;?>" href="<?php echo base_url();?>peserta/manage">
              <span data-feather="users"></span>
              Manage Peserta
            </a>
          </li>
        </ul>
      </div>
    </nav>
