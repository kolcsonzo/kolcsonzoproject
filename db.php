<?php
//sql kapcsolat
    $con = mysqli_connect("hsro.hu","nyilvantarto","szechenyi","nyilvantarto");

    if (mysqli_connect_errno()){
        echo "Sql hiba: " . mysqli_connect_error();
    }
?>
