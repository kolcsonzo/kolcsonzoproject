<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>	
		<ul class="kereso_lista-Nr">
			<li class="keresoNev">
				<input type="text" id="keresoInput" onkeyup="myFunction()" placeholder="Keresés név szerint...">
			</li>
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
		</ul>
		<table class="table table-striped table-class" id= "table-id">
			<tr>
				<th onclick="sortTable(0)" class="sort">ID</th>
				<th onclick="sortTable(1)" class="sort">Név</th>
				<th onclick="sortTable(2)" class="sort">Max. foglalás</th>
				<th onclick="sortTable(3)" class="sort">Típus</th>
				<th onclick="sortTable(4)" class="sort">Státusz</th>
				<th onclick="sortTable(5)" class="sort">Tárolási pozíció</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>Foglalt</td>
				<td>SP_506</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>Foglalt</td>
				<td>SP_507</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Laptop</td>
				<td>3 nap</td>
				<td>Dell</td>
				<td>Foglalt</td>
				<td>SP_508</td>
			</tr>
			<tr>
				<td>1</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>Foglalt</td>
				<td>SP_506</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>Foglalt</td>
				<td>SP_507</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Laptop</td>
				<td>3 nap</td>
				<td>Dell</td>
				<td>Foglalt</td>
				<td>SP_508</td>
			</tr>			
			<tr>
				<td>1</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>Foglalt</td>
				<td>SP_506</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>Foglalt</td>
				<td>SP_507</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Laptop</td>
				<td>3 nap</td>
				<td>Dell</td>
				<td>Foglalt</td>
				<td>SP_508</td>
			</tr>
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
			</script>
		</div>	
</main>
<?php
	include('inc/bottom.php');
?>