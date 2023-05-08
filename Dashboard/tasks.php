<!DOCTYPE html>
<html lang="en" dark>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/Dashboard/style.css">



    <title>Document</title>
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
				<a href="./store.php">
					<i class='bx bxs-shopping-bag-alt' style="color:#df6228" ></i>
					<span class="text" style="color:#df6228">My Store</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Tasks</span>
				</a>
			</li>
			
			<li>
				<a href="./team.php" href="#">
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
					<h1>Tasks</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#" style="color:#df6228">Tasks</a>
						</li>
					</ul>
				</div>
				
			</div>

            <?php
$dbh = new PDO('mysql:host=localhost:8889;dbname=team', 'root', 'root');

if(isset($_POST['submit'])) {
    $ida = $_POST['ida'];
    $new_statut = $_POST['statut'];
    $stmt = $dbh->prepare("UPDATE a_faire SET statut=:statut WHERE ida=:ida");
    $stmt->bindParam(':ida', $ida);
    $stmt->bindParam(':statut', $new_statut);
    $stmt->execute();
}



foreach ($dbh->query("SELECT * FROM a_faire") as $row) { ?>

    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $row['mission']; ?></h5>
        <p class="card-text"><?php echo $row['détails']; ?></p>
        <p class="card-time"><?php echo $row['temps']; ?></p>
        <form method="POST">
            <input type="hidden" name="ida" value="<?php echo $row['ida']; ?>">
            <label for="statut">Statut:</label>
            <select name="statut" id="statut">
                <option value="à faire" <?php echo $row['statut'] == 'à faire' ? 'selected' : ''; ?>>À faire</option>
                <option value="fait" <?php echo $row['statut'] == 'fait' ? 'selected' : ''; ?>>Fait</option>
            </select>
            <button type="submit" name="submit">Edit</button>
        </form>
    </div>
</div>


<?php
}
?>
</main>
        <!-- MAIN -->
</section>
<style>
    .card {
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin: 20px;
  position: relative;
}

.card-body {
  border-bottom: 1px solid #df6228;
}

.card-title {
  font-size: 24px;
  margin-bottom: 10px;
}

.card-text {
  font-size: 16px;
  line-height: 1.5;
  margin-bottom: 20px;
}

.card-time {
  font-size: 11px;
  line-height: 1.5;
  margin-bottom: 20px;
  text-align: end;
}
form {
  flex-direction: column;
  align-items: center;
  font-family: Arial, sans-serif;
  bottom: 0;
  right: 0;
}

label {
  font-weight: bold;
}

select {
  padding: 5px;
  margin: 10px 0;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  width: 200px;
}

button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px 0;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}



</style>














<script src="script.js"></script>

</body>
</html>