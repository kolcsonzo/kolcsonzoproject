<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
	<article>
		<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 <select class  ="form-control" name="state" id="maxRows">
				<option value="5000">Összes sor...</option>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="70">70</option>
				<option value="100">100</option>
			</select>
		</div>
		<table class="table table-striped table-class" id= "table-id">
			<tr>
				<th>ID</th>
				<th>Név</th>
				<th>Max. foglalás</th>
				<th>Típus</th>
				<th>Státusz</th>
				<th>Tárolási pozíció</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Projektor</td>
				<td>3 nap</td>
				<td>Epson</td>
				<td>Foglalt</td>
				<td>SP_506</td>
			</tr>
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>Foglalt</td>
				<td>SP_507</td>
			</tr>
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
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>Foglalt</td>
				<td>SP_507</td>
			</tr>
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
				<td>2</td>
				<td>Monitor</td>
				<td>3 nap</td>
				<td>Samsung</td>
				<td>Foglalt</td>
				<td>SP_507</td>
			</tr>
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
			<script type="text/javascript">
				getPagination('#table-id');
						//getPagination('.table-class');
						//getPagination('table');
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-36251023-1']);
			  _gaq.push(['_setDomainName', 'jqueryscript.net']);
			  _gaq.push(['_trackPageview']);

			  (function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			</script>
		</div>	
	</article>
</main>
<?php
	include('inc/bottom.php');
?>