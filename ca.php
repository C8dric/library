<?php
include("includes/configure.php");
session_start();
accessverif();
	
	
	$nom = $_POST["lastName"];
	$prenom= $_POST["firstName"];
	
//	$nom = utf8_encode($nom);
//	$prenom = utf8_encode($prenom);
	
	
	$query="INSERT INTO auteur (`idAuteur`, `prenomAuteur`, `nomAuteur`) VALUES (NULL, '$prenom', '$nom')";
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
redirect("auteurs.php","2");
?>