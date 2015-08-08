<?php 
include("includes/configure.php");
session_start();
accessverif();


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


?> 

<? // Connection a la BD

$idA=$_GET['idA'];

// Supprime le lien
$suppAuteur = "Delete from auteur where idAuteur='$idA'";
$suppressionAuteur = mysql_query($suppAuteur);

//Utilisation
redirect("auteurs.php","2");
?>
 
</body>
</html>