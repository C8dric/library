<?
include("includes/configure.php");
session_start();
accessverif();

$sql = "select * from livre, auteur where livre.idAuteur=auteur.idAuteur ORDER BY nomAuteur ASC";
$idaut1=0;
$idaut2=0;
$result = mysql_query($sql);

$texte = "Prenom;Nom;Titre;Lu\r\n";
	while ($data = mysql_fetch_array($result)) {
	$idaut1 = $data['idAuteur'];
		if($idaut1 == $idaut2){
			$texte .= $data['prenomAuteur'].";".$data['nomAuteur'].";".$data['titreLivre'].";".$data['etatLivre']."\r\n";
		}else{
			$texte .= "\r\n".$data['prenomAuteur'].";".$data['nomAuteur'].";".$data['titreLivre'].";".$data['etatLivre']."\r\n";
		}
	$idaut2 = $data['idAuteur'];
	}
$texte = utf8_decode($texte);


header("Content-Type: application/csv-tab-delimited-table");
header("Content-disposition: inline; filename=liste_livre.csv");
header('Content-type: application/octetstream');
header('Pragma: no-cache');
header('Expires: 0');


echo $texte;
?>