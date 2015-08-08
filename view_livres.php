<?php
include("includes/configure.php");
    $id = $_GET["id"];
   $auteur=mysql_query("select * from auteur where idAuteur=".$id);
   $result=mysql_fetch_array($auteur);
   $livres=mysql_query("select * from livre L where L.idAuteur=".$id." ORDER BY L.titreLivre ASC") or die (mysql_error());
   ?>

<!DOCTYPE html><html> <head>    <meta charset="UTF-8">
        <title>Gestion des livres de <? echo $result['prenomAuteur'].' '.$result['nomAuteur']; ?>
    </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>

<body>  <div class="container"> <div class="page-header">   <h2>Ajouter/Modifier les livres de <? echo $result['prenomAuteur'].' '.$result['nomAuteur']; ?></h2>  </div>    <table class="table table-hover"><thead><tr><td>Titre</td><td>Date d'emprunt</td><td>Date de retour</td><td>Note</td></tr></thead><? while ($txt = mysql_fetch_array($livres)){?><tr <?php if ($txt['etatLivre']=="oui"){ echo'class="success"'; }else{ echo'class="danger"'; } ?>><td><?php echo $txt['titreLivre']; ?></td><td><?php if(isset($txt['dateDebut'])&& ($txt['dateDebut'] != "0000-00-00") && ($txt['dateDebut'] != "1970-01-01")){    $dateD = date("d/m/Y", strtotime($txt['dateDebut']));   echo $dateD;  }else{    echo 'Non disponible';  }?></td><td><?php   if(isset($txt['dateFin'])&& ($txt['dateFin'] != "0000-00-00") && ($txt['dateFin'] != "1970-01-01")){    $dateF = date("d/m/Y", strtotime($txt['dateFin']));   echo $dateF;  }else{    echo 'Non disponible';  }?></td><td><?php if($txt['note'] < 6){   for($i=1;$i<=$txt['note'];$i++){      echo "<i class='glyphicon glyphicon-star'></i>";    }   for($j=5;$j>$txt['note'];$j--){     echo "<i class='glyphicon glyphicon-star-empty'></i>";    } }else{    echo "Non noté";  }?></td></tr><?/*href="sup.php?idL=<? echo $txt['idLivre']; ?>"*/} ?></table>  <div class="row">   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="view_auteurs.php"><button type="button" class="btn btn-default">Retour à la page des auteurs</button></a></div>  </div>    </div>
  <!-- js --> <script src="js/bootstrap-rating-input.min.js" type="text/javascript"></script> <script src="http://code.jquery.com/jquery.js"></script>  <script src="js/bootstrap.min.js"></script>
</body>

</html>