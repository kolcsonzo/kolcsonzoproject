<!DOCTYPE html>

<html>
<?php
		require('db.php');
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($con, $query) or die(mysql_error());
		$row = mysqli_fetch_assoc($result);
?>
<head>
	<meta charset="utf-8">
	<title>Eszköznyilvántartó és kölcsönző rendszer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/cc6376bd80.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i|PT+Sans|Roboto&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="styles/main_styles.css">
</head>
<body>

	<div class="grid-container">
		<header>
			<span class="header-information-text logo">logó vagy valami</span>	
			<span class="header-information-text login">Bejelentkezve: 
			<?php  echo $row['username'];
					if ($row['role'] == 1) {
					echo ' (Munkatárs)';
					} else {
					echo ' (Vezető)';	
					}
			?>
			</span></br>
			<span class="header-information-text login"><p><a href="logout.php">Kijelentkezés!</a></p></span>
		</header>
		<nav>
			<ul id="nav">
				<li id="nav"><a href="foglalas.php">Foglalás</a></li>
				<li id="nav"><a href="#news">Eszközlista</a></li>
			<?php
					if ($row['role'] == 2) {
					echo '<li id="nav"><a href="useradd.php">Felhasználó felvétele</a></li>';
				}
			?>
				<li id="nav2"><a class="nav" href="#about">Impresszum</a></li>
			</ul>
		</nav>
