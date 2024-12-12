<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');

?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="stylesheet" type="text/css" href="assets/dist/css/hp.css">
    <!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap ICON -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
   
  <title>Login | Kaagapay</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: absolute;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%) !important;
		display: flex;
	}
	.navbar  {
		background-image: url('assets/uploads/bg.png');
        }


</style>

<body class="bg-light">
<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
            <!-- <img src="assets/uploads/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Kaagapay -->
        </a>
            <ul class="navbar-nav ms-auto">
			<li class="nav-item">
                    <a class="nav-link text-white" href="hp1.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="hp1.php#news">News</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link text-white" href="about.php">About</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link text-white" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="adminlogin.php">Admin</a>
                </li>     
            </ul>
    </div>
</nav>

admin