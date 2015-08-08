<?php
include("includes/configure.php");
session_start();
accessverif();
	
	
	$read = $_POST["read"];
	$livre= $_POST["livre"];
	
	$auteur = $_POST["auteur"];

	$titre= $_POST["title"];
	
	$note= $_POST["rating"];
	
	$array_dde_fr=explode("/",$_POST["dde"]);
	$dde = $array_dde_fr[2]."-".$array_dde_fr[1]."-".$array_dde_fr[0];
	
	$array_dfe_fr=explode("/",$_POST["dfe"]);
	$dfe = $array_dfe_fr[2]."-".$array_dfe_fr[1]."-".$array_dfe_fr[0];
	
	$dateM = date('Y-m-d');

	
	$query="UPDATE `livre` SET `etatLivre` = '$read', titreLivre = '$titre', note = '$note' , dateDebut = '$dde', dateFin = '$dfe', dateMaj = '$dateM' WHERE `idLivre` ='$livre'";

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