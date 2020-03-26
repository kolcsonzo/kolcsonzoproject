<!DOCTYPE html>

<html>
<?php
		require('db.php');
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($con, $query) or die(mysql_error());
		$userinfo = mysqli_fetch_assoc($result);
?>
<head>
	<meta charset="utf-8">
	<title>Eszköznyilvántartó és kölcsönző rendszer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/cc6376bd80.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/jquery.meow.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/table_styles.css">
	<link rel="stylesheet" href="styles/jquery.meow.css">
	<link rel="stylesheet" href="styles/main_styles.css">
	<link rel="stylesheet" href="styles/mobile_styles.css">
	
	<!-- Tagok kezelésénél használt oldalbetöltő script. -->
	<script type="text/javascript">
		function openPage(pageName) {
			if (pageName == 'user-add') {
				document.getElementById("user-add").style.display = "block";
				document.getElementById("user-delete").style.display = "none";				
			}
			else if (pageName == 'user-delete'){
				document.getElementById("user-add").style.display = "none";
				document.getElementById("user-delete").style.display = "block";
			}
		}
	<!-- Ez a script frissíti le a taglistát, és töröl az adatbázisból. Átadja a szerepkört(a jogosultság ellenőrzése miatt) és a törlendő felhasználó nevét a query-nek -->
		function teszt(role, target)
		{
		   $.ajax({url:"userlist_query_delete.php", type:"POST", data: ({role: role, target: target}), async:true, cache:false, success:function(result)
		{
			 $("#delete_q").html(result);
		}});

		};
	</script>
</head>
<body>
	<div class="grid-container">
		<header>
			<ul id="header-pos">
				<div>
					<img src="img/logo.png">
					<span>Eszköznyilvántartó<br>és kölcsönző rendszer</span>
				</div>
				<div class="circle"></div>
				<li class="position2"><a href="logout.php">
					<svg class="fas fa-sign-out-alt logout"></svg></a>
				</li>
				<li class="position2">
					<span class="position2">
						<svg class="fas fa-user-check logged-in"></svg>
						<?php  echo $userinfo['username'];
							if ($userinfo['role'] == 1) {
							echo ' <i>(Munkatárs)</i>';
							} else {
							echo ' <i>(Vezető)</i>';	
							}
						?>	
					</span>
				</li>
			</ul>
		</header>
		<nav>
			<label for="mobile-menu" class="mobile-menu-button">
				<span></span>
				<span></span>
				<span></span>	
			</label>
			<input type="checkbox" id="mobile-menu">
			<ul id="nav">
				<li id="nav"><a href="foglalas.php">Foglalás</a></li>
				<li id="nav"><a href="eszkozok.php">Eszközlista</a></li>
					<?php
							if ($userinfo['role'] == 2) {
							echo '<li id="nav"><a href="useradd.php">Felhasználók kezelése</a></li>';
						}
					?>
				<li id="nav2"><a href="#bottom">Impresszum</a></li>
			</ul>
		</nav>