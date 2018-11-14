<?php
  session_start();
  require_once('common.php');
?>
<html>
	<head>
		<title>Home <!-- De pagina naam moet variabel worden -->| Wide World Importers</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/bootstrap.min.css"> <!-- dit moet nog lokaal komen te staan -->
		<script src="js/main.js" charset="utf-8"></script>
	</head>

	<body>
		<div class="wrapper page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3 sidebar">
    				<?php include("includes/sidebar.php") ?>
					</div>

					<div class="col-md page-content">
    				<?php include("includes/navbar.php") ?>
