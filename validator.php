<?php
$uname =  $_GET['uname'];
$pass =  $_GET['pass'];
if(isset($_GET['href'])){
	$hr = $_GET['href'];
}else{
	$hr = "http://192.168.1.77/dev/index.php";
}
$profile ="";
$position = "";
$user = "root";
$servidor = "localhost";
$database = "dev";
$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
$db = mysqli_select_db( $conection, $database ) or die ( "Ups! Well, it's going to be impossible to connect to the database" );
$query = "SELECT `position` FROM `users` WHERE (`name` = '$uname') and (`password` = '$pass')";
$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database");
	while ($columna = mysqli_fetch_array( $result )){
		session_start();
		$_SESSION["position"] = ($columna['position']);
		$position = ($columna['position']);
		setcookie("cposition","$position");
	}
$query1 = "SELECT `permission` FROM `company profiles` WHERE `profile` = '".$position."'";
$result1 = mysqli_query( $conection, $query1 ) or die ( "Something went wrong in the query to the database");
	while ($columna1 = mysqli_fetch_array( $result1 )){
		session_start();
		$profile = $columna1['permission'];
		$_SESSION["profile"] = $profile;
	}


	if($_SESSION["position"] == ""){
		echo "<script>var alert = confirm('THE USERNAME OR THE PASSWORD ARE INCORRECT(S),PLEASE TRY AGAIN');
		if (alert) {
			window.location.replace('.$hr.');
		}</script>";
		}else{
			echo "<script>window.location.replace('$hr?carge=".$_SESSION["position"]."&prof=".$profile."');</script>";
		}
?>