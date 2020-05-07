<?php
	header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bejelentkezés - Eszköznyilvántartó és kölcsönző rendszer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i|PT+Sans|Roboto&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/cc6376bd80.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="styles/login_styles.css">
</head>
<body>
<?php
//Ipcím lekéréshez - stackoverflow-ról..
 function get_client_ip()
 {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';

      return $ipaddress;
 }

echo '
	<div class="grid-container-login">
		<main>
				<div id="information">
					<span style="font-size: 30px; color: #26ACDE;">
						<i class="fas fa-info-circle"></i>		
					</span>
					<span class="tooltiptext">
						Regisztrációs szándék esetén forduljon a rendszergazdához!	
					</span>
				</div>
				<form name="login" id="" method="post" autocomplete="off">
				<span class="text">BEJELENTKEZÉS</span><br>
					<input type="text" id="username" name="username" placeholder="Felhasználónév">
					<br>
					<input type="password" id="password" name="password" placeholder="Jelszó"><br>
					<button class="button">Bejelentkezés</button>
				</form>
			';
			require('db.php');
			session_start();
			//Form elküldés után
			if (isset($_POST['username'])) {
				$username = stripslashes($_REQUEST['username']);
				$username = mysqli_real_escape_string($con, $username);
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($con, $password);
				// Létezik -e a user
				$query    = "SELECT * FROM `users` WHERE username='$username'
							 AND password='" . md5($password) . "'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
				if ($rows != 0) {
					$_SESSION['username'] = $username;
					// Van ilyen user és jó a pw
					header("Location: foglalas.php");
//------------------------------------------------------------NAPLÓZÁS------------------------------------------------------------------------------------------
											$ipaddress = get_client_ip();
											$query    = "INSERT INTO events (event, user)
											 VALUES ('Felhasználó bejelentkezés: $username | IP: $ipaddress', '$username')";
								$execute   = mysqli_query($con, $query) or die(mysql_error());
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
				} else {
					//Hibaüzenet
					echo 	'<div id="alert" class="alertpos alert alert-danger alert-dismissible fade show">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Figyelem!</strong> Hibás felhasználónév vagy jelszó!
							</div>';
						}
			}
?>
		</main>
	</div>
</body>
</html>