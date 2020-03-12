
<?php
//Globális
$rol = $_POST['role'];
$target = $_POST['target'];
require('db.php');

//A törlés folyamata
				//Vezető szerepkörhöz kötött..
				if ($rol == 2 AND $target != "") {
					$del_query = "DELETE FROM users WHERE username='".$target."'";
					$execute = mysqli_query($con, $del_query) or die(mysql_error());
					//Tényleg volt törlés az sql-ben..?
					if (mysqli_affected_rows($con) == 1) {
					echo '<script language="javascript">';
					echo 'alert("A törlési művelet sikeresen végrehajtódott!")';
					echo '</script>';
					} else {
					echo '<script language="javascript">';
					echo 'alert("A törlési művelet sikertelen! SQL probléma!")';
					echo '</script>';
					}
					echo "</br>";
				}
//--------------------------------------------------------------------------------------------------------
//Felhasználók lekérdezése
				$query = "SELECT * FROM users";
				$result = mysqli_query($con, $query) or die(mysql_error());
				
				while ($row = $result->fetch_assoc()) {
					echo $row['username'];
					//Név mellé írjuk a szerepkört
					if ($row['role'] == 1) {
						echo " (Munkatárs)";
					} else {
						echo " (Vezető)";
					}
					//Ha vezető jogunk van, akkor törölhetünk
					if ($rol == 2) {
					echo '<button class="button" onclick="teszt('.$rol.','."'".$row['username']."'".');">Tag törlés</button>';
					}
					echo "</br>";
				}
				
			
					
?>