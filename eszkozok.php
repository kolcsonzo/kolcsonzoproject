<?php
//azonosítás
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Eszközlista</span>
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
				<li class="keresoNev">
					<input type="text" id="keresoInput" onkeyup="myFunction()" placeholder="Keresés...">
				</li>
			</ul>			
		</div>
		
		<table class="table table-striped table-class" id= "table-id">
			<tr>
				<th onclick="sortTable(0)" class="sort">ID<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(1)" class="sort">Név<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(2)" class="sort">Max. foglalás<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(3)" class="sort">Márka<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(4)" class="sort">Típus<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(5)" class="sort">Státusz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(6)" class="sort">Tárolási pozíció<i class="fas fa-sort sort-icon"></i></th>
			</tr>
			<tr>
				<td>1</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>EH-TW650</td>
				<td>Foglalt</td>
				<td>S5_P6</td>
			</tr>
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>C27F390</td>
				<td>Foglalt</td>
				<td>S5_P7</td>
			</tr>
				<td>3</td>
				<td>Laptop</td>
				<td>3 nap</td>
				<td>Dell</td>
				<td>Vostro15-3780
				<td>Foglalt</td>
				<td>S5_P8</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>EH-TW650</td>
				<td>Foglalt</td>
				<td>S5_P6</td>
			</tr>
				<td>5</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>C27F390</td>
				<td>Foglalt</td>
				<td>S5_P7</td>
			</tr>
				<td>6</td>
				<td>Laptop</td>
				<td>3 nap</td>
				<td>Dell</td>
				<td>Vostro15-3780
				<td>Foglalt</td>
				<td>S5_P8</td>
			</tr>
			<tr>
				<td>7</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>EH-TW650</td>
				<td>Foglalt</td>
				<td>S5_P6</td>
			</tr>
				<td>8</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>C27F390</td>
				<td>Foglalt</td>
				<td>S5_P7</td>
			</tr>
				<td>9</td>
				<td>Laptop</td>
				<td>3 nap</td>
				<td>Dell</td>
				<td>Vostro15-3780
				<td>Foglalt</td>
				<td>S5_P8</td>
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
		</div>	
</main>
<?php
	include('inc/bottom.php');
?>