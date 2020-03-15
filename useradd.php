<?php
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Felhasználók kezelése</span>
			<div style="float:right;">
				<button class="button" onclick="openPage('user-add')">Tag felvétel</button>
				<button class="button" name="del" onclick="openPage('user-delete')">Tag törlés</button>
			</div>
		</div>
		<br><br>
		<div class="container">			
				<div id="user-add" class="tabcontent">
					<div class="info">
						<span><strong>Tag felvételéhez</strong> a következő űrlap kitöltése szükséges</span>
					</div>
					<form action="useradd.php" id="add-user-form" method="post" autocomplete="off">
						<br>
						<label for="username">Felhasználónév:</label>
						<input type="text" style="float:right" id="username" name="username" required placeholder="Adja meg a felhasználónevet...">
						<br>
						<label for="full_name">Teljes név:</label>
						<input type="text" style="float:right" id="full_name" name="full_name" required placeholder="Adja meg a teljes nevet...">
						<br>
						<label for="email">E-mail:</label>
						<input type="mail" style="float:right" id="email" name="email" required placeholder="Adja meg az e-mail címet...">
						<br>
						<label for="password">Jelszó:</label>
						<input type="password" style="float:right" id="password" name="password" required placeholder="Adja meg a jelszót">
						<br>
						<label for="role">Szerepkör:</label><br>
						 <select id="role" name="role" class="select">
							<option value="2">Vezető</option>
							<option value="1">Munkatárs</option>
						 </select>
						<br><br><br><br>
						<center><button class="button">Tag felvétele</button></center>
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
								  		echo '<script language="javascript">';
										echo 'alert("'.$full_name.' felhasználó már van az adatbázisban! ")';
										echo '</script>';
								} else {

								//Ha nincs, akkor mehet
								$query    = "INSERT into `users` (username, full_name, email, password, role, create_datetime)
											 VALUES ('$username', '$full_name', '$email','" . md5($password) . "', '$role', '$create_datetime')";
								$result   = mysqli_query($con, $query);
								if ($result) {
										echo '<script language="javascript">';
										echo 'alert("'.$full_name.' regisztrálása sikeresen megtörtént! ")';
										echo '</script>';
								} else {
										echo '<script language="javascript">';
										echo 'alert("'.$full_name.' regisztrálása nem sikerült, kérlek fordulj a rendszergazdához! ")';
										echo '</script>';
									} 
								}
							}
						?>
					</form>
					
			</div>

			<div id="user-delete" class="tabcontent">
			<div class="info">
				<span><strong>Tag törléséhez</strong> használja a megfelelő sor melleti "Törlés" opciót.</span>
			</div>

			<span class="text">Felhasználók</span></br></br>
			<?php
				//while
				echo '<div id="delete_q"></div>'; //ide érkezik vissza a script lefutása utáni kód, tehát az eredmény
				echo '<script type="text/javascript">teszt('.$userinfo['role'].')</script>';
				?>

				
			</div>
		</div>					
</main>

<?php
	include('inc/bottom.php');
?>