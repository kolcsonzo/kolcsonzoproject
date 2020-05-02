<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>

<main>
	

				<?php echo '<script type="text/javascript">foglalasaim()</script>'; ?>
				<div id="foglalasaim_result" class=""></div> <!-- Ez a query visszatérési helye -->

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
