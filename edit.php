<html>
	<head>
		<title></title>
	</head>

<body>
<?php 
function redirect($url, $time=3)
{     
   //On vérifie si aucun en-tête n'a déjà été envoyé    
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
redirect("admin-liens.php","3");
?> 

<? // Connection a la BD
		mysql_connect("localhost", "echosdeclats", "coudert1");
	mysql_select_db("echosdeclats"); 

$id=$_POST['idLien'];

// Supprime le lien
$query = "Delete from liens where idLien='$id'";
$result = mysql_query($query);
?>
 
<? mysql_close(); ?>
</body>
</html>