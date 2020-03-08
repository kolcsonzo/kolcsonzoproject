<?php
	include("auth_session.php");
	header("Content-Type: text/html; charset=utf-8");
	include('inc/top.php');
	//Felhasználók lekérdezése
	$query = "SELECT * FROM users";
    $result = mysqli_query($con, $query) or die(mysql_error());
	//Vezető szerepkörhöz kötött..
	if ($userinfo['role'] == 2 AND $_GET['delete'] != "" ) {
		$del_query = "DELETE FROM users WHERE username='".($_GET['delete'])."'";
		$execute = mysqli_query($con, $del_query) or die(mysql_error());
		//Tényleg volt törlés az sql-ben..?
		if (mysqli_affected_rows($con) == 1) {
		header("Refresh: 1, url=userdel.php?success=1");
		} else {
		header("Refresh: 1, url=userdel.php?success=2");
		}
	}
?>
<main>
	<article>
		<span class="text">Felhasználók</span></br>	
		<?php
			while ($row = $result->fetch_assoc()) {
				echo $row['username'];
				//Név mellé írjuk a szerepkört
				if ($row['role'] == 1) {
					echo " (Munkatárs)";
				} else {
					echo " (Vezető)";
				}
				//Ha vezető jogunk van, akkor törölhetünk
				if ($userinfo['role'] == 2) {
				echo '<a href="userdel.php?delete=' .$row['username']. '"> Törlés</a></br>';
				}
			}	//Sikerült-e a művelet?
				if ($_GET['success'] == 1) { echo "Sikeresen végrehajtva!"; }
				if ($_GET['success'] == 2) { echo "A művelet nem sikerült!"; }
			?>
	</article>
</main>

<?php
	include('inc/bottom.php');
?>