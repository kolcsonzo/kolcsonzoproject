﻿
<?php
require('auth_session.php'); //session ellenőrzése, hogy egyáltalán létezik -e
include("auth_user.php");	 //user adatainak lekérdezése

$userid = $userinfo["id"];
$foglalas_id = $_REQUEST['foglalas_id'];
//---------------------------------------------------------BIZTONSÁGI RÉSZ-----------------------------------------------------------------------------------------
//Mielőtt bármi is végrehajtódna ellenőrizzük, hogy valóban az adott userhez tartozik -e a foglalás
if (isset($foglalas_id)) {
$query    = "SELECT *
			FROM users
			INNER JOIN reservations
			ON users.id = reservations.user_id
			WHERE reservations.id = '$foglalas_id' AND users.id = '$userid'";
$result   = mysqli_query($con, $query);
$rows = mysqli_num_rows($result);
if ($rows != 1) {												
//Itt áll fenn az a szituáció, amikor az onchange eventben átírja valaki a számot
} else {
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------	
//Foglalás visszaadása, ami valójában csak egy dátum módosítást jelent

$query    = "UPDATE reservations SET end_datetime=NOW()-1 WHERE id = '$foglalas_id'";
$result   = mysqli_query($con, $query);

//success
if ($result) {
		echo '<script language="javascript">';
		echo '$.meow({';
		echo 'message: "Az eszköz visszaadása sikeresen megtörtént.",';
		echo 'title: "Sikeres visszaadás!",';
		echo 'duration: 3500,';
		echo 'icon: "img/check-square-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/check-square?style=solid  - szín megváltoztatva*/
		echo 'closeable: false';
		echo '});';
		echo '</script>';
//------------------------------------------------------------NAPLÓZÁS------------------------------------------------------------------------------------------
								$query		=	"SELECT * FROM  reservations
												INNER JOIN devices
												ON reservations.device_id = devices.id
												WHERE reservations.id = '$foglalas_id'";
								$result		=	mysqli_query($con, $query) or die(mysql_error());
								$row = $result -> fetch_assoc();
								$eszkoz = $row['name'];
								$type = $row['type'];
								$brand = $row['brand'];
								$device_id = $row['device_id'];

								$user = $userinfo['username'];
								$query    = "INSERT INTO events (event, user)
											 VALUES ('Eszköz visszaadása: $eszkoz | $brand $type | eID: $device_id | fID: $foglalas_id', '$user')";
								$execute   = mysqli_query($con, $query) or die(mysql_error());
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
		} else {
		echo '<script language="javascript">';
		echo '$.meow({';
		echo 'message: "Az eszköz visszaadása sikertelen volt!",';
		echo 'title: "Sikertelen visszaadás!",';
		echo 'duration: 3500,';
		echo 'icon: "img/exclamation-triangle-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/exclamation-triangle?style=solid  - szín megváltoztatva*/
		echo 'closeable: false';
		echo '});';
		echo '</script>';		
			}
		} 
}


//Foglalások lekérdezése
echo '
		<div class="pagename" style>
			<span class="text content-name">Foglalásaim</span>
			<div class="search_and_rowNr">
				<ul id="search-devices" class="kereso_lista-Nr">
					<li class="tablazat_merteke">
						<select name="state" id="maxRows" class="select-list">
							<option value="5000">Mind</option>
							<option value="5">5</option>
							<option value="10" selected>10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="70">70</option>
							<option value="100">100</option>
						</select>
					</li>
					<li class="keresoNev" id="input-devices-mobile">
						<input type="text" id="keresoInput" onkeyup="myFunction('."'keresoInput'".')" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
		<div class="table-responsive">
		<table id="device" class="table table-hover" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Eszköz</th>
					<th>Eszköz típusa</th>
					<th>Foglalás kezdete</th>
					<th>Foglalás vége</th>
					<th>Státusz</th>
					<th id="torles"></th>
				</tr>
			</thead>
			<tbody>';
			
		$query =" 
			SELECT reservations.id AS id, devices.name AS name, devices.brand AS brand, devices.type AS type, DATE_FORMAT(start_datetime, '%Y-%m-%d %H:%i') as start_datetime, DATEDIFF( end_datetime, NOW()) AS remaining, IF (end_datetime < NOW(), 1, 0) AS allapot, DATE_FORMAT(end_datetime, '%Y-%m-%d %H:%i') as end_datetime
			FROM `reservations`
			INNER JOIN devices
			ON devices.id = reservations.device_id
			WHERE user_id='$userid'
			GROUP BY reservations.id
			ORDER BY start_datetime DESC";
		$result = mysqli_query($con, $query) or die(mysql_error());
				
		while ($row = $result->fetch_assoc()) {
			echo'<tr>
					<td>'.$row["id"].'</td>
					<td>'.$row["name"].'</td>
					<td>'; echo $row["brand"]; echo '  '.$row["type"];
					echo'</td>
					<td>'.$row["start_datetime"].'</td>';
					if ($row["remaining"] > 0){
						echo '
					<td>
					<div id="information">
							<span style="font-size: 12px; color: #26ACDE;">
								<span>'.$row["end_datetime"].'</span>
								<i class="fas fa-info-circle" style="font-size:13px"></i> 		
							</span>
						<span class="tooltiptext">
							'.$row["remaining"].' nap maradt
						</span>
					</div>
					</td>';
						
					
					} else {
					echo '<td>'.$row["end_datetime"].'</td>';
					}
					if ($row["allapot"] == 1) {
					echo'	<td>Lejárt</td>';
					echo '<td style="vertical-align: middle; padding:3px;"></td>';
					} else {	
					echo'	<td>Aktív</td>';
					echo '<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick="foglalasaim('."'".$row['id']."'".');"></td>';
					}																					
			echo'</tr>';	
		}
//Foglalások lekérdezésének vége
		echo'
			</tbody>
		</table>
		<div class="print">
			<svg class="fas fa-print" onclick="window.print()"></svg>			
		<div/>
		</div>'
?>
				<script>
				$(document).ready(function() {
				$('#device').DataTable( {
					"info":     false,
					"order": [[ 4, "desc" ]],
					"language": {
						"paginate": {
							"next": ">",
							"previous": "<"
						},
						"lengthMenu": "_MENU_",
						"search": "",
						"zeroRecords": "Nincs találat...",
						"infoEmpty": "Nincsenek rekordok az adatbázisban."
						},
					"lengthMenu": [ [5,10,15,20,50,70,100,5000], [5,10,15,20,50,70,100,"Mind"] ],
					"pageLength": 10
					} );
				
				var table = $('#device').DataTable();
				 
				$('#keresoInput').on( 'keyup', function () {
					table.search( this.value ).draw();
				} );			
				$('#maxRows').change(function(){
					table.page.len( $(this).val() ).draw();
				})		
				});
				</script>