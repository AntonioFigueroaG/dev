<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kioskos</title>
<link href="http://192.168.1.77/dev/modal.css" rel="stylesheet"></link>
</head>
	<style type="text/css">
	.botones{BORDER-RIGHT: #336699 1px solid;BORDER: #336699 1px solid;FONT-SIZE: 12px;WIDTH: 200px;HEIGHT: 100PX;CURSOR: hand;COLOR: #ffffff;
	FONT-FAMILY: Arial, Helvetica, sans-serif;BACKGROUND-COLOR: #31659c}
	.boton{background-color: #3f51b5;WIDTH: 100px;HEIGHT: 80PX;BORDER: #3f51b5 1px solid;COLOR: #ffffff;}
	.boton:hover{background-color: #283475;border-right: groove;  border-top: groove;}
	img {padding-top: 5px;}
	h1 {background-color: #3f51b5;margin: 0px;height: auto;align-content: center;}
	</style>
<!--call to the session and cokies var's-->
<?php
	session_start();
	$position = $_COOKIE["cposition"];
	if(isset($position)){
		if($position!='admin'){
			$admin = 'false';
		}else{
			$admin = 'true';
		}
	}else{
		$admin = 'false';
	}
?>
<body style="margin: 0px">
	<h1><center><img style="width: 310px" src="https://loadtrail.com/wp-content/uploads/2018/01/Webiste_LT-New-Logo_2018_FINAL-2.png" alt="Load Trail LLC" title="Load Trail LLC"></center><input type="button" value="Home" class="boton" onClick="home()"></h1>
	<center><h2>Kioskos</h2></center>
	<center><input type="button" class="botones" id="admin" name="admin" value="Admin" onClick="window.location.href=('setting.php');">
	<input type="button" class="botones" id="kik" name="" value="kiosko" onClick="start();"></center>
	<center><select style="width: 200px; margin-top: 20px; margin-left: 205px" name="action" id="sel">
	<option value="" disabled selected>-Select-.</option>
	<!--  Create the select of the page using the order and names of the kioskoSettings table -->
	<?php 
		$user = "root";
		$servidor = "192.168.1.77";
		$database = "dev";
		$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
		$db = mysqli_select_db( $conection, $database ) or die ("Ups! Well, it's going to be impossible to connect to the database");
		$query = "SELECT kiosko FROM kioskoSettings ORDER BY orden ASC";
		$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database1");
			while ($columna = mysqli_fetch_array( $result )){
				$AKI = $columna['kiosko'];
				echo("<option>".$columna['kiosko']."</option>");
			} 
	?>
	</select></center>
</body>
<script>
	//modifying the index if the acount is or not an admin
	if(<?php echo $admin; ?> == false){
		document.getElementById('admin').style.display='none';
	}

	function home(){
		window.location.replace('http://192.168.1.77/dev/index.php?carge=' + '<?php echo $position ; ?>');
	}
</script>
<script>
function start(){
	var select = document.getElementById("sel").options[document.getElementById("sel").selectedIndex].value;
	if (select.val == ""){
		alert("Define el kiosko en el que estaras trabajando");
	}else{
		window.location.href=('kiosko.php?kiosko='+select+'');
	}
}
</script>
</html>
