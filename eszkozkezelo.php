
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
		
				<?php echo '<script type="text/javascript">eszkoz_torles()</script>'; ?>
				<div id="eszkozkezelo_result" class=""></div> <!-- Ez a query visszatérési helye -->
</main>

<?php
	include('inc/bottom.php');
?>