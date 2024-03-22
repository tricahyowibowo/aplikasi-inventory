<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Pencatatan Inventaris kepemilikan mirota ksm">
	<meta name="author" content="Tri Cahya">
	<!-- <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"> -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/dist/img/favicon.png')?>">

	<link rel="preconnect" href="https://fonts.gstatic.com">

  <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">

	<link rel="shortcut icon" href="<?= base_url('assets/dist/img/favicon.png')?>" />

	<title><?= $pageTitle ?></title>

  <!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/2edfabd55a.js" crossorigin="anonymous"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

  <!-- Adminkit -->
	<link href="<?= base_url(); ?>assets/adminkit/css/app.css" rel="stylesheet">

	<!-- Style.css -->
	<link href="<?= base_url(); ?>assets/dist/css/style.css" rel="stylesheet">
  
  <!-- FullCalendar -->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  
  <!-- SELECT2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<style>
  html, body {
  margin: 0;
  padding: 0;
  font-size: 14px;
  }

  a{
    color: #003265;
  }

  a:hover{
    text-decoration:none;
    color:red;
  }

  .sidebar li .submenu{ 
    list-style: none; 
    margin: 0; 
    padding: 0; 
    padding-left: 1rem; 
    padding-right: 1rem;
  }

  .card{
    border-radius:15px;
    box-shadow: 2px 2px 10px 2px rgba(99,92,99,0.28);
  }

  .card-header{
    border-radius:15px;
  }

  .sidebar-content{
    background: rgb(31,182,245);
    background: radial-gradient(circle, rgba(31,182,245,1) 0%, rgba(8,84,173,1) 100%);
  }

  a.sidebar-link{
    background-color:rgba(28,136,227,0.2);
  }

  a.sidebar-link:hover{
    background-color:rgba(28,136,227,0.8);
  }


  .bg-pattern{
    background: rgb(31,182,245);
    background: radial-gradient(circle, rgba(31,182,245,1) 0%, rgba(8,84,173,1) 100%);
  }

  .box{
    padding:15px 0 50px 0;
    background-image: linear-gradient( 96.5deg,  rgba(39,103,187,1) 10.4%, rgba(16,72,144,1) 87.7% );
    border-radius:0 0 15% 15%;
    box-shadow: 2px 2px 10px 10px rgba(99,92,99,0.50);
    color:#fff;
  }

  .imageheader{
    width: 80%;
    max-width: 300px;
  }

  .login-button{
    color:#fff;
    text-decoration:none;
  }

  .login-button:hover{
    color:red;
    text-decoration:none;
  }

  .text-header{
    color:#fff;
    /* font-family: 'Mochiy Pop One', sans-serif; */
    font-family: 'Tilt Warp', sans-serif;
  }

  .container-body{
    margin-top:-10px;
  }

  @media (max-width:440px){
    .text-header{
      font-size: 20px;
      text-align:center;
    }

    .container-body{
    margin-top:-10%;
    }

    .container-body{
    margin-top:-20%;
    margin-bottom:50%;
    }
  }

  /* .card-divisi, .card-menu{
    max-height:200px;
  } */

  .card-divisi h2{
    font-family: 'Tilt Warp', sans-serif;
  }

  .card-divisi p{
    font-size:50px;
    color:  rgb(0,50,101,0.20);
  }

  .card-menu{
    max-width:250px;
  }

  .card-menu:hover{
    margin-top:-10px;
  }

  .card-menu p{
    font-size:50px;
    color:  rgb(0,50,101,0.20);
  }

  .card-dashboard{
    height:200px;
  }

  .header-dashboard{
    font-family: "Tilt Warp", sans-serif;
  }

  label{
    font-weight:bold;
    margin-top:5px; 
  }

  

  /* .sidebar-link:hover,.sidebar-item.active>.sidebar-link{
    background-color:blue;
  } */
</style>
  <!-- <body class="sidebar-mini skin-black-light"> -->
<?php 
if(isset($name)){ ?>
<body>
<div class="wrapper">
  <nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
      <a class="sidebar-brand" href="index.html">
        <span class="align-middle">Mirota KSM </span>
      </a>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="<?php echo base_url('/dashboard');?>" class="sidebar-link">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
          </a>
        </li>
        <li class="sidebar-header">
          Master Data
        </li>
        <?php
        if($role == ROLE_SUPERADMIN)
        {
        ?>
        <li class="sidebar-item">
          <a href="<?php echo base_url('Datadivisi'); ?>" class="sidebar-link">
            <i class="fa fa-user"></i>
            <span>Data Divisi</span>
          </a>
        </li>
        <?php } ?>

        <?php
        if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN | $role == ROLE_MANAGER | $role == ROLE_HRD )
        {
        ?>
        <li class="sidebar-item">
          <a href="<?php echo base_url('Dataruangan'); ?>" class="sidebar-link">
          <i class="fa fa-building"></i> <span>Data Ruangan</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="<?php echo base_url('Databarang'); ?>" class="sidebar-link">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Data Barang</span>
          </a>
        </li>
        <?php } ?>
        <?php
        if($role == ROLE_SUPERADMIN | $role == ROLE_MANAGER | $role == ROLE_POOL)
        {
        ?>
        <li class="sidebar-item">
          <a href="<?php echo base_url('Datakendaraan'); ?>" class="sidebar-link">
            <i class="fa-solid fa-car"></i>
            <span>Data Kendaraan</span>
          </a>
        </li>
        <?php } ?>

        <?php
        if($role == ROLE_SUPERADMIN | $role == ROLE_HRD | $role == ROLE_MANAGER)
        {
        ?>
        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> Peminjaman <i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <li class="sidebar-item">
              <a href="<?php echo base_url('Pinjamruangan'); ?>" class="sidebar-link">
                <span>Peminjaman Ruangan</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?php echo base_url('Pinjambarang'); ?>" class="sidebar-link">
                <span>Peminjaman Barang</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item has-submenu">
          <a class="sidebar-link" href="#"><i class="fa-solid fa-circle-exclamation"></i> Pengaduan Kerusakan <i class="fa fa-angle-down" style="float: right;"></i> </a>
          <ul class="submenu collapse">
            <li class="sidebar-item">
              <a href="<?php echo base_url(); ?>kerusakanRuangan" class="sidebar-link">
                <span>Kerusakan Ruangan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?php echo base_url(); ?>kerusakanBarang" class="sidebar-link">
                <span>Kerusakan Barang</span>
              </a>
            </li>
            </ul>
        </li>
        <?php } ?>


        <?php
        if($role == ROLE_SUPERADMIN)
        {
        ?>
        <li class="sidebar-header">
          User Management
        </li>
        <li class="sidebar-item">
          <a href="<?php echo base_url(); ?>userListing" class="sidebar-link">
            <i class="fa fa-users"></i>
            <span>Users</span>
          </a>
        </li>
        <?php } ?>
        <?php
        if($role != ROLE_POOL)
        {
        ?>
        <li class="sidebar-item">
          <a href="<?= base_url('barang/cekBarang')?>" class="sidebar-link">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Cek Barang</span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </div>
  </nav>

  <div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
      <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
      </a>

      <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
              <div class="position-relative">
                <i class="align-middle" data-feather="bell"></i>
                <span class="indicator" id="indicator"></span>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
              <div class="dropdown-menu-header" id="indicator-header">
              </div>
              <div class="list-group">
                <?php
                if($role == ROLE_ADMIN || $role == ROLE_HRD)
                {
                ?>
                <a href="<?php base_url(); ?>kerusakanBarang" class="list-group-item" onclick="bacaNotifBarang()">
                  <div class="row g-0 align-items-center">
                    <div class="col-2">
                      <i class="text-danger" data-feather="alert-circle"></i>
                    </div>
                    <div class="col-10">
                      <div class="text-dark">Laporan Kerusakan Barang</div>
                      <div class="text-muted small mt-1" id="indicator-barang"></div>
                    </div>
                  </div>
                </a>
                <?php } ?>

                <?php
                if($role == ROLE_HRD)
                {
                ?>
                <a href="<?php base_url();?>kerusakanRuangan" class="list-group-item" onclick="bacaNotifRuangan()">
                  <div class="row g-0 align-items-center">
                    <div class="col-2">
                      <i class="text-danger" data-feather="alert-circle"></i>
                    </div>
                    <div class="col-10">
                      <div class="text-dark">Laporan Kerusakan Ruangan</div>
                      <div class="text-muted small mt-1" id="indicator-ruangan"></div>
                    </div>
                  </div>
                </a>
                <?php } ?>
              </div>
              <div class="dropdown-menu-footer">
                <a href="#" class="text-muted">Show all notifications</a>
              </div>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
              <i class="align-middle" data-feather="settings"></i>
            </a>

            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <span class="text-dark"><?= $name ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <!-- <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
              <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
              <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
              <div class="dropdown-divider"></div> -->
              <a class="dropdown-item" href="<?= base_url('logout')?>">Log out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <main class="content">
      <div class="container-fluid p-0">
<?php }else{ ?>
<body class="bg-pattern">
<div>
  <div class="box">
    <div class="container">
      <div class="container">
        <div class="d-flex justify-content-between">
          <a class="login-button" href="<?= base_url(); ?>"><i class="fa fa-solid fa-home"></i> Home</a>
          <a class="login-button" href="<?= base_url('login'); ?>"><i class="fa-solid fa-circle-user"></i> Login</a>
        </div>
      </div>
      <div class="container">
        <div class="d-flex justify-content-center">
          <img class="imageheader" src="<?= base_url('assets/dist/img/mirota.png')?>" alt="" srcset="">
        </div>
        <div class="d-flex justify-content-center">
          <h1 class="text-header">
            <?= $pageHeader ?>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="container" style="min-height:400px; margin-top:-3%">
<?php } ?>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(){

		document.querySelectorAll('.sidebar .sidebar-link').forEach(function(element){

			element.addEventListener('click', function (e) {

				let nextEl = element.nextElementSibling;
				let parentEl  = element.parentElement;	

				if(nextEl) {
					e.preventDefault();	
					let mycollapse = new bootstrap.Collapse(nextEl);

			  		if(nextEl.classList.contains('show')){
			  			mycollapse.hide();
			  		} else {
			  			mycollapse.show();
			  			// find other submenus with class=show
			  			var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
			  			// if it exists, then close all of them
						if(opened_submenu){
							new bootstrap.Collapse(opened_submenu);
						}

			  		}
		  		}

			});
		})

	}); 
	// DOMContentLoaded  end



</script>
