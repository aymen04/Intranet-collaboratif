<?php
session_start();

if (!isset($_SESSION['type']) || $_SESSION['type'] !== 'Admin') {
    // Si l'utilisateur connecté n'est pas de type admin, rediriger vers une page d'erreur ou une autre page appropriée
    exit('Vous n\'avez pas accès à cette page');
}
   

// Si l'utilisateur connecté est de type admin, afficher le formulaire d'ajout de membre
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./admin.css" rel="stylesheet">
    <title>Admin</title> 
</head>
<body>

    <a href="index.php"">Revenir</a>

<main>
<h1>Ajouter un membre</h1>

         <form action="admin.php" method="post">
       
    <div>
           
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" pattern=".{3,10}" required>
       
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        
            <label for="mdp">Mot de passe:</label>
            <input type="password" name="mdp" id="mdp" pattern=".{3,10}" required>
       
            <label for="mdp2">Confirmation mot de passe :</label>
            <input type="password" name="mdp2" id="mdp2" pattern=".{3,10}" required>
        
        
            <input type="submit" name="ajouter" value="ajouter"></input>
    </div>
</main>
</form>
<main class="pro">
<h1>Ajouter un projet</h1>

         <form action="admin.php" method="post">
       
         <label for="nom_entreprise">Nom de l'entreprise :</label>
  <input type="text" name="nom_entreprise" required><br><br>

  <label for="categorie_projet">Catégorie du projet :</label>
  <select name="categorie_projet" required>
    <option value="">--Choisissez une catégorie--</option>
    <option value="Iélectricité">Electricité</option>
    <option value="Téléphonie">Téléphonie</option>
    <option value="Sécurité">Sécurité</option>
    <option value="Informatique">Informatique</option>
  </select><br><br>

  <label for="details_projet">Détails du projet :</label>
  <textarea name="details" required></textarea><br><br>

  <input type="submit" value="ajouter" name='addproject'>
</form>
</main>



<main class="todo">
<h1>Ajouter une tâche </h1>

         <form action="admin.php" method="post" accept-charset="UTF-8">
       
         <label for="mission">Mission :</label>
  <input type="text" name="mission" required><br><br>

  <label for="detail">Plus :</label>
  <textarea name="detail" required></textarea><br><br>

  <input type="submit" value="ajouter" name='addtodo'>
</form>
</main>



<main class="pres">
<h1>Ajouter une prestation </h1>

         <form action="admin.php" method="post" accept-charset="UTF-8">
       
         <label for="nom">Nom :</label>
  <input type="text" name="nom" required><br><br>

  <label for="prix">Prix :</label>
  <input type="number" name="prix"  id ="prix" step="0.01" required></input><br><br>

  <input type="submit" value="ajouter" name='addpres'>
</form>
</main>

   

    
</body>
</html>



<?php
require_once 'delete.php';
if(isset($_POST['delete'])) {
    $idu = $_POST['idu'];
    deleteUser($idu);
    // Redirection vers la page d'administration après la suppression
    header('Location: team.php');
}

if(isset($_POST['deletep'])) {
    $idp = $_POST['idp'];
    deleteProject($idp);
    // Redirection vers la page d'administration après la suppression
    header('Location: store.php');
}



        



 //je veux ajouter un utilisateur
if(isset($_POST['ajouter'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];
    if($mdp == $mdp2) {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');
        $stmt = $dbh->prepare("INSERT INTO utilisateurs (name, email, mdp , type) VALUES (:name, :email, :mdp ,'User')");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $stmt->execute();
        header('Location: team.php');
    }
    else {
        echo "Les mots de passe ne correspondent pas";
    }
}


// ajouter un projet 
if(isset($_POST['addproject'])) {
    $nom_entreprise = $_POST['nom_entreprise'];
    $categorie_projet = $_POST['categorie_projet'];
    $details = $_POST['details'];
        $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');
        $stmt = $dbh->prepare("INSERT INTO projets (nom_entreprise, categorie_projet, details) VALUES (:nom_entreprise, :categorie_projet, :details )");
        $stmt->bindValue(':nom_entreprise', $nom_entreprise, PDO::PARAM_STR);
        $stmt->bindValue(':categorie_projet', $categorie_projet, PDO::PARAM_STR);
        $stmt->bindValue(':details', $details, PDO::PARAM_STR);
        $stmt->execute();
        header('Location: store.php');
    }



    // ajouter une tache 
    if(isset($_POST['addtodo'])) {
        $mission = $_POST['mission'];
        $detail = $_POST['detail'];
        if(empty($mission) || empty($detail)) {
            echo "Veuillez remplir tous les champs.";
        } else{ 
            $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');
            $stmt = $dbh->prepare("INSERT INTO a_faire (mission, detail, statut) VALUES (:mission, :detail, 'à faire' )");
            $stmt->bindValue(':mission', $mission, PDO::PARAM_STR);
            $stmt->bindValue(':detail', $detail, PDO::PARAM_STR);
            $stmt->execute();
            header('Location: tasks.php');
        }
       
    }

    // ajouter une prestation 
    if(isset($_POST['addpres'])) {
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        if(empty($nom) || empty($prix)) {
            echo "Veuillez remplir tous les champs.";
        } else{ 
            $dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');
            $stmt = $dbh->prepare("INSERT INTO prestations (nom, prix) VALUES (:nom, :prix)");
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
            $stmt->execute();
            header('Location: index.php');
        }
       
    }
    

                  
?>
        