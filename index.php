<?php
session_start();
include("includes/configure.php");

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

	$message=$_GET['message'];
	$msg_erreur = array('1'=>'Un champ a été oublié !',
						'2'=>'Login ou mot de passe incorrect',
						'3'=>'Erreur d\'accès',
						'4'=>'Vous avez été deconnecté',
						'5'=>'Merci de votre visite, a bientot'
						);

	if(isset($_POST['submit'])){
	
		$log = mysql_real_escape_string($_POST['login']);
		$pass = mysql_real_escape_string($_POST['pass']);
		
		if(!isset($pass) || !isset($log) || $log=='' || $pass==''){
				
				$message = 1;
				
		}else{
				//Protection pour ne pas retrouver le mdp dans un annuaire md5
				$fin = "-petitlapin2012";	
					
			$sql = $db->query('Select * from user WHERE loginUser="'.$log.'" AND passUser="'.md5($pass.$fin).'"');
			//$req = mysql_query($sql) or die("Erreur selection identifiants".mysql_error());
			
			if(mysql_num_rows($sql) == 0) {
				$message=2;
			}else if(mysql_num_rows($req) >1) {
				
				
			}else{
				
				$data = mysql_fetch_array($sql);
				$idBDD= $data['idUser'];
				//echo $idBDD." chargement";
				//session_start();
				
				$_SESSION['idBDD']= $idBDD;
				
				mysql_query("UPDATE user set last_action=".time()." where idUser=".$_SESSION['idBDD']) or die("Erreur mise a jour time".mysql_error());

				redirect("home.php","1");
				//header("Location: home.php");					
				
			}
	
			
		}
			
	}



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  <title>BackOffice</title>
  <!-- <link type="text/css" href="./css/style.css" rel="stylesheet" /> -->
  <!--[if lte IE 6]>
    <link type="text/css" href="./css/style_ie6.css" rel="stylesheet" />
  <![endif]-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div id="page">

  <!-- content -->
  <div class="container">
  
	<div class="page-header">
		<h1>Bibliotheque ARNOULD</h1>
	</div>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4"><img src="img/logo1.png" alt="bibliotheque" class="img-responsive" title="bibliotheque"></div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php if(isset($msg_erreur[$message])){ if($message==5){?><div class="alert alert-success"><?php }else{ ?><div class="alert alert-danger"><?php } echo $msg_erreur[$message]; ?></div><?php } ?></div>
	</div>
	<form class="form-horizontal" role="form" method="post" name="form_compte" id="form_compte">
		<div class="form-group">
			<label for="login" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Login</label>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<input type="text" class="form-control" id="login" name="login" placeholder="Login">
			</div>
		</div>
		<div class="form-group">
			<label for="pass" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Password</label>
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
				<button type="submit" name="submit" id="submit" class="btn btn-primary">Se connecter</button>
			</div>
		</div>
	</form> 

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="view_auteurs.php"><button type="button" class="btn btn-default">Consulter la bibliothèque</button></a></div>
	</div>

	<!-- js -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>

</html>