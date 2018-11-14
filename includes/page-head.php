<?php
  session_start();
  require_once('common.php');
?>
<html>
	<head>
		<title>Home<!-- De pagina naam moet variabel worden --> | Wide World Importers</title>

		<!-- Bootstrap 4.1.3 -->
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<!-- Font Awesome 5.5 -->
		<link rel="stylesheet" href="css/all.min.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="js/all.min.js" charset="utf-8"></script>

		<!-- Favicon -->
		<link rel="icon" href="img/favicon.png" type="image/x-icon" />

		<!-- Wide World Importers stylesheet -->
		<link rel="stylesheet" href="css/main.css">

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
