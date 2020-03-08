<?php
	header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bejelentkezés - Eszköznyilvántartó és kölcsönző rendszer</title>
	<script src="https://kit.fontawesome.com/cc6376bd80.js" crossorigin="anonymous"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i|PT+Sans|Roboto&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="styles/login_styles.css">
</head>
<body>
<?php
echo '
	<div class="grid-container-login">
		<main>
			<article id="login">
				<div id="information">
					<span style="font-size: 30px; color: #26ACDE;">
						<i class="fas fa-info-circle"></i>		
					</span>
					<span class="tooltiptext">
						Regisztrációs szándék esetén forduljon a rendszergazdához!	
					</span>
				</div>
				<form name="login" id="" method="post">
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
        } else {
			//Hibaüzenet
            echo '<h4 style="color:#f19999">Hibás felhasználónév vagy jelszó!</h4><br/>';
        }
    }
?>
			</article>
		</main>
	</div>
</body>
</html>