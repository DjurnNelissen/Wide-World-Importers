<?php
  session_start();
  require_once('common.php');
?>
<html>

<head>
	<title>WWI Webshop</title>
	<link rel="stylesheet" href="css/main.css" media="screen" title="no title">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="js/main.js" charset="utf-8"></script>
</head>

<body>
	<div class="wrapper page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 sidebar">
					<p>Hier komt de sidebar met categorieen</p>
					<div class="categories">
						<?php
            printProductCategories();
           ?>
					</div>
				</div>

				<div class="col-md page-content">
					<?php include('Menu.php') ?>
					<div class="row main">
						<div class="products">
							<?php
            printProducts();
           ?>
						</div>
					</div>
					<div class="row footer">

					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
