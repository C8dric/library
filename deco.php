
    <?
    session_start();
    $_SESSION=array();//on efface toutes les variables de la session
    session_destroy(); // Puis on dŽtruit la session
   header("location: index.php?message=5" ) ; // On renvoie ensuite sur la page d'accueil
    ?>