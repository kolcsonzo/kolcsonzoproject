<?php
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
	<article>
		<span class="text">Felhasználó hozzáadása</span><br>	
		<form action="" id="" method="post">
			<label for="username">Felhasználónév:</label>
			<input type="text" style="float:right" id="username" name="username" required placeholder="">
			<br>
			<label for="full_name">Teljes név:</label>
			<input type="text" style="float:right" id="full_name" name="full_name" required placeholder="">
			<br>
			<label for="email">E-mail:</label>
			<input type="mail" style="float:right" id="email" name="email" required placeholder="">
			<br>
			<label for="password">Jelszó:</label>
			<input type="password" style="float:right" id="password" name="password" required placeholder="">
			<br>
			<label for="role">Szerepkör:</label>
			  <select style="float:right" id="role" name="role">
				<option value="2">Vezető</option>
				<option value="1">Munkatárs</option>
			  </select>
			<br>			
			<button class="button">Hozzáadás</button>
			
			<?php
    require('db.php');
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
		$full_name = stripslashes($_REQUEST['full_name']);
		$full_name = mysqli_real_escape_string($con, $full_name);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
		$role = stripslashes($_REQUEST['role']);
		$role = mysqli_real_escape_string($con, $role);
        $create_datetime = date("Y-m-d H:i:s");
		
		//Ellenőrizzük van -e már ilyen
		$query    = "SELECT * FROM users WHERE username='$username'";
		$result   = mysqli_query($con, $query);
	    $rows = mysqli_num_rows($result);
        if ($rows != 0) {
		  echo "<h4>Ilyen felhasználó már van a rendszerben!</h4>";
		} else {

		//Ha nincs, akkor mehet
        $query    = "INSERT into `users` (username, full_name, email, password, role, create_datetime)
                     VALUES ('$username', '$full_name', '$email','" . md5($password) . "', '$role', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<h4>Sikeres regisztráció!</h4></b>
				  <h4><b>".$full_name."</b> hozzáadva!</h4>";
        } else {
           echo "<h4>A regisztráció nem sikerült!</h4>";
			} 
		}
	}
			?>
		</form>	
	</article>
</main>

<?php
	include('inc/bottom.php');
?>