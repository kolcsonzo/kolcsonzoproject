<?php
//azonosítás
require('auth_session.php'); //session ellenőrzése, hogy egyáltalán létezik -e
include("auth_user.php");	 //user adatainak lekérdezése
include("auth_admin.php");	//vezetői jog meglétének ellenőrzése
header("Content-Type: text/html; charset=utf-8");
include('inc/top.php');
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Naplózás</span>
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
		<table id="device" class="table table-hover" style="width:100%; min-width:800px">
			<thead>
				<tr>
					<th style="padding-left:2px;padding-right:2px; width:60px;">ID</th>
					<th>Esemény</th>
					<th style="min-width:160px;">Kezdeményező</th>
					<th>Időpont</th>
				</tr>
			</thead>
			<tbody>
<?php
$query = "SELECT * FROM events";
$result = mysqli_query($con, $query) or die(mysql_error());
				
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
				echo '<td style="padding-left:2px;padding-right:2px; width:60px;">'.$row['event_id'].'</td>';
				echo '<td>'.$row['event'].'</td>';
				echo '<td>'.$row['user'].'</td>';
				echo '<td>'.$row['datetime'].'</td>';
			echo '</tr>';
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
				"order": [[ 3, "desc" ]],
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