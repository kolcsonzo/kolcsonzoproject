<?php
		require('db.php');
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($con, $query) or die(mysql_error());
		$userinfo = mysqli_fetch_assoc($result);
?>