<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="/Dashboard/style.css">

	<title>AdminHub</title>
</head>
<body>
	


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile' style="color:#df6228"></i>
			<img src="./img/logo.png" class="text" style="height: 127%; margin: auto;"></img>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="./index.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' style="color:#df6228" ></i>
					<span class="text" style="color:#df6228">My Store</span>
				</a>
			</li>
			<li>
				<a href="./tasks.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Tasks</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<form method="post">
			<li>
			<a href="../Connexion/login.php?logout=true">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text" onclick="logout()">Logout</span>
				</a>
			</li>
		</form>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn" style="background-color:#df6228"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" style="color:#df6228" hidden>
			<label for="switch-mode" class="switch-mode" style="background-color:#df6228"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' style="color:#df6228" ></i>
				
			</a>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>My Store</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#" style="color:#df6228">Store</a>
						</li>
					</ul>
				</div>
				
			</div>

          

            <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Orders</h3>
						<i class='bx bx-search' ></i>
                        <a href="./admin.php">
						<i class='bx bx-plus'></i>
                    </a>
					</div>
                    <div>
					<table class="TeamTable" style="text-align: center">
        <tr>
            
            <td>Companies</td>
            <td>Project category</td>
			<td>details</td>
            <td>Delete</td>
            
            
			
        </tr>

            <?php
session_start();

$dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

    foreach($dbh->query("SELECT * FROM projets")as $row) { ?>
        <tr>
            
            <td><?php echo $row['nom_entreprise'];?></td>
            <td><?php echo $row['categorie_projet'];?></td>
			<td><?php echo $row['details'];?></td>
   

</td>

<td>
            <form action ="admin.php" method="post">
                <input type ="hidden" name="idp" value="<?php echo $row['idp'] ?>">
                <input type ="hidden" name="what" value="name">
                <input type ="submit" name="deletep" value="Delete" class="deletep" style="border: none ;color: #df6228;     background-color: inherit;">

            </form>
            </td>

         </tr>


<?php } ?>
</table>
					
				</div>

			
	<!-- CONTENT -->
	<?php


// Vérifiez si le lien de déconnexion a été cliqué
if (isset($_GET['logout'])) {
    // Détruisez toutes les données de session enregistrées
    session_destroy();
    // Redirigez l'utilisateur vers la page de connexion ou d'accueil
    header("Location: ../Connexion/login.php");
}
?>
	

	<script src="script.js"></script>
</body>
</html>