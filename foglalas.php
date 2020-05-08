<?php
//azonosítás
	require("auth_session.php");
	include("auth_user.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>

<main>
		<div class="pagename" style>
			<span class="text content-name">Eszköz foglalása</span>
		</div>
		<div id="user-add" class="tabcontent">
			<div class="info">
				<span><strong>Az eszközkölcsönzés</strong> megkezdéséhez kérem válasszon egyet az eszközcsoportból.</span>
			</div>		
			<div class="tab-center">
				<form action="foglalas.php" method="post" autocomplete="off">
				<?php
				  //Az oldal betöltésénél azonnal megjelenik az eszköz választós dropdown menü, és ez nem is fog újratöltődni már. Az OnChange eseményre elindul az ajax, azaz meghívódik a foglalas_query.php átadva az "eszkoz, id(na)" paramétereket
					echo '
					<div class="tab">
						<label for="eszkoz" align="left">Eszköz:</label><br>
						<select onchange="foglalas(document.getElementById('."'eszkoz'".').value,'."'na'".','."'na'".');" id="eszkoz" name="eszkoz" class="select">
						<option value="" disabled selected>Kérlek válassz!</option>';
							$query = "SELECT devices.name
										FROM devices
										WHERE IF( EXISTS( SELECT * FROM reservations WHERE reservations.device_id = devices.id AND NOW() BETWEEN reservations.start_datetime AND reservations.end_datetime ), 1, 0) = '0'
										GROUP BY devices.name";
							$result = mysqli_query($con, $query) or die(mysql_error());
							while ($row = $result->fetch_assoc()) {
							echo '
							<option value="'.$row["name"].'">'.$row["name"].'</option>
							';
							}
					echo '
						</select>
				  </div>';
				  ?>
				  <div id="foglalas_result" class=""></div>
			<?php

			//User ID és Device ID lekérése az új sor beszúrásához
			$userid = $userinfo['id'];
			$device_id = $_REQUEST['id']; //a postban megkapott ID lesz a device_id
			
								$query		=	"SELECT * FROM devices WHERE id='$device_id'";
								$result		=	mysqli_query($con, $query) or die(mysql_error());
								$row		=	mysqli_fetch_assoc(result);
								$name = $row['name'];
								echo $name;			
			
			$days = $_REQUEST['idotartam']; //foglalás időtartama
			$StartDate = date('Y-m-d H:i:s'); //aktuális dátum
			$EndDate = date('Y-m-d H:i:s', strtotime(' + '.$days.' days'));//lejárati dátum (amit az aktuális dátum+időtartam hozzáadásából kapunk meg)
			//Ellenőrizzük, hogy minden adat megvan -e az új sor beszúráshoz, mert különben hibára futunk
				  if (isset($_REQUEST['eszkoz']) AND isset($_REQUEST['id']) AND isset($_REQUEST['idotartam']) AND $userinfo['role'] >= 1) {
					  //Ha minden megvan, akkor mehet a sor beszúrása a reservations táblába
						$query    = "INSERT INTO reservations (user_id, device_id, start_datetime, end_datetime) 
														VALUES ('$userid','$device_id','$StartDate', '$EndDate')";
														$result   = mysqli_query($con, $query);

						if ($result) {
						//ide jöhet bármilyen success üzenet
						echo '<script language="javascript">
								window.onload = function(){
								$.meow({
								message: "Az eszköz foglalása sikeresen megtörtént.",
								title: "Sikeres eszközfoglalás!",
								duration: 3500,
								icon: "img/check-square-solid.svg",'; /*https://fontawesome.com/icons/check-square?style=solid  - color changed*/
								echo 'closeable: false
								});
								}													
							</script>';
//------------------------------------------------------------NAPLÓZÁS------------------------------------------------------------------------------------------
								$query		=	"SELECT * FROM devices WHERE id='$device_id'";
								$result		=	mysqli_query($con, $query) or die(mysql_error());
								$row = $result -> fetch_assoc();
								$eszkoz = $row['name'];
								$type = $row['type'];
								$brand = $row['brand'];
								
								$user = $userinfo['username'];
								$query    = "INSERT INTO events (event, user)
											 VALUES ('Eszköz foglalása: $eszkoz | $brand $type | eID: $device_id', '$user')";
								$execute   = mysqli_query($con, $query) or die(mysql_error());
								} else {
									//fail
								echo '<script language="javascript">';
								echo '$.meow({';
								echo 'message: "Az eszközfoglalás nem sikerült!",';
								echo 'title: "Sikertelen foglalás!",';
								echo 'duration: 3500,';
								echo 'icon: "img/exclamation-triangle-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/check-square?style=solid  - szín megváltoztatva*/
								echo 'closeable: false';
								echo '});';
								echo '</script>';
									}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
				  }
				  ?>
				</form>
			</div>
		</div>	
</main>
<?php
	include('inc/bottom.php');
?>
