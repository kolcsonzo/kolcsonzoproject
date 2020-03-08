<?php
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
	<article>
		<div class="info pagename" style>
			<span class="text content-name">Felhasználók kezelése</span>
			<div style="float:right;">
				<button class="button" onclick="openPage('user-add')">Tag felvétel</button>
				<button class="button" onclick="openPage('user-delete')">Tag törlés</button>
			</div>
		</div>
		<br><br>
		<div class="container">			
				<div id="user-add" class="tabcontent">
					<div class="info">
						<span><strong>Tag felvételéhez</strong> a következő űrlap kitöltése szükséges</span>
					</div>
					<form action="" id="add-user-form" method="post" autocomplete="off">
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
					
			</div>

			<div id="user-delete" class="tabcontent">
			<?php 	
				//Felhasználók lekérdezése
				$query = "SELECT * FROM users";
				$result = mysqli_query($con, $query) or die(mysql_error());
				//Vezető szerepkörhöz kötött..
				if ($userinfo['role'] == 2 AND $_GET['delete'] != "" ) {
					$del_query = "DELETE FROM users WHERE username='".($_GET['delete'])."'";
					$execute = mysqli_query($con, $del_query) or die(mysql_error());
					//Tényleg volt törlés az sql-ben..?
					if (mysqli_affected_rows($con) == 1) {
					header("Refresh: 1, url=useradd.php?success=1");
					} else {
					header("Refresh: 1, url=useadd.php?success=2");
					}
				}
			?>
			<div class="info">
				<span><strong>Tag törléséhez</strong> használja a megfelelő sor melleti "Törlés" opciót.</span>
			</div>

					<span class="text">Felhasználók</span></br>	
			<?php
				while ($row = $result->fetch_assoc()) {
					echo $row['username'];
					//Név mellé írjuk a szerepkört
					if ($row['role'] == 1) {
						echo " (Munkatárs)";
					} else {
						echo " (Vezető)";
					}
					//Ha vezető jogunk van, akkor törölhetünk
					if ($userinfo['role'] == 2) {
					echo '<a href="useradd.php?delete=' .$row['username']. '"> Törlés</a>';
					}
					echo "</br>";
				}	//Sikerült-e a művelet?
					if ($_GET['success'] == 1) { echo "Sikeresen végrehajtva!"; }
					if ($_GET['success'] == 2) { echo "A művelet nem sikerült!"; }
				?>
			</div>
		</div>					
	</article>
</main>

<?php
	include('inc/bottom.php');
?>