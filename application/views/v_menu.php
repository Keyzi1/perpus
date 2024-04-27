<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <?php if ($this->session->userdata('role') == 'administrator') : ?>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">ADMIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url() ?>dashboard">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </span>
        </a>
        <?php endif; ?>
        <?php if ($this->session->userdata('role') == 'petugas') : ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">PETUGAS NAVIGATION</li>
          <li>
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </span>
            </a>
        <?php endif; ?>

        <?php if ($this->session->userdata('role') == 'peminjam') : ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">USER NAVIGATION</li>
          <li>
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </span>
            </a>
        <?php endif; ?>


      </li>
      <?php if ($this->session->userdata('role') == 'administrator') : ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data Perpustakaan</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">3</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>anggota"><i class="fa fa-circle-o"></i>Data Anggota</a></li>
            <li><a href="<?php echo base_url() ?>buku"><i class="fa fa-circle-o"></i>Data Buku</a></li>
            <li><a href="<?php echo base_url() ?>peminjam"><i class="fa fa-circle-o"></i>Data Peminjam</a></li>
        </li>
      <?php endif; ?>
      <?php if ($this->session->userdata('role') == 'petugas') : ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data Perpustakaan</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">3</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>anggota"><i class="fa fa-circle-o"></i>Data Anggota</a></li>
            <li><a href="<?php echo base_url() ?>buku"><i class="fa fa-circle-o"></i>Data Buku</a></li>
            <li><a href="<?php echo base_url() ?>peminjam"><i class="fa fa-circle-o"></i>Data Peminjam</a></li>
        </li>
      <?php endif; ?>
      <?php if ($this->session->userdata('role') == 'peminjam') : ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Peminjaman</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>peminjaman"><i class="fa fa-circle-o"></i>Data Peminjaman</a></li>
            <li><a href="<?php echo base_url() ?>pengembalian"><i class="fa fa-circle-o"></i>Data Pengembalian</a></li>
        </li>
      <?php endif; ?>
    </ul>

    <li><a href="<?= base_url() ?>dashboard/logout"><i class="fa fa-sign-out"></i> Sign Out</a></li>
  </section>
  <!-- /.sidebar -->
</aside>