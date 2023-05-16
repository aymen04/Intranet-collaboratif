<?php
 $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

 $resultat = $dbh->query('SELECT SUM(prix) AS total_price FROM prestations');

 // Récupération du résultat
 $donnees = $resultat->fetch();
 
 $total_price = $donnees['total_price'];

?>