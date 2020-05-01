<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>

<main>
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
						<input type="text" id="keresoInput" onkeyup="myFunction('keresoInput')" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
		<table class="table table-striped table-class" id= "table-id">
			<tr>
				<th onclick="sortTable(0)" class="sort mobile-view">Foglalás ID<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(1)" class="sort">Eszköz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(2)" class="sort">Eszköz típusa<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(3)" class="sort">Foglalás kezdete<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(4)" class="sort">Foglalás vége<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(5)" class="sort">Státusz<i class="fas fa-sort sort-icon"></i></th>
			</tr>
			<?php
//UserID megadása a globális userinfo lekérdezésből..(a queryben történő egyszerűbb felhasználás érdekében nem közvetlenül az userinfóból van)
$userid = $userinfo["id"];
//Foglalások lekérdezése
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
					} else {	
					echo'	<td>Aktív</td>';
					}
			echo'</tr>';	
		}
?>
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
