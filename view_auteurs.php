<?php
include("includes/configure.php");

    switch ($_GET["sort"]) {
    case "prenom":
        $auteurs=mysql_query("SELECT DISTINCT A.idAuteur, A.nomAuteur, A.prenomAuteur, COUNT( DISTINCT (L1.idLivre) ) AS livresLus, COUNT( DISTINCT (L2.idLivre) ) AS livresNonLus              FROM auteur A               LEFT JOIN livre L1 ON A.idAuteur = L1.idAuteur              AND L1.etatLivre =  'oui'               LEFT JOIN livre L2 ON A.idAuteur = L2.idAuteur              AND L2.etatLivre =  'non'               GROUP BY A.idAuteur             ORDER BY prenomAuteur ASC");
        break;
    case "nom":
        $auteurs=mysql_query("SELECT DISTINCT A.idAuteur, A.nomAuteur, A.prenomAuteur, COUNT( DISTINCT (L1.idLivre) ) AS livresLus, COUNT( DISTINCT (L2.idLivre) ) AS livresNonLus              FROM auteur A               LEFT JOIN livre L1 ON A.idAuteur = L1.idAuteur              AND L1.etatLivre =  'oui'               LEFT JOIN livre L2 ON A.idAuteur = L2.idAuteur              AND L2.etatLivre =  'non'               GROUP BY A.idAuteur     ORDER BY nomAuteur ASC");
        break;
    case "id":
        $auteurs=mysql_query("select * from auteur ORDER BY idAuteur ASC");
        break;
    default:
       $auteurs=mysql_query("SELECT DISTINCT A.idAuteur, A.nomAuteur, A.prenomAuteur, COUNT( DISTINCT (L1.idLivre) ) AS livresLus, COUNT( DISTINCT (L2.idLivre) ) AS livresNonLus               FROM auteur A               LEFT JOIN livre L1 ON A.idAuteur = L1.idAuteur              AND L1.etatLivre =  'oui'               LEFT JOIN livre L2 ON A.idAuteur = L2.idAuteur              AND L2.etatLivre =  'non'               GROUP BY A.idAuteur             ORDER BY nomAuteur ASC");
}

    $lu=mysql_query("select count(idLivre) as livre from livre WHERE etatLivre='oui'");
    $nbLu = mysql_fetch_array($lu);

    $nonLu=mysql_query("select count(idLivre) as livre from livre WHERE etatLivre='non'");
    $nbNonLu = mysql_fetch_array($nonLu);

    $auteur=mysql_query("select count(idAuteur) as auteur from auteur");
    $nbAuteur = mysql_fetch_array($auteur);

    $i=0;

    ?>
<!DOCTYPE html><html>   <head>      <meta charset="UTF-8">
        <title>Gestion des auteurs
        </title>    <link rel="stylesheet" href="css/bootstrap.min.css">  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>

<body>  <div class="container"> <div class="row">       <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">           <p>Nombre de livres lus : <em class="text-success"><? echo $nbLu['livre']; ?></em><br /></p>            <p>Nombre de livres non lus : <em class="text-danger"><? echo $nbNonLu['livre']; ?></em></p>            <p>Nombre d'auteurs : <? echo $nbAuteur['auteur']; ?></p>       </div>  </div>          <div class="page-header">       <h2>Auteurs déja enregistrés</h2>   </div>  <table class="table table-hover"><thead><tr><td><abbr title="Trier les auteurs par leur Prénom"><a href="view_auteurs.php?sort=prenom">Prénom</a></abbr></td><td><abbr title="Trier les auteurs par leur Nom"><a href="view_auteurs.php?sort=nom">Nom</a></abbr></td><td>Livres</td></tr></thead><? while ($txt = mysql_fetch_array($auteurs)){ if($txt['nomAuteur'] != 'Arnould') {?><tr><td><a href="view_livres.php?id=<? echo $txt['idAuteur']; ?>"><? echo $txt['prenomAuteur']; ?></a></td><td><a href="view_livres.php?id=<? echo $txt['idAuteur']; ?>"><? echo $txt['nomAuteur']; ?></a></td><td><?php if($txt['livresLus']>=0){ echo '<abbr title="Nombre de livres lus"><button type="button" class="btn btn-success">'.$txt['livresLus'].'</button></abbr> '; } if($txt['livresNonLus']>=0){ echo ' <abbr title="Nombre de livres non lus"><button type="button" class="btn btn-danger">'.$txt['livresNonLus'].'</button></abbr>'; } ?></td></tr><?} } ?></table> <div class="row">       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="home.php"><button type="button" class="btn btn-default">Retour à l'accueil</button></a></div> </div>    </div>
    <!-- js --> <script src="http://code.jquery.com/jquery.js"></script>    <script src="js/bootstrap.min.js"></script>
</body>

</html>