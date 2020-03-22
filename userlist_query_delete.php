
<?php
//Globális
$rol = $_POST['role'];
$target = $_POST['target'];
require('db.php');

//A törlés folyamata
				//Vezető szerepkörhöz kötött..
				if ($rol == 2 AND $target != "") {
					$del_query = "DELETE FROM users WHERE username='".$target."'";
					$execute = mysqli_query($con, $del_query) or die(mysql_error());
					//Tényleg volt törlés az sql-ben..?
					if (mysqli_affected_rows($con) == 1) {
					echo '<script language="javascript">';
					echo 'alert("A törlési művelet sikeresen végrehajtódott!")';
					echo '</script>';
					} else {
					echo '<script language="javascript">';
					echo 'alert("A törlési művelet sikertelen! SQL probléma!")';
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
							<input type="text" id="keresoInput" onkeyup="myFunction()" placeholder="Keresés...">
							</li>
						</ul>
					<table class="table table-striped table-class mobile-view2" id= "table-id">
						<tr>
							<th onclick="sortTable(0)" class="sort">Felhasználónév<i class="fas fa-sort sort-icon"></th>
							<th onclick="sortTable(1)" class="sort">Beosztás<i class="fas fa-sort sort-icon"></th>
							<th>Törlés</th>
						</tr>';

						while ($row = $result->fetch_assoc()) {
							echo '<tr>
									<td style="vertical-align: middle; padding:3px;">' . $row["username"] . '</td>';									
							if ($row['role'] == 1) {
								echo '<td style="vertical-align: middle; padding:3px;">Munkatárs</td>';
							}
							else {
								echo '<td style="vertical-align: middle; padding:3px;">Vezető</td>';
							}
							if ($rol == 2) {
								echo '<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick="teszt('.$rol.','."'".$row['username']."'".');"></td></tr>';
								}
							}
							
						echo '</table>'; 
						echo '<div class="pagination-container">
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
