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
	<form id="reservingForm" action="/action_page.php">
	  <?php
		echo '
		<div class="tab">
			<label for="">Eszköz:</label><br>
			<select onchange="foglalas(document.getElementById('."'eszkoz'".').value,'."'na'".');" id="eszkoz" name="" class="select">
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
	</form>

</main>
<?php
	include('inc/bottom.php');
?>
