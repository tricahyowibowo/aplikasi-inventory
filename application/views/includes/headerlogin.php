<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">

  <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

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
    background-color: #003265;
  }

  a.sidebar-link{
    background-color: #003265;
  }

  .bg-pattern{
    background-color: #ffffff;
    opacity: 0.6;
    background-image:  radial-gradient(#003265 2px, transparent 2px), radial-gradient(#003265 2px, #ffffff 2px);
    background-size: 80px 80px;
    background-position: 0 0,40px 40px;
  }

  .box{
    height:50%;
    padding:10px 0;
    background-image: linear-gradient( 96.5deg,  rgba(39,103,187,1) 10.4%, rgba(16,72,144,1) 87.7% );
    border-radius:0 0 15% 15%;
    box-shadow: 2px 2px 10px 10px rgba(99,92,99,0.50);
    color:#fff;
  }

  .bg-pattern{
    background: rgb(31,182,245);
    background: radial-gradient(circle, rgba(31,182,245,1) 0%, rgba(8,84,173,1) 100%);
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

  .text-white{
    color:#fff;
  }

  .text-header{
    color:#fff;
    /* font-family: 'Mochiy Pop One', sans-serif; */
    font-family: 'Tilt Warp', sans-serif;
  }

  .container-body{
    margin-top:-5%;
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

  

  /* .sidebar-link:hover,.sidebar-item.active>.sidebar-link{
    background-color:blue;
  } */
</style>
  <!-- <body class="sidebar-mini skin-black-light"> -->
<body class="bg-pattern">




