<?php
 $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

 $resultat = $dbh->query('SELECT COUNT(*) AS total_users FROM utilisateurs');

 // Récupération du résultat
 $donnees = $resultat->fetch();
 
 $total_users = $donnees['total_users'];

?>