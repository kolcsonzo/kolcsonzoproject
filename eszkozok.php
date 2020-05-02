<?php
//azonosítás
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Eszközlista</span>
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
						<input type="text" id="keresoInput" onkeyup="myFunction('keresoInput')" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
		<table class="table table-striped table-class" id= "table-id">
			<thead>
			<tr>
				<th onclick="sortTable(0)" class="sort mobile-view">ID<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(1)" class="sort">Név<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(2)" class="sort">Max. foglalás<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(3)" class="sort">Márka<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(4)" class="sort">Típus<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(5)" class="sort">Státusz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(6)" class="sort">Tárolási pozíció<i class="fas fa-sort sort-icon"></i></th>
			</tr>
			</thead>
			<tbody>
<?php
//Eszközlista lekérdezése összekötve a foglalásokkal, hogy az eszköz foglaltsága is listázható legyen..
//Ha a reservations táblában nincs benne az adott eszköz ID -je VAGY a foglalás arra az eszközre lejárt(aktuális dátum nincs a foglalás kezdete és vége között), akkor szabad státusz jelenik meg
		$query = 
			"SELECT *, devices.id AS eszkoz_id, DATE_FORMAT(reservations.end_datetime, '%Y-%m-%d %H:%i') AS lejarati_datum, IF( EXISTS(
							 SELECT *
							 FROM reservations
							 WHERE reservations.device_id = devices.id AND NOW() BETWEEN reservations.start_datetime AND reservations.end_datetime ), 1, 0) as allapot
FROM devices
LEFT JOIN reservations
ON reservations.device_id = devices.id
GROUP BY device_id";
		$result = mysqli_query($con, $query) or die(mysql_error());
				
		while ($row = $result->fetch_assoc()) {
			echo'<tr>
					<td class="mobile-view">'.$row["eszkoz_id"].'</td>
					<td>'.$row["name"].'</td>
					<td>'.$row["period_days"].' nap</td>
					<td>'.$row["brand"].'</td>
					<td>'.$row["type"].'</td>';
			if ($row["allapot"] == 1) {
			echo'	<td>Foglalt ('.$row["lejarati_datum"].' -ig)</td>';
			} else {	
			echo'	<td>Szabad</td>';
			}
			echo'	<td>S'.$row["pos_s"].' P'.$row["pos_p"].'</td>
				</tr>';	
		}
?>
		</tbody>
		</table>
		<!--		Start Pagination -->
		<div class='pagination-container'>
			<ul class="pagination">
				<li data-page="prev">
					<span> < <span class="sr-only">(current)</span></span>
				</li>
				<li data-page="next" id="prev">
					<span> > <span class="sr-only">(current)</span></span>
				</li>
			</ul>
			<script type="text/javascript" src="js/search_and_pagination.js"></script>
		</div>	
</main>
<?php
	include('inc/bottom.php');
?>