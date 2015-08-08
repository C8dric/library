<?php
session_start();
	include("includes/configure.php");
accessverif();


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Bienvenue sur le site biblio-arnould
        </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
    
<body>
<div class="container">
	<div class="page-header">
	  <h1>Bibliothèque ARNOULD</h1>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="alert alert-success"><?php echo getName(); ?></div></div>
	</div>
	<div class="btn-group btn-group-lg">
	  <a href="auteurs.php"><abbr title="Gérer la bibliothèque : Ajouter des auteurs, des livres, ..."><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-book"></span> Gérer</button></abbr></a>
	  <a href="export.php"><abbr title="Exporter la bibliothèque au format CSV"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-export"></span> Exporter en CSV</button></abbr></a>
	  <a href="log.txt"><abbr title="Fichier des évolutions de l'application"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-info-sign"></span> Fichier log</button></abbr></a>	  
	  <a href="logout.php"><abbr title="Se déconnecter de la bibliothèque"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</button></abbr></a>
	</div>
	
	<div class="row">
	
	</div>

</div>
	<!-- js -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>