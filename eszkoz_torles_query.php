
<?php
require('auth_session.php'); //session ellenőrzése, hogy egyáltalán létezik -e
include("auth_user.php");	 //user adatainak lekérdezése
include("auth_admin.php");	//vezetői jog meglétének ellenőrzése

@$eszkoz_id = $_REQUEST['eszkoz_id'];
//---------------------------------------------------------ESZKÖZ TÖRLÉSE-----------------------------------------------------------------------------------------
if (isset($eszkoz_id)) {
//törlés az eszközlistából
$query    = "DELETE FROM devices WHERE id='$eszkoz_id'";
$result   = mysqli_query($con, $query) or die(mysql_error());
echo '<script type="text/javascript">openPage('."'".'user-delete'."'".')</script>';//törlés tab megnyitása a törlés megtörténte után
//success üzenet
echo '<script language="javascript">';
echo '$.meow({';
echo 'message: "A törlési folyamat sikeresen befejeződött.",';
echo 'title: "Sikeres törlés!",';
echo 'duration: 3500,';
echo 'icon: "img/check-square-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/check-square?style=solid  - szín megváltoztatva*/
echo 'closeable: false';
echo '});';
echo '</script>';
} 
//----------------------------------------------------------ESZKÖZÖK KILISTÁZÁSA-----------------------------------------------------------------------------------
$query ="SELECT *, devices.id as id
			FROM devices
			WHERE 
            IF( EXISTS(
			SELECT *
			FROM reservations
			WHERE reservations.device_id = devices.id AND NOW() BETWEEN reservations.start_datetime AND reservations.end_datetime ), 1, 0) = 0";
$result = mysqli_query($con, $query) or die(mysql_error());	
		

echo'
		<div id="user-delete" class="tabcontent">
			<div class="info">
				<span><strong>Eszköz törléséhez</strong> használja a megfelelő sor melleti "Törlés" opciót.</span>
			</div>
				<ul class="kereso_lista-Nr">
					<li class="tablazat_merteke">
						<select name="state" id="maxRows" class="select-list">
							<option value="5000">Mind</option>
							<option value="5" selected>5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="70">70</option>
							<option value="100">100</option>
						</select>
					</li>
					<li class="keresoNev2">
						<input type="text" id="keresoInput" onkeyup="myFunction()" placeholder="Keresés...">
					</li>
				</ul>		
				<div class="table-responsive-sm">
				<table id="device" class="table table-hover" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Eszköz</th>
							<th>Márka</th>
							<th>Típus</th>
							<th id="torles"></th>
						</tr>
					</thead>
					<tbody>';
					while ($row = $result->fetch_assoc()) {
						echo '<tr>
								<td>'.$row["id"].'</td>
								<td>'.$row["name"].'</td>
								<td>'.$row["brand"].'</td>
								<td>'.$row["type"].'</td>
								<td><img class="fas fa-times x" onclick="eszkoz_torles('."'".$row['id']."'".');  "></td>					
							</tr>'; }
					echo'
					</tbody>
				</table>
				</div>';
?>
		<script>
			$(document).ready(function() {
			$('#device').DataTable( {
				"info":     false,
				"order": [[ 2, "asc" ]],
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
				"lengthMenu": [ [5,10,15,20,50,70,100,5000], [5,10,15,20,50,70,100,"Mind"] ]
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
