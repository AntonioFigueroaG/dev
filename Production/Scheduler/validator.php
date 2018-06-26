<?php
$uname =  $_GET['uname'];
$pass =  $_GET['pass'];
$hr = $_GET['href'];
$position = "";
		
				$user = "root";
				$servidor = "localhost";
				$database = "dev";
				$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
				$db = mysqli_select_db( $conection, $database ) or die ( "Ups! Well, it's going to be impossible to connect to the database" );
				$query = "SELECT `position` FROM `users` WHERE (`name` = '$uname') and (`password` = '$pass')";
				$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database");
				while ($columna = mysqli_fetch_array( $result )){
					$position = ($columna['position']);				
				}
				if($position == ""){
				echo "<center><h2>The username or the password are incorrect(s) try it again</h2></center>";
				echo "<center><object class='w3-container' style='width : 1800px; height : 600px' type='text/php' data='masterlogin.php'></object></center>";
				}else{
				echo "<script>window.location.replace('".$hr."?carge=".$position."');</script>";
				}
				
	?>