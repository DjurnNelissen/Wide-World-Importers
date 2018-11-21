<?php
  session_start();
  include_once('php/product.php');
?><!DOCTYPE HTML>
<html lang='en'>
	<head>
    <!-- De pagina naam moet variabel worden -->
		<title>Home | Wide World Importers</title>
    <meta charset="utf-8"></meta>
		<!-- Bootstrap 4.1.3 -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

		<!-- Font Awesome 5.5 -->
		<link rel="stylesheet" href="css/all.min.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="js/all.min.js" charset="utf-8"></script>

		<!-- Favicon -->
		<link rel="icon" href="img/favicon.png" type="image/x-icon" />

		<!-- Wide World Importers stylesheet -->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/product.css">
		<link rel="stylesheet" href="css/cart.css">

		<!-- Wide World Importers scripts -->
		<script src="js/main.js" charset="utf-8"></script>

	</head>

	<body>
		<div class="wrapper page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col col-md-3 p-3 sidebar">
    				<?php include("includes/sidebar.php") ?>
					</div>

					<div class="col-md page-content">
    				<?php include("includes/navbar.php") ?>
