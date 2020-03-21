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
				<svg class="fas fa-user-plus"></svg>
				<svg class="fas fa-user-minus"></svg>
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
						<input type="mail" id="email" name="email" required placeholder="Adja meg az e-mail címet...">
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
										echo '  <script>
													window.onload = function(){
														document.getElementById("myBtn").click();
														document.getElementById("modal-body").className = "modal-body_warning";
														document.getElementById("modal-header").className = "modal-header_warning";
														document.getElementById("modal-footer").className = "modal-footer_warning";
													}
												</script>';
										$eredmenyinfo1 = 'Sikertelen tagfelvétel!';
										$eredmenyinfo2 = ' már bent van az adatbázisban!';
								} else {

								//Ha nincs, akkor mehet
								$query    = "INSERT into `users` (username, full_name, email, password, role, create_datetime)
											 VALUES ('$username', '$full_name', '$email','" . md5($password) . "', '$role', '$create_datetime')";
								$result   = mysqli_query($con, $query);
								if ($result) {
										echo '  <script>
													window.onload = function(){
														document.getElementById("myBtn").click();
													}
												</script>';
										$eredmenyinfo1 = 'Sikeres tagfelvétel!';
										$eredmenyinfo2 = ' felvétele sikeres volt!';
								} else {
										echo '  <script>
													window.onload = function(){
														document.getElementById("myBtn").click();
														document.getElementById("modal-body").className = "modal-body_warning";
														document.getElementById("modal-header").className = "modal-header_warning";
														document.getElementById("modal-footer").className = "modal-footer_warning";
													}
												</script>';
										$eredmenyinfo1 = 'Sikertelen tagfelvétel!';
										$eredmenyinfo2 = ' felvétele nem sikerült!';
									} 
								}
							}
						?>
					</form>
					<!--információs ablak-->
				<button id="myBtn" style="visibility: hidden;"></button>	
				<div id="myModal" class="modal">
					<div class="modal-content">
						<div class="modal-header" id="modal-header">
							<span class="close">&times;</span>
							<h3><?php echo $eredmenyinfo1 ?><h3>
						</div>
						<div class="modal-body" id="modal-body">
							<h4><?php echo $full_name . $eredmenyinfo2 ?></h4>
						</div>
						<div class="modal-footer" id="modal-footer">
						</div>
					</div>
				</div>	
				<!--vége-->
				<script type="text/javascript" src="js/inform_windows.js"></script>
			</div>

			<div id="user-delete" class="tabcontent">
			<div class="info">
				<span><strong>Tag törléséhez</strong> használja a megfelelő sor melleti "Törlés" opciót.</span>
			</div>
			<?php
				//while
				echo '<div id="delete_q"></div>'; //ide érkezik vissza a script lefutása utáni kód, tehát az eredmény
				echo '<script type="text/javascript">teszt('.$userinfo['role'].')</script>';
				?>

				
			</div>					
</main>

<?php
	include('inc/bottom.php');
?>