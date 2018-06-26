<?php
$date = date_create_from_format('d/m/Y', $_POST['dateF']);
$dateF = date_format($date, 'Y-m-d');
$time = $_POST['timeF'];
$time = strtotime($time);
$timeF = date("H:i:s", $time);
$StartDate = $dateF." ".$timeF ;
echo $StartDate
?>
