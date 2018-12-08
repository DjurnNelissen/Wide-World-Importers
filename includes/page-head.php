<?php
  session_start();
  include_once('php/product.php');
?>
<!DOCTYPE HTML>
<html lang='en'>
	<head>
    <!-- De pagina naam moet variabel worden -->
		<title><?php print($title); ?> | Wide World Importers</title>
    <meta charset="utf-8">
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

   	<!-- Child theme -->
    <?php
			if ($stylesheet) {
				print('<link rel="stylesheet" href="' . $stylesheet . '">');
			} else {
				print('<!-- Child theme disabled -->');
			}
		?>

    <!-- Bootstrap related JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		<!-- Wide World Importers scripts -->
		<script src="js/main.js" charset="utf-8"></script>

	</head>

	<body>
		<div class="wrapper page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<?php
					if ($sidebar) {
						print('<div class="col col-md-3 p-3 sidebar">');
						include_once("includes/sidebar.php");
						print('</div>');
					} else {
						print('<!-- Sidebar disabled -->');
					}
					?>
					<div class="col-md page-content">
    				<?php include("includes/navbar.php") ?>
