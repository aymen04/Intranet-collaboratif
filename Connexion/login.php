<?php 
 //Nous allons démarrer la session avant toute chose
   session_start() ;
  if(isset($_POST['boutton-valider'])){ // Si on clique sur le boutton , alors :
    //Nous allons verifiér les informations du formulaire
    if(isset($_POST['email']) && isset($_POST['mdp'])) { //On verifie ici si l'utilisateur a rentré des informations
      //Nous allons mettres l'email et le mot de passe dans des variables
      $email = $_POST['email'] ;
      $mdp = $_POST['mdp'] ;
      $erreur = "" ;
       //Nous allons verifier si les informations entrée sont correctes
       //Connexion a la base de données
       $nom_serveur = "localhost";
       $utilisateur = "root";
       $mot_de_passe ="root";
       $nom_base_données ="team" ;
       $con = mysqli_connect($nom_serveur , $utilisateur ,$mot_de_passe , $nom_base_données);
       //requete pour selectionner  l'utilisateur qui a pour email et mot de passe les identifiants qui ont été entrées
        $req = mysqli_query($con , "SELECT * FROM utilisateurs WHERE email = '$email' AND mdp ='$mdp' ") ;
        $num_ligne = mysqli_num_rows($req) ;//Compter le nombre de ligne ayant rapport a la requette SQL
        if($num_ligne > 0){
            // récupérer le type d'utilisateur depuis la base de données
            $row = mysqli_fetch_assoc($req);
            $type = $row['type'];
            // rediriger l'utilisateur vers la page d'accueil
            header("Location:../Dashboard/index.php") ;
            // stocker l'email et le type de l'utilisateur dans la session
            $_SESSION['email'] = $email ;
            $_SESSION['type'] = $type;
        } else {
            $erreur = "Adresse Mail ou Mots de passe incorrectes !";
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body style="background-color: #df6228">
   <section>
       <h1> Connexion</h1>
       <?php 
       if(isset($erreur)){// si la variable $erreur existe , on affiche le contenu ;
           echo "<p class= 'Erreur'>".$erreur."</p>"  ;
       }
       ?>
       <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
           <label>Adresse Mail</label>
           <input type="text" name="email">
           <label >Mots de Passe</label>
           <input type="password" name="mdp">
           <input type="submit" value="Valider" name="boutton-valider" style="color: #df6228;
    background: white;"> 
       </form>
   </section> 
</body>
</html>