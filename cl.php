<?php
include("includes/configure.php");
session_start();
accessverif();

$read = $_POST["read"];
$titre = $_POST["livre"];
$auteur= $_POST["auteur"];
$note= $_POST["rating"];
$array_dde_fr=explode("/",$_POST["dde"]);
$dde = $array_dde_fr[2]."-".$array_dde_fr[1]."-".$array_dde_fr[0];
$array_dfe_fr=explode("/",$_POST["dfe"]);
$dfe = $array_dfe_fr[2]."-".$array_dfe_fr[1]."-".$array_dfe_fr[0];
$dateC = date('Y-m-d');
$titre = mysql_real_escape_string($titre);
//$dateDebut = $array_dde_fr[2]."-".$array_dde_fr[1]."-".$array_dde_fr[0];
	//echo $dateDebut;

	$query="INSERT INTO livre (`idLivre`, `titreLivre`, `etatLivre`, `idAuteur`, `note` , `dateDebut`, `dateFin`, `dateCreation`) VALUES (NULL, '$titre', '$read', '$auteur', '$note', '$dde', '$dfe', '$dateC')";	//echo $query;
$result = mysql_query($query);







	function redirect($url, $time=3)
{
   //On vÈrifie si aucun en-tÍte n'a dÈj‡ ÈtÈ envoyÈ
   if (!headers_sent())
   {
     header("refresh: $time;url=$url");
     exit;
   }
   else
   {
     echo '<meta http-equiv="refresh" content="',$time,';url=',$url,'">';
   }
}

//Utilisation
redirect("livres.php?id=".$auteur,"2");
?>