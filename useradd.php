
<?php
//Szimpla azonosítás
	include("auth_session.php");
	include("auth_user.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
//Vezető szerep azonosítás
	include("auth_admin.php");
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Felhasználók kezelése</span>
			<div style="float:right;">
				<button class="button" onclick="openPage('user-add')">Tag felvétel</button>
				<button class="button" name="del" onclick="openPage('user-delete')">Taglista</button>
				<svg class="fas fa-user-plus" onclick="openPage('user-add')"></svg>
				<svg class="fas fa-user-minus" onclick="openPage('user-delete')"></svg>
			</div>
		</div>
		<br><br>
				<div id="user-add" class="tabcontent">
					<div class="info">
						<span><strong>Tag felvételéhez</strong> a következő űrlap kitöltése szükséges</span>
					</div>
					<form action="useradd.php" id="add-user-form" method="post" autocomplete="off">
						<br>
						<label>Felhasználónév:</label>
						<input type="text" id="username" name="username" required placeholder="Adja meg a felhasználónevet...">
						<label>Teljes név:</label>
						<input type="text" id="full_name" name="full_name" required placeholder="Adja meg a teljes nevet...">
						<label>E-mail:</label>
						<input type="email" id="email" name="email" required placeholder="Adja meg az e-mail címet...">
						<label>Jelszó:</label>
						<input type="password" id="password" name="password" required placeholder="Adja meg a jelszót">
						<label>Szerepkör:</label>
						<center>
						<div class="radio-role">
							<input type="radio" id="radioVezeto" name="role" value="2" checked>
							<label for="radioVezeto">Vezető</label>
							<input type="radio" id="radioMunkatárs" name="role" value="1">
							<label for="radioMunkatárs">Munkatárs</label>
						</div>						
						<div class="elvalaszto2">
							<button class="button">Tag felvétele</button>
						</div>
						</center>
						<?php
						//biztos ami biztos, ellenőrizzük itt is, hogy van -e vezetői jogosultsága az illetőnek, aki új felhasználót próbál felvenni
							if (isset($_REQUEST['username']) AND $userinfo['role'] == 2) {
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
										echo '<script>
													window.onload = function(){
														  $.meow({
															message: "' . $full_name . ' tag felvétele sikertelen.<br>A tag már szerepel az adatbázisban",
															title: "Sikertelen tagfelvétel!",
															duration: 3500,
															icon: "img/exclamation-triangle-solid.svg",'; /*Free icon: https://fontawesome.com/icons/exclamation-triangle?style=solid  - color changed*/
														echo 'closeable: false
														  });
														}													
												</script>';
								} else {
//------------------------------------------------------------NAPLÓZÁS------------------------------------------------------------------------------------------
								$user	= $userinfo['username'];
								if ($role == '1') {$szerepkor='Munkatárs';} else {$szerepkor='Vezető';}
								$query    = "INSERT INTO events (event, user)
											 VALUES ('Felhasználó hozzáadása: $username | Jogosultság: $szerepkor', '$user')";
								$execute   = mysqli_query($con, $query) or die(mysql_error());
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
								//Ha nincs, akkor mehet
								$query    = "INSERT into `users` (username, full_name, email, password, role, create_datetime)
											 VALUES ('$username', '$full_name', '$email','" . md5($password) . "', '$role', '$create_datetime')";
								$result   = mysqli_query($con, $query);
								if ($result) {
										echo '<script language="javascript">
													window.onload = function(){
														  $.meow({
															message: "' . $full_name . ' tag felvétele sikeres.",
															title: "Sikeres tagfelvétel!",
															duration: 3500,
															icon: "img/check-square-solid.svg",'; /*https://fontawesome.com/icons/check-square?style=solid  - color changed*/
														echo 'closeable: false
														  });
														}													
												</script>';
								} else {
										echo '<script language="javascript">
													window.onload = function(){
														  $.meow({
															message: "' . $full_name . ' tag felvétele sikertelen.",
															title: "Sikertelen tagfelvétel!",
															duration: 3500,
															icon: "img/exclamation-triangle-solid.svg",'; /*Free icon: https://fontawesome.com/icons/exclamation-triangle?style=solid  - color changed*/
														echo 'closeable: false
															});
														}													
												</script>';
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
			<?php
				//while
				echo '<div id="delete_q"></div>'; //ide érkezik vissza a script lefutása utáni kód, tehát az eredmény
				echo '<script type="text/javascript">user_delete()</script>';
			?>
			</div>	
</main>

<?php
	include('inc/bottom.php');
?>