
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
				<a href="#">
					<i class='bx bxs-dashboard' style="color:#df6228"></i>
					<span class="text" style="color:#df6228">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="./store.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li>
				<a href="./tasks.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Tasks</span>
				</a>
			</li>
			
			<li>
				<a href="./team.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#" style="color:#df6228">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php  include('projectnumber.php'); echo $total_commandes; ?></h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php  include('usernumber.php'); echo $total_users; ?></h3>
						<p>Users</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data" style="display: grid;">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<div>
					<table class="TeamTable" style="text-align: center">
        <tr>
            
            <td>Companies</td>
            <td>Category</td>
			<td>Details</td>
        
			
        </tr>

            <?php

$dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

    foreach($dbh->query("SELECT * FROM projets")as $row) { ?>
        

		<ul class="todo-list">
		<li class="completed" style="border-left: solid 10px #df6228;">

            <td><?php echo $row['nom_entreprise'];?></td>
            <td><?php echo $row['categorie_projet'];?></td>
			<td><?php echo $row['details'];?></td>
			</li>
			</ul>
			


<td>
            <form action ="admin.php" method="post">
                <input type ="hidden" name="idp" value="<?php echo $row['idp'] ?>">
                <input type ="hidden" name="what" value="name">

            </form>
            </td>

         </tr>


<?php } ?>
</table>
					
				</div>

				</div>
				<?php

$dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

    foreach($dbh->query("SELECT * FROM a_faire")as $row)  ?>
				
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<?php foreach($dbh->query("SELECT * FROM a_faire")as $row){  ?>
						<li class="completed" style="border-left: solid 10px #df6228;">
							<p><?php echo $row['mission'];?></p>
							<p><?php echo $row['temps'];?></p>
							<p style="<?php echo $row['statut'] == 'à faire' ? 'color:#df6228;' : 'color:green;' ?>"><?php echo $row['statut'];?></p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<?php } ?>
					</ul>
				</div>
		</main>
		<!-- MAIN -->
		</section>
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