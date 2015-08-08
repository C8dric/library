<?php
include("includes/configure.php");
session_start();
accessverif();

/*	if (isset($_GET["sort"])){
		if ($_GET["sort"]=='prenom'){
				$auteurs=mysql_query("select * from auteur ORDER BY prenomAuteur ASC");
		}else{
				if ($_GET["sort"]=='nom'){
				$auteurs=mysql_query("select * from auteur ORDER BY nomAuteur ASC");
				}
		}
	}else{
	$auteurs=mysql_query("select * from auteur ORDER BY nomAuteur ASC");
	}
*/

	switch ($_GET["sort"]) {
    case "prenom":
        $auteurs=mysql_query("SELECT DISTINCT A.idAuteur, A.nomAuteur, A.prenomAuteur, COUNT( DISTINCT (L1.idLivre) ) AS livresLus, COUNT( DISTINCT (L2.idLivre) ) AS livresNonLus				FROM auteur A				LEFT JOIN livre L1 ON A.idAuteur = L1.idAuteur				AND L1.etatLivre =  'oui'				LEFT JOIN livre L2 ON A.idAuteur = L2.idAuteur				AND L2.etatLivre =  'non'				GROUP BY A.idAuteur				ORDER BY prenomAuteur ASC");
        break;
    case "nom":
        $auteurs=mysql_query("SELECT DISTINCT A.idAuteur, A.nomAuteur, A.prenomAuteur, COUNT( DISTINCT (L1.idLivre) ) AS livresLus, COUNT( DISTINCT (L2.idLivre) ) AS livresNonLus				FROM auteur A				LEFT JOIN livre L1 ON A.idAuteur = L1.idAuteur				AND L1.etatLivre =  'oui'				LEFT JOIN livre L2 ON A.idAuteur = L2.idAuteur				AND L2.etatLivre =  'non'				GROUP BY A.idAuteur		ORDER BY nomAuteur ASC");
        break;
    case "id":
        $auteurs=mysql_query("select * from auteur ORDER BY idAuteur ASC");
        break;
    default:
       $auteurs=mysql_query("SELECT DISTINCT A.idAuteur, A.nomAuteur, A.prenomAuteur, COUNT( DISTINCT (L1.idLivre) ) AS livresLus, COUNT( DISTINCT (L2.idLivre) ) AS livresNonLus				FROM auteur A				LEFT JOIN livre L1 ON A.idAuteur = L1.idAuteur				AND L1.etatLivre =  'oui'				LEFT JOIN livre L2 ON A.idAuteur = L2.idAuteur				AND L2.etatLivre =  'non'				GROUP BY A.idAuteur				ORDER BY nomAuteur ASC");
}

	$lu=mysql_query("select count(idLivre) as livre from livre WHERE etatLivre='oui'");
	$nbLu = mysql_fetch_array($lu);

	$nonLu=mysql_query("select count(idLivre) as livre from livre WHERE etatLivre='non'");
	$nbNonLu = mysql_fetch_array($nonLu);

	$auteur=mysql_query("select count(idAuteur) as auteur from auteur");
	$nbAuteur = mysql_fetch_array($auteur);

        $livreARendre = mysql_query("select titreLivre, dateFin from livre where dateFin < DATE(DATE_ADD(NOW(), INTERVAL +15 DAY)) AND dateFin <> '0000-00-00' AND dateFin > DATE(NOW())");
        //$nbLivreARendre = mysql_fetch_array($livreARendre);

	$i=0;

	?>
<!DOCTYPE html><html>	<head>		<meta charset="UTF-8">
        <title>Gestion des auteurs
        </title>    <link rel="stylesheet" href="css/bootstrap.min.css">  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>

<body>  <div class="container">
<div class="page-header">
<h2>Créer un auteur</h2>
</div>
<form class="form-horizontal" role="form" method="post" action="ca.php">
<div class="form-group">
<label for="firstName" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Prénom</label>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ex : Patricia">
</div>
</div>
	<div class="form-group">			<label for="lastName" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Nom</label>			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">				<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ex : Cornwell">			</div>		</div>		<div class="form-group">			<div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">				<button type="submit" name="submit" id="submit" class="btn btn-primary">Créer</button>			</div>		</div>	</form>		<div class="row">		<div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">			<p>Nombre de livres lus : <em class="text-success"><? echo $nbLu['livre']; ?></em><br /></p>			<p>Nombre de livres non lus : <em class="text-danger"><? echo $nbNonLu['livre']; ?></em></p>			<p>Nombre d'auteurs : <? echo $nbAuteur['auteur']; ?></p>		</div>	</div>




<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<h3>Livres à rendre dans les 14 prochains jours : </h3>
<ul>

<?
while ($nbLivreARendre = mysql_fetch_array($livreARendre)){
        echo '<li>'.$nbLivreARendre['titreLivre'].' ('.date("d/m/Y", strtotime($nbLivreARendre['dateFin'])).')</li>';
}
if ($nbLivreARendre == FALSE){
    echo '<li>Aucun</li>';
}
?>
</ul>
</div>
</div>


    	  	<div class="page-header">		<h2>Auteurs déja enregistrés</h2>	</div>	<table class="table table-hover"><thead><tr><td><abbr title="Trier les auteurs par leur Prénom"><a href="auteurs.php?sort=prenom">Prénom</a></abbr></td><td><abbr title="Trier les auteurs par leur Nom"><a href="auteurs.php?sort=nom">Nom</a></abbr></td><td>Livres</td><td>Modifier</td><td>Supprimer</td></tr></thead><? while ($txt = mysql_fetch_array($auteurs)){?><tr><td><a href="livres.php?id=<? echo $txt['idAuteur']; ?>"><? echo $txt['prenomAuteur']; ?></a></td><td><a href="livres.php?id=<? echo $txt['idAuteur']; ?>"><? echo $txt['nomAuteur']; ?></a></td><td><?php if($txt['livresLus']>=0){ echo '<abbr title="Nombre de livres lus"><button type="button" class="btn btn-success">'.$txt['livresLus'].'</button></abbr> '; } if($txt['livresNonLus']>=0){ echo ' <abbr title="Nombre de livres non lus"><button type="button" class="btn btn-danger">'.$txt['livresNonLus'].'</button></abbr>'; } ?></td><td><a href="#" ><img src="img/b_edit.png" style="border:0;" /></a></td><td><a href="mod.php?idA=<? echo $txt['idAuteur']; ?>" ><img src="img/b_drop.png" style="border:0;" /></a></td></tr><?} ?></table>	<div class="row">		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="home.php"><button type="button" class="btn btn-default">Retour à l'accueil</button></a></div>	</div>	  </div>
	<!-- js -->	<script src="http://code.jquery.com/jquery.js"></script>	<script src="js/bootstrap.min.js"></script>
</body>

</html>