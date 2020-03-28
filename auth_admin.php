<?php
//Vezető szerep azonosítása
    if ($userinfo['role'] != 2) {
		header("location:javascript://history.go(-1)");
		exit();
    }
?>
