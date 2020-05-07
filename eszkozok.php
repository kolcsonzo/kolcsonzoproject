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
							<option value="10" selected>10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="70">70</option>
							<option value="100">100</option>
						</select>
					</li>
					<li class="keresoNev" id="input-devices-mobile">
						<input type="text" id="keresoInput" oninput="myFunction()" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
		<div class="table-responsive-lg">
		<table id="device" class="table table-hover" style="width:100%; font-size:12px; min-width: 680px;">
			<thead>
				<tr>
					<th style="width:30px;">ID</th>
					<th>Név</th>
					<th>Max. foglalás</th>
					<th>Márka</th>
					<th>Típus</th>
					<th>Státusz</th>
					<?php 
					if ($userinfo['role'] == 2) {echo '<th>Foglaló</th>';}
					?>
					<th>Tárolási poz.</th>
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
            INNER JOIN users
            ON reservations.user_id = users.id
			GROUP BY device_id";
		$result = mysqli_query($con, $query) or die(mysql_error());
				
		while ($row = $result->fetch_assoc()) {
			echo'<tr>
					<td style="width:30px;">'.$row["eszkoz_id"].'</td>
					<td>'.$row["name"].'</td>
					<td>'.$row["period_days"].'&nbsp;nap</td>
					<td>'.$row["brand"].'</td>
					<td>'.$row["type"].'</td>';
			if ($row["allapot"] == 1) {
			echo'	<td>
						<div id="information">
							<span style="font-size: 12px; color: #26ACDE;">
								<span>Foglalt </span><i class="fas fa-info-circle" style="font-size:13px"></i> 		
							</span>
						<span class="tooltiptext">
							Lejárat dátuma: '.$row["lejarati_datum"].'	
						</span>
						</div>
					</td>';
			if ($userinfo['role'] == 2) {echo '<td>'.$row["username"].'</td>';}
			} else {	
			echo'	<td>Szabad</td>';
			if ($userinfo['role'] == 2) {echo '<td></td>';}
			}
			echo'	<td>S'.$row["pos_s"].' P'.$row["pos_p"].'</td></tr>';	
		}
?>			
			</tbody>
		</table>
			<div class="print">
				<svg class="fas fa-print" onclick="window.print()"></svg>			
			<div/>		
		</div>
		<script>
			$(document).ready(function() {
			$('#device').DataTable( {
				"info":     false,
				"order": [[ 0, "asc" ]],
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
</main>
<?php
	include('inc/bottom.php');
?>