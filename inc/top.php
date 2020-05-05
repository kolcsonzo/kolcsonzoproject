<!DOCTYPE html>

<html>
<?php
		include("auth_user.php")
?>
<head>
	<meta charset="utf-8">
	<title>Eszköznyilvántartó és kölcsönző rendszer</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://kit.fontawesome.com/cc6376bd80.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/jquery.meow.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
		};
		function group_of_devices() {
			if (document.getElementById("getGroupOfDevices").value == 'other') {
				document.getElementById("group_of_devices").style.display = "block";
			}
			else {
				document.getElementById("group_of_devices").style.display = "none";
			}
		};
	<!-- Ez a script frissíti le a taglistát, és töröl az adatbázisból. Átadja a törlendő felhasználó nevét a query-nek -->
		function user_delete(target)
		{
		   $.ajax({url:"userlist_query_delete.php", type:"POST", data: ({target: target}), async:true, cache:false, success:function(result)
		{
			 $("#delete_q").html(result);
		}});

		};
		<!-- Foglaláshoz szükséges script -->
		
		function foglalas(eszkoz, id, idotartam)
		{
		   $.ajax({url:"foglalas_query.php", type:"POST", data: ({eszkoz: eszkoz, id: id, idotartam: idotartam}), async:true, cache:false, success:function(result)
		{
			 $("#foglalas_result").html(result);
		}});

		};
		<!-- Foglalásaim listázásához szükséges script -->
		
		function foglalasaim(foglalas_id)
		{
		   $.ajax({url:"foglalasaim_query.php", type:"POST", data: ({foglalas_id: foglalas_id}), async:true, cache:false, success:function(result)
		{
			 $("#foglalasaim_result").html(result);
		}});

		};
		<!-- Eszköz törlés -->
		
		function eszkoz_torles(eszkoz_id)
		{
		   $.ajax({url:"eszkoz_torles_query.php", type:"POST", data: ({eszkoz_id: eszkoz_id}), async:true, cache:false, success:function(result)
		{
			 $("#eszkozkezelo_result").html(result);
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
				<li id="nav"><a href="foglalasaim.php">Foglalásaim</a></li>
				<li id="nav"><a href="eszkozkezelo.php">Eszközkezelő</a></li>
					<?php
							if ($userinfo['role'] == 2) {
							echo '<li id="nav"><a href="useradd.php">Felhasználók kezelése</a></li>';
						}
					?>
				<li id="nav"><a href="naplozas.php">Naplózás</a></li>
				<li id="nav2"><a href="#bottom">Impresszum</a></li>
			</ul>
		</nav>