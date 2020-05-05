<?php
//azonosítás
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
		<div class="pagename" style>
			<span class="text content-name">Naplózás</span>
			<div class="search_and_rowNr">
				<ul id="search-devices" class="kereso_lista-Nr">
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
					<li class="keresoNev" id="input-devices-mobile">
						<input type="text" id="keresoInput" oninput="myFunction()" placeholder="Keresés...">
					</li>
				</ul>	
			</div>
		</div>
		<div class="table-responsive">
		<table id="device" class="table table-hover" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Esemény</th>
					<th>Kezdeményező</th>
					<th>Időpont</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-05</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-05</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-05</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-01</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-02</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-03</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Felhasználó törlése</td>
					<td>Valaki</td>
					<td>2020-05-04</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Felhasználó létrehozása</td>
					<td>Admin</td>
					<td>2020-05-05</td>
				</tr>
			</tbody>
		</table>
		</div>
		<script>
			$(document).ready(function() {
			$('#device').DataTable( {
				"info":     false,
				"order": [[ 3, "desc" ]],
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
				
</main>
<?php
	include('inc/bottom.php');
?>