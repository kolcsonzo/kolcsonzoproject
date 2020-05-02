<?php
//azonosítás
	include("auth_session.php");
	
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>

<main>
	

				<?php echo '<script type="text/javascript">foglalasaim()</script>'; ?>
				<div id="foglalasaim_result" class=""></div> <!-- Ez a query visszatérési helye -->
</main>
<?php
	include('inc/bottom.php');
?>
