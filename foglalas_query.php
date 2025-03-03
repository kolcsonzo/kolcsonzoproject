﻿<?php
//Változók
$eszkoz = $_POST['eszkoz'];
$id = $_POST['id'];
$idotartam = $_POST['idotartam'];

require('db.php');
//Ha a foglalásnál az első dropdown menüben választunk eszközt, akkor biztosan teljesül a feltétel (bár amúgy is), és lefut a következő kód:
if  ($eszkoz != "na") {
		echo ' 
		<div class="tab">
			<label for="id">Eszköz típusa:</label><br>
			<select id="id" onchange="foglalas('."'".$eszkoz."'".',document.getElementById('."'id'".').value,'."'na'".');" name="id" class="select">';
				//Ha még nincs ID (tehát nem történt típus választás), akkor megkérjük a választásra
				if ($id == "na") {echo '<option value="" disabled selected>Kérlek válassz!</option>';}
			
				$query = "SELECT devices.id, devices.brand, devices.type
FROM devices
WHERE IF( EXISTS( SELECT * FROM reservations WHERE reservations.device_id = devices.id AND NOW() BETWEEN reservations.start_datetime AND reservations.end_datetime ), 1, 0) = '0' AND devices.name='$eszkoz'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				while ($row = $result->fetch_assoc()) {
					//A típus kiválasztása után, a hozzátartozó ID alapján újratöltésnél mindig visszaállítjuk a dropdown menüben az előzőleg választottatat egy "selected" tulajdonsággal
					if ($id == $row['id']) {
						echo '<option selected="selected" value="'.$row["id"].'">'.$row["brand"].' '.$row["type"].' (id: '.$row["id"].')</option> ';
					} else {
						echo '<option value="'.$row["id"].'">'.$row["brand"].' '.$row["type"].' (id: '.$row["id"].')</option>';
					}
				}
				
		echo '
			</select>
		</div>';}
		
//Az eszköz választásnál egyelőre ennek "na" (nincs adat) értéket adunk, így nem fut le. A típus kiválasztásával viszont átadjuk az ID -t is, ami egészen biztos nem "na" (vagy bármi más) és az alapján kérdezzük le az időtartamot
if  ($id != "na") {
		echo ' 
		<div class="tab">
			<label for="idotartam">Foglalás időtartama:</label><br>
			<select id="idotartam" onchange="foglalas('."'".$eszkoz."'".','."'".$id."'".',document.getElementById('."'idotartam'".').value);" name="idotartam" class="select">
				<option value="" disabled selected>Kérlek válassz!</option>';
				$query = "SELECT * FROM `devices` WHERE id='$id'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				$row = mysqli_fetch_assoc($result);
				//Itt ciklussal feltöltjük a dropdown menüt, ameddig maximum bérelhető az eszköz
				$i = 1;
				while ($i <= $row[period_days]) {
					if ($i == $idotartam) {
					echo '<option selected="selected" value="'.$i.'">'.$i.' nap</option>';
					} else {
					echo '<option value="'.$i.'">'.$i.' nap</option>';
					}
				$i++;
				}
		echo '

			</select>
		</div>'; }
		
//Jön az "elküldés" gomb megjelenítése, hasonló módon, mint az ezelőtti dropdown menük, ha a foglalas() függvény utolsó paramétere sem "na", tehát végigértünk a folyamaton, akkor megjelenik a gomb
if  ($idotartam != "na") {
		echo ' 
		<div class="tab">
			<button class="button">Elküldés</button>
		</div>'; }

	  

		
?>