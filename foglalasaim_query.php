
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

//Ide jöhet a success üzenet
echo 'Sikresen visszaadtad az eszközt!';
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
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="70">70</option>
							<option value="100">100</option>
						</select>
					</li>
					<li class="keresoNev">
						<input type="text" id="keresoInput" onkeyup="myFunction('."'keresoInput'".')" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
<table class="table table-striped table-class" id= "table-id">
			<thead>
			<tr>
				<th onclick="sortTable(0)" class="sort mobile-view">Foglalás ID<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(1)" class="sort">Eszköz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(2)" class="sort">Eszköz típusa<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(3)" class="sort">Foglalás kezdete<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(4)" class="sort">Foglalás vége<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(5)" class="sort">Státusz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(6)" class=""></th>
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
</table>
		<div class="pagination-container">
			<ul class="pagination">
				<li data-page="prev">
					<span> < <span class="sr-only">(current)</span></span>
				</li>
				<li data-page="next" id="prev">
					<span> > <span class="sr-only">(current)</span></span>
				</li>
			</ul>
			<script type="text/javascript" src="js/search_and_pagination.js"></script>
		</div>'; 
?>