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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/cc6376bd80.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i|PT+Sans|Roboto&display=swap" rel="stylesheet"> 
	<link href="styles/table_style.css" rel="stylesheet">
	<script type="text/javascript" src="js/js.js"></script>
	<link rel="stylesheet" href="styles/main_styles.css">
	<script>
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
	</script>
	<!-- Ez a script frissíti le a taglistát, és töröl az adatbázisból. Átadja a szerepkört(a jogosultság ellenőrzése miatt) és a törlendő felhasználó nevét a query-nek -->
	<script type="text/javascript">
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
				<li class="position">logó vagy valami</li>
				<li class="position2"><a href="logout.php">
					<i class="fas fa-sign-out-alt logout"></i></a>
				</li>
				<li class="position2">
					<span class="position2">
						<i class="fas fa-user-check logged-in"></i>
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
			<ul id="nav">
				<li id="nav"><a href="foglalas.php">Foglalás</a></li>
				<li id="nav"><a href="eszkozok.php">Eszközlista</a></li>
				<?php
						if ($userinfo['role'] == 2) {
						echo '<li id="nav"><a href="useradd.php">Felhasználók kezelése</a></li>';
					}
				?>
				<li id="nav2"><a class="nav" href="#about">Impresszum</a></li>
			</ul>
		</nav>