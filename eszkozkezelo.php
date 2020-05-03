
<?php
//Szimpla azonosítás
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
//Vezető szerep azonosítás
	include("auth_admin.php");
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Eszközkezelő</span>
			<div style="float:right;">
				<button class="button" onclick="openPage('user-add')">Eszköz felvétel</button>
				<button class="button" name="del" onclick="openPage('user-delete')">Eszköz törlés</button>
				<svg class="fas fa-laptop-medical" onclick="openPage('user-add')"></svg>
				<svg class="fas fa-trash-alt" onclick="openPage('user-delete')"></svg>
			</div>
		</div>
		<br><br>
		<div id="user-add" class="tabcontent">
			<div class="info">
				<span><strong>Eszközcsoport létrehozásához</strong> használja a következő űrlapot abban az esetben, ha az még nem létezik.</span>
			</div>
			<form action="useradd.php" id="add-user-form" method="post" autocomplete="off">
				<br>
				<label>Eszközcsoport megnevezése:</label>
				<input type="text" id="username" name="username" required placeholder="Adja meg az eszközcsoport nevét">
				<br>
				<center>
					<div class="elvalaszto2">
						<button class="button">Létrehozás</button>
					</div>
				</center>
			</form><br><br><br><br>
			<div class="info">
				<span><strong>Eszköz felvételéhez</strong> a következő űrlap kitöltése szükséges.</span>
			</div>
			<form action="useradd.php" id="add-user-form" method="post" autocomplete="off">
				<br>
				<label>Márka:</label>
				<input type="text" id="username" name="username" required placeholder="Adja meg az eszköz márkáját...">
				<label>Típus:</label>
				<input type="text" id="full_name" name="full_name" required placeholder="Adja meg az eszköz típusát...">
				<label>Maximális foglalás hossza: (max 15 nap)</label>
				<center>
				<select class="select">
					<option value="" disabled selected>Kérlek válassz!</option>
					<option value"1">1</option>
					<option value"2">2</option>
					<option value"3">3</option>
					<option value"4">4</option>
					<option value"5">5</option>
					<option value"6">6</option>
					<option value"7">7</option>
					<option value"8">8</option>
					<option value"9">9</option>
					<option value"10">10</option>
					<option value"11">11</option>
					<option value"12">12</option>
					<option value"13">13</option>
					<option value"14">14</option>
					<option value"15">15</option>
				</select>				
				<div class="elvalaszto2">
					<button class="button">Eszköz felvétele</button>
				</div>
				</center>
			</form>	
		</div>
		
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
				<tbody>
					<tr>
						<td style="vertical-align: middle; padding:3px;">1</td>
						<td style="vertical-align: middle; padding:3px;">Laptop</td>
						<td style="vertical-align: middle; padding:3px;">Dell</td>
						<td style="vertical-align: middle; padding:3px;">Vostro</td>
						<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick=""></td>
					</tr>
					<tr>
						<td style="vertical-align: middle; padding:3px;">2</td>
						<td style="vertical-align: middle; padding:3px;">Laptop</td>
						<td style="vertical-align: middle; padding:3px;">Dell</td>
						<td style="vertical-align: middle; padding:3px;">Vostro</td>
						<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick=""></td>
					</tr>			<tr>
						<td style="vertical-align: middle; padding:3px;">3</td>
						<td style="vertical-align: middle; padding:3px;">Laptop</td>
						<td style="vertical-align: middle; padding:3px;">Dell</td>
						<td style="vertical-align: middle; padding:3px;">Vostro</td>
						<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick=""></td>
					</tr>
					<tr>
						<td style="vertical-align: middle; padding:3px;">4</td>
						<td style="vertical-align: middle; padding:3px;">Laptop</td>
						<td style="vertical-align: middle; padding:3px;">Dell</td>
						<td style="vertical-align: middle; padding:3px;">Vostro</td>
						<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick=""></td>
					</tr>			
					<tr>
						<td style="vertical-align: middle; padding:3px;">5</td>
						<td style="vertical-align: middle; padding:3px;">Laptop</td>
						<td style="vertical-align: middle; padding:3px;">Dell</td>
						<td style="vertical-align: middle; padding:3px;">Vostro</td>
						<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick=""></td>
						</tr>
					<tr>
						<td style="vertical-align: middle; padding:3px;">6</td>
						<td style="vertical-align: middle; padding:3px;">Monitor</td>
						<td style="vertical-align: middle; padding:3px;">Samusng</td>
						<td style="vertical-align: middle; padding:3px;">SyncMaster</td>
						<td style="vertical-align: middle; padding:3px;"><img class="fas fa-times x" onclick=""></td>
					</tr>
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
			</div>
</main>

<?php
	include('inc/bottom.php');
?>