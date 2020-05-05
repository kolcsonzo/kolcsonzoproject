
<?php
require('auth_session.php'); //session ellenőrzése, hogy egyáltalán létezik -e
include("auth_user.php");	 //user adatainak lekérdezése
include("auth_admin.php");	//vezetői jog meglétének ellenőrzése

$eszkoz_id = $_REQUEST['eszkoz_id'];
//---------------------------------------------------------ESZKÖZ TÖRLÉSE-----------------------------------------------------------------------------------------
if (isset($eszkoz_id)) {
//törlés az eszközlistából
$query    = "DELETE FROM devices WHERE id='$eszkoz_id'";
$result   = mysqli_query($con, $query) or die(mysql_error());
echo '<script type="text/javascript">openPage('."'".'user-delete'."'".')</script>';//törlés tab megnyitása a törlés megtörténte után
//success üzenet
echo 'Sikresen törölted az eszközt!';
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
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="70">70</option>
							<option value="100">100</option>
						</select>
					</li>
					<li class="keresoNev2">
						<input type="text" id="keresoInput" onkeyup="myFunction(0)" placeholder="Keresés...">
					</li>
				</ul>
			<table class="table table-striped table-class mobile-view2" id= "table-id">
				<thead id="device-thead">
					<tr>
						<th onclick="sortTable(0)" class="sort">ID<i class="fas fa-sort sort-icon"></th>
						<th onclick="sortTable(1)" class="sort">Eszköz<i class="fas fa-sort sort-icon"></th>
						<th onclick="sortTable(2)" class="sort">Márka<i class="fas fa-sort sort-icon"></th>
						<th onclick="sortTable(3)" class="sort">Típus<i class="fas fa-sort sort-icon"></th>
						<th class="sort" style="vertical-align: middle;">Törlés</th>
					</tr>
				</thead>
				<tbody>';
					while ($row = $result->fetch_assoc()) {
						echo '<tr>
								<td style="vertical-align: middle; padding:3px;">'.$row["id"].'</td>
								<td style="vertical-align: middle; padding:3px;">'.$row["name"].'</td>
								<td style="vertical-align: middle; padding:3px;">'.$row["brand"].'</td>
								<td style="vertical-align: middle; padding:3px;">'.$row["type"].'</td>
								<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick="eszkoz_torles('."'".$row['id']."'".');  "></td>					
							</tr>'; }
					echo'
					</tbody>
				</table>
				<!--		Start Pagination -->
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
				</div>
			</div>';
?>