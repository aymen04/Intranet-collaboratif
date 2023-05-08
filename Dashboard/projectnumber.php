<?php
session_start();
 $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

 $resultat = $dbh->query('SELECT COUNT(*) AS total_commandes FROM projets');

 // Récupération du résultat
 $donnees = $resultat->fetch();
 
 $total_commandes = $donnees['total_commandes'];

?>