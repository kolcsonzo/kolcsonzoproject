
<?php
//Szimpla azonosítás
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
@//Vezető szerep azonosítás
	include("auth_admin.php");

//----------------------------------------------------ESZKÖZ FELVÉTEL---------------------------------------------------------------------------------------------
@	$device = stripslashes($_REQUEST['getGroupOfDevices']);
	$device = mysqli_real_escape_string($con, $device);
@	$other = stripslashes($_REQUEST['other']);
	$other = mysqli_real_escape_string($con, $other);
@	$brand = stripslashes($_REQUEST['brand']);
	$brand = mysqli_real_escape_string($con, $brand);
@	$type = stripslashes($_REQUEST['type']);
	$type = mysqli_real_escape_string($con, $type);
@	$sor = $_REQUEST['sor'];
@	$polc = $_REQUEST['polc'];
@	$days = $_REQUEST['days'];
	
	if (isset($device) AND isset($brand) AND isset($type) AND isset($sor) AND isset($polc) AND isset($days)) {
		if ($device == 'other') {
			$device = $other;
		}
		$query = "INSERT INTO devices (name, period_days, type, brand, pos_s, pos_p) VALUES ('$device', '$days', '$type', '$brand', '$sor', '$polc')";
		$execute = mysqli_query($con, $query);
		if ($execute) {
		//success üzenet
		echo '<script language="javascript">';
		echo '$.meow({';
		echo 'message: "Az eszköz felvétele sikeresen megtörtént.",';
		echo 'title: "Sikeres eszközfelvétel!",';
		echo 'duration: 3500,';
		echo 'icon: "img/check-square-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/check-square?style=solid  - szín megváltoztatva*/
		echo 'closeable: false';
		echo '});';
		echo '</script>';
//------------------------------------------------------------NAPLÓZÁS------------------------------------------------------------------------------------------
								$query		=	"SELECT max(id) as id FROM devices";
								$result		=	mysqli_query($con, $query) or die(mysql_error());
								$row = $result -> fetch_assoc();
								$id = $row['id'];

								$user = $userinfo['username'];
								$query    = "INSERT INTO events (event, user)
											 VALUES ('Eszköz felvétele: $device | $brand $type | ID: $id', '$user')";
								$execute   = mysqli_query($con, $query) or die(mysql_error());
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
		} else {
		//fail
		echo '<script language="javascript">';
		echo '$.meow({';
		echo 'message: "Az eszköz felvétele során hiba adódott!",';
		echo 'title: "Sikertelen eszközfelvétel!",';
		echo 'duration: 3500,';
		echo 'icon: "img/exclamation-triangle-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/check-square?style=solid  - szín megváltoztatva*/
		echo 'closeable: false';
		echo '});';
		echo '</script>';	
		}

	}


	?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Eszközkezelő</span>
			<div style="float:right;">
				<button class="button" onclick="openPage('user-add')">Eszköz felvétel</button>
				<button class="button" name="del" onclick="openPage('user-delete')">Eszköz törlés</button>
				<svg class="fas fa-laptop-medical" onclick="openPage('user-add')"></svg>
				<svg class="fas fa-trash-alt" onclick="openPage('user-delete')"></svg>
			</div>
		</div>
		<br><br>
		<div id="user-add" class="tabcontent">
			<div class="info">
				<span><strong>Eszköz felvételéhez</strong> a következő űrlap kitöltése szükséges.</span>
			</div>
			<form action="eszkozkezelo.php" id="add-user-form" method="post" autocomplete="off">
				<br>
				<label for="getGroupOfDevices">Válasszon eszközcsoportot!</label>
				<center>
					<select id ="getGroupOfDevices" name="getGroupOfDevices" class="select" onchange="group_of_devices()" required>
						<option value="" disabled selected>Kérlek válassz!</option>
						<?php
						//jelenlegi eszközcsoportok lekérdezése
						$query    = "SELECT * FROM devices GROUP BY name";
						$result   = mysqli_query($con, $query);
						while ($row = $result->fetch_assoc()) {
							echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
							}
						?>
						<option value="other">Egyéb</option>
					</select>				
				</center>
				<div id="group_of_devices">
					<label for="other">Eszközcsoport létrehozása:</label>
					<input type="text" id="other" name="other" required placeholder="Adja meg az eszközcsoport nevét...">
				</div>
				<label for="brand">Márka:</label>
				<input type="text" id="brand" name="brand" required placeholder="Adja meg az eszköz márkáját...">
				<label for="type">Típus:</label>
				<input type="text" id="type" name="type" required placeholder="Adja meg az eszköz típusát...">
				
				<label>Tárolási pozíció:</label>
					</br>
				<center>
					<select id ="sor" required name="sor" class="select select-sor">
						<option value="" disabled selected>Sor...</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
					</select>	
					<select id ="polc" name="polc" class="select select-polc" required>
						<option value="" disabled selected>Polc...</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
					</select>				
				</center>
				<label for="days">Maximális foglalás hossza: (max 15 nap)</label>
				<center>
				<select id ="days" name="days" class="select" required>
					<option value="" disabled selected>Kérlek válassz!</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
				</select>				
				<div class="elvalaszto2">
					<button class="button">Eszköz felvétele</button>
				</div>
				</center>
			</form>	
		</div>
		
				<?php echo '<script type="text/javascript">eszkoz_torles()</script>'; ?>
				<div id="eszkozkezelo_result" class=""></div> <!-- Ez a query visszatérési helye -->
</main>
<?php
	include('inc/bottom.php');
?>