<?php
//azonosítás
	include("auth_session.php");
	
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
		<div id="tab-center">
			<div id="tab-center2">
				<form action="foglalas.php" id="" method="post" autocomplete="off">
				  <?php
				  //Az oldal betöltésénél azonnal megjelenik az eszköz választós dropdown menü, és ez nem is fog újratöltődni már. Az OnChange eseményre elindul az ajax, azaz meghívódik a foglalas_query.php átadva az "eszkoz, id(na)" paramétereket
					echo '
					<div class="tab">
						<label for="eszkoz" style="color: #26ACDE";>Eszköz:</label><br>
						<select onchange="foglalas(document.getElementById('."'eszkoz'".').value,'."'na'".','."'na'".');" id="eszkoz" name="eszkoz" class="select">
						<option value="" disabled selected>Kérlek válassz!</option>';
							$query = "SELECT name FROM `devices` GROUP BY name";
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
			$userid = $userinfo['id']; //minden userinfot elérünk bármelyik oldalon, miután az inc.php -ben már lekérdezzük
			$device_id = $_REQUEST['id']; //a postban megkapott ID lesz a device_id
			//Mai dátum lekérdezése
			$days = $_REQUEST['idotartam']; //foglalás időtartama
			$StartDate = date('Y-m-d H:i:s'); //aktuális dátum
			$EndDate = date('Y-m-d H:i:s', strtotime(' + '.$days.' days'));//lejárati dátum (amit az aktuális dátum+időtartam hozzáadásából kapunk meg)
			//Ellenőrizzük, hogy minden adat megvan -e az új sor beszúráshoz, mert különben hibára futunk
				  if (isset($_REQUEST['eszkoz']) AND isset($_REQUEST['id']) AND isset($_REQUEST['idotartam']) AND $userinfo['role'] >= 1) {
					  //Ha minden megvan, akkor mehet a sor beszúrása a reservations táblába
						$query    = "INSERT INTO reservations (user_id, device_id, start_datetime, end_datetime) 
														VALUES ('$userid','$device_id','$StartDate', '$EndDate')";
														$result   = mysqli_query($con, $query);
					  //Ezután az eszközlistában átállítjuk az eszköz státuszát foglaltra
					  $query    = "UPDATE devices SET status=1
														VALUES ('$userid','$device_id','$StartDate', '$EndDate')";
														$result   = mysqli_query($con, $query);
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
				  }
				  ?>
				</form>
			</div>
		</div>
	</div>
</main>
<?php
	include('inc/bottom.php');
?>
