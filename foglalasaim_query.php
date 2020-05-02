
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
$result   = mysqli_query($con, $query);} }

//Ide jöhet a success üzenet
echo 'Sikresen visszaadtad az eszközt!';

//Foglalások lekérdezése
echo '
<table class="table table-striped table-class" id= "table-id">
			<thead>
			<tr>
				<th onclick="sortTable(0)" class="sort mobile-view">Foglalás ID<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(1)" class="sort">Eszköz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(2)" class="sort">Eszköz típusa<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(3)" class="sort">Foglalás kezdete<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(4)" class="sort">Foglalás vége<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(5)" class="sort">Státusz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(6)" class="sort">Visszaadás<i class="fas fa-sort sort-icon"></i></th>
			</tr>
			</thead>
			<tbody>';
			
		$query =" 
			SELECT reservations.id AS id, devices.name AS name, devices.type AS type, DATE_FORMAT(start_datetime, '%Y-%m-%d %H:%i') as start_datetime, DATEDIFF( end_datetime, NOW()) AS remaining, IF (end_datetime < NOW(), 1, 0) AS allapot, DATE_FORMAT(end_datetime, '%Y-%m-%d %H:%i') as end_datetime
			FROM `reservations`
			INNER JOIN devices
			ON devices.id = reservations.device_id
			WHERE user_id='$userid'
			GROUP BY reservations.id
			ORDER BY start_datetime DESC";
		$result = mysqli_query($con, $query) or die(mysql_error());
				
		while ($row = $result->fetch_assoc()) {
			echo'<tr>
					<td class="mobile-view">'.$row["id"].'</td>
					<td>'.$row["name"].'</td>
					<td>'.$row["type"].'</td>
					<td>'.$row["start_datetime"].'</td>';
					if ($row["remaining"] > 0){
					echo '<td>'.$row["end_datetime"].' ('.$row["remaining"].' nap)</td>';
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
</table>'; 
?>