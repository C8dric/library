<?php
session_start();
include("includes/configure.php");
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

$idL=$_GET['idL'];

// Supprime le lien
$reqSup = "Delete from livre where idLivre='$idL'";
$suppression = mysql_query($reqSup);
//Utilisation
redirect("auteurs.php","2");
?>
 

</body>
</html>

