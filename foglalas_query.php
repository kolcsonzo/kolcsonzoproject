<?php
//Változók
$eszkoz = $_POST['eszkoz'];
$id = $_POST['id'];

require('db.php');
//Ha az a foglalásnál az első dropdown menüben választunk eszközt, akkor biztosan teljesül a feltétel (bár amúgy is), és lefut a következő kód:
if  ($eszkoz != "na") {
		echo ' 
		<div class="tab">
			<label for="">Eszköz típusa:</label><br>
			<select id="id" onchange="foglalas('."'".$eszkoz."'".',document.getElementById('."'id'".').value);" name="" class="select">';
				//Ha még nincs ID (tehát nem történt típus választás), akkor megkérjük a választásra
				if ($id == "na") {echo '<option value="" disabled selected>Kérlek válassz!</option>';}
			
				$query = "SELECT * FROM `devices` WHERE name='$eszkoz'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				while ($row = $result->fetch_assoc()) {
					//A típus kiválasztása után, a hozzátartozó ID alapján újratöltésnél mindig visszaállítjuk a dropdown menüben az előzőleg választottatat egy "selected" tulajdonsággal
					if ($id == $row['id']) {
						echo '<option selected="selected" value="'.$row["id"].'">'.$row["type"].' (id: '.$row["id"].')</option> ';
					} else {
						echo '<option value="'.$row["id"].'">'.$row["type"].' (id: '.$row["id"].')</option>';
					}
				}
				
		echo '
			</select>
		</div>';}
		
//Az eszköz választásnál egyelőre ennek "na" (nincs adat) értéket adunk, így nem fut le. A típus kiválasztásával viszont átadjuk az ID -t is, ami egészen biztos nem "na" (vagy bármi más) és az alapján kérdezzük le az időtartamot
if  ($id != "na") {
		echo ' 
		<div class="tab">
			<label for="">Foglalás időtartama:</label><br>
			<select id="" name="" class="select">
				<option value="" disabled selected>Kérlek válassz!</option>';
				$query = "SELECT * FROM `devices` WHERE id='$id'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				$row = mysqli_fetch_assoc($result);
				//Itt ciklussal feltöltjük a dropdown menüt, ameddig maximum bérelhető az eszköz
				$i = 1;
				while ($i <= $row[period_days]) {
				echo '<option value="'.$i.'">'.$i.' nap</option>';
				$i++;}
		echo '
			</select>
		</div>'; }

	  

		
?>