<?php
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
?>
<main>
	<article>
		<span class="text">Felhasználó hozzáadása</span><br>	
		<form action="" id="" method="">
			<input type="text" id="user-name" name="user-name" placeholder="Felhasználónév">
			<br>
			<input type="text" id="last-name" name="last-name" placeholder="Vezetéknév">
			<br>
			<input type="text" id="first-name" name="first-name" placeholder="Keresztnév">
			<br>
			<input type="email" id="user-email" name="user-email" placeholder="E-mail cím">
			<br>
			<input type="password" id="role" name="role" placeholder="Szerepkör">
			<br>
			<br>			
			<button class="button">Hozzáadás</button>
		</form>	
	</article>
</main>
<?php
	include('inc/bottom.php');
?>