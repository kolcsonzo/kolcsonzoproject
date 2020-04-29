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
		  //Ha minden megvan, akkor mehet
			$query    = "INSERT INTO reservations (user_id, device_id, start_datetime, end_datetime) 
											VALUES ('$userid','$device_id','$StartDate', '$EndDate')";
											$result   = mysqli_query($con, $query);
			//ide jöhet bármilyen success üzenet
	  }
	  ?>
	</form>

</main>
<?php
	include('inc/bottom.php');
?>
