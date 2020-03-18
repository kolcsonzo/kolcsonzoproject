<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
	<div class="pagename" style>
		<span class="text content-name">Eszköz foglalása</span>
	</div>
	<form id="reservingForm" action="/action_page.php">
	  <!-- Lépések -->
	  <div class="tab">
			<label for="">Eszköz:</label><br>
			<select id="" name="" class="select">
				<option value="1">Laptop</option>
				<option value="2">Monitor</option>
			</select>
			<label for="">Szabad eszközök listázása:</label><br>
			<label class="switch">
				<input type="checkbox">
				<span class="slider"></span>
			</label>
	  </div>
	  <div class="tab">
			<label for="">Eszköz típusa:</label><br>
			<select id="" name="" class="select">
				<option value="1">Típus1</option>
				<option value="2">Típus2</option>
			</select>
	  </div>
	  <div class="tab">
		<label for="">Foglalás időtartama:</label><br>
			<select id="" name="" class="select">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
			</select>
	  </div>
	  <div class="tab">
		<label for="">Foglalás összegzése:</label><br>
		
	  </div><br><br>
		<center>
		  <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="button">Előző</button>
		  <button type="button" id="nextBtn" onclick="nextPrev(1)"class="button">Következő</button>
		</center>
	  <!-- Körök -->
	  <div style="text-align:center;">
		<br>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
	  </div>
	</form>
	<script type="text/javascript" src="js/reserving_form.js"></script>
</main>
<?php
	include('inc/bottom.php');
?>
