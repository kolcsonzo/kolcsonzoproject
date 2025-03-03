
<?php
//Globális
require('auth_session.php'); //session ellenőrzése, hogy egyáltalán létezik -e
include("auth_user.php");	 //user adatainak lekérdezése
include("auth_admin.php");	//vezetői jog meglétének ellenőrzése
$role = $userinfo['role'];
$target = $_POST['target'];

//A törlés folyamata


				//Vezető szerepkörhöz kötött..
				if ($role == 2 AND $target != "") {
					//user eszközfoglalásainak törlése
					$del_query = "DELETE FROM reservations WHERE user_id='".$target."'";
					$execute = mysqli_query($con, $del_query) or die(mysql_error());	
					//törlés az users táblából
					$del_query = "DELETE FROM users WHERE username='".$target."'";
					$execute = mysqli_query($con, $del_query) or die(mysql_error());
					//Tényleg volt törlés az sql-ben..?
					if (mysqli_affected_rows($con) == 1) {
								echo '<script language="javascript">';
								echo '$.meow({';
								echo 'message: "A törlési folyamat sikeresen befejeződött.",';
								echo 'title: "Sikeres törlés!",';
								echo 'duration: 3500,';
								echo 'icon: "img/check-square-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/check-square?style=solid  - szín megváltoztatva*/
								echo 'closeable: false';
								echo '});';
								echo '</script>';
//------------------------------------------------------------NAPLÓZÁS------------------------------------------------------------------------------------------
								$user = $userinfo['username'];
								$query    = "INSERT INTO events (event, user)
											 VALUES ('Felhasználó eltávolítása: $target', '$user')";
								$execute   = mysqli_query($con, $query) or die(mysql_error());
//--------------------------------------------------------------------------------------------------------------------------------------------------------------
					} else {
								echo '<script language="javascript">';
								echo '$.meow({';
								echo 'message: "A tag törlése sikertelen volt. SQL hiba!",';
								echo 'title: "Sikertelen törlés!",';
								echo 'duration: 3500,';
								echo 'icon: "img/exclamation-triangle-solid.svg",'; /*Ingyenes ikon: https://fontawesome.com/icons/exclamation-triangle?style=solid  - szín megváltoztatva*/
								echo 'closeable: false';
								echo '});';
								echo '</script>';							
					}
					echo "</br>";
				}			
//--------------------------------------------------------------------------------------------------------
//Felhasználók lekérdezése
				$query = "SELECT * FROM users";
				$result = mysqli_query($con, $query) or die(mysql_error());
				
				echo '<ul class="kereso_lista-Nr">
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
						<div class="table-responsive" style="border: 0px">
						<table id="device" class="table table-hover" style="width:100%">
							<thead>
								<tr>
									<th>Felhasználónév</th>
									<th>Beosztás</th>
									<th id="torles"></th>
								</tr>
							</thead>
							<tbody>';
		
						while ($row = $result->fetch_assoc()) {
							echo '<tr>
									<td style="vertical-align: middle; padding:3px;">' . $row["username"] . '</td>';									
							if ($row['role'] == 1) {
								echo '<td style="vertical-align: middle; padding:3px;">Munkatárs</td>';
							}
							else {
								echo '<td style="vertical-align: middle; padding:3px;">Vezető</td>';
							}
							if ($role == 2) {
								echo '<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick="user_delete('."'".$row['username']."'".');"></td></tr>';
								}
							}
						echo '</thead>'; 
						echo '</table>'; 
						echo '</div>'; 
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
