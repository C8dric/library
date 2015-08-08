<?php
include("includes/configure.php");
session_start();
accessverif();
	
	$idlivre = $_GET["idlivre"];
	
	$nom=mysql_query("select * from livre L where L.idLivre=".$idlivre);
   $livre=mysql_fetch_array($nom);
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <title>Modification du livre <?php echo $livre['titreLivre']; ?>
        </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
    
<body>
<div class="container">
	<div class="page-header">
	  <h1>Modification du livre <?php echo $livre['titreLivre']; ?></h1>
	</div>
	<form class="form-horizontal" role="form" method="post" action="change.php">
		<div class="form-group">
			<label for="title" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Titre</label>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<input type="text" class="form-control" id="title" name="title" value="<?php echo $livre['titreLivre']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="dde" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Date début emprunt</label>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<input type="text" class="form-control" id="dde" name="dde" maxlength="10" placeholder="jj/mm/aaaa" value="<?php echo date("d/m/Y", strtotime($livre['dateDebut'])); ?>" >
			</div>
		</div>
		<div class="form-group">
			<label for="dfe" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Date fin emprunt</label>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<input type="text" class="form-control" id="dfe" name="dfe" maxlength="10" placeholder="jj/mm/aaaa" value="<?php echo date("d/m/Y", strtotime($livre['dateFin'])); ?>" >
			</div>
		</div>
		<div class="form-group">
			<label for="read" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Livre lu</label>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				Oui <input type="radio" name="read" value="oui" <?php if($livre['etatLivre'] == 'oui') { echo 'checked="checked"'; } ?> /> 
				Non <input type="radio" name="read" value="non" <?php if($livre['etatLivre'] == 'non') { echo 'checked="checked"'; } ?> /><br> 
				<input type="hidden" name="livre" id="livre" value="<? echo $idlivre; ?>" />
				<input type="hidden" name="auteur" id="auteur" value="<? echo $livre['idAuteur']; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="rating" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Note</label>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<select name="rating">
				<?php
					if($livre['note'] === "6"){
						echo '<option value="6">Non noté (note actuelle)</option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>';
					}else{
						echo '<option value="'.$livre['note'].'">'.$livre['note'].' (note actuelle)</option>
						<option value="6">Non noté</option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>';
					
					}
				?>				
			    </select>
			</div>
		</div>		
		<div class="form-group">
			<div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<button type="submit" name="submit" id="submit" class="btn btn-primary">Modifier</button>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="livres.php?id=<?php echo $livre['idAuteur']; ?>"><button type="button" class="btn btn-default">Retour à la page des livres</button></a>
		</div>
	</div>	
</div>
	<!-- js -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>