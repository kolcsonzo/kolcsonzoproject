<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>

<main>
	<div class="pagename" style>
			<span class="text content-name">Foglalásaim</span>
			<div class="search_and_rowNr">
				<ul id="search-devices" class="kereso_lista-Nr">
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
						<input type="text" id="keresoInput" onkeyup="myFunction('keresoInput')" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
		<table class="table table-striped table-class" id= "table-id">
			<tr>
				<th onclick="sortTable(0)" class="sort mobile-view">ID<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(1)" class="sort">Eszköz<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(2)" class="sort">Eszköz típusa<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(3)" class="sort">Foglalás időtartama<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(4)" class="sort">Hátralévő idő<i class="fas fa-sort sort-icon"></i></th>
				<th onclick="sortTable(5)" class="sort">Státusz<i class="fas fa-sort sort-icon"></i></th>
			</tr>
			<tr>
				<td class="sort mobile-view">1</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">2</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">2</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">1</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">2</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">2</td>
				<td>Monitor</td>
				<td>Asus</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">1</td>
				<td>Laptop</td>
				<td>Dell Vostro15</td>
				<td>2 nap</td>
				<td>1 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">2</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>1 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
			</tr>
			<tr>
				<td class="sort mobile-view">2</td>
				<td>Laptop</td>
				<td>Vostro15</td>
				<td>3 nap</td>
				<td>2 nap</td>
				<td>pl. lejárt vagy lefoglalva</td>
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
