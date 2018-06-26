<html>
	<head>
		<title>Scheduler</title>
		</div>
	</head>
	<style type="text/css">
	.botones{
		BORDER-RIGHT: #336699 1px solid;
		BORDER-TOP: #336699 1px solid;
		FONT-SIZE: 12px;
		BORDER-LEFT: #336699 1px solid;
		WIDTH: 100px;
		HEIGHT: 100PX;
		CURSOR: hand;
		COLOR: #ffffff;
		BORDER-BOTTOM: #336699 1px solid;
		FONT-FAMILY: Arial, Helvetica, sans-serif;
		BACKGROUND-COLOR: #31659c
	}
		.boton:hover{
		background-color: #283475;
		border-right: groove;  
		border-top: groove;  
	}
	img {
		padding-top: 5px;
	}
	h1 {
    	background-color: #3f51b5;
		margin: 0px;
		height: auto;
		align-content: center;
	}
		.boton{
		background-color: #3f51b5;
		WIDTH: 100px;
		HEIGHT: 80PX;
		BORDER-RIGHT: #3f51b5 1px solid;
		BORDER-TOP: #3f51b5 1px solid;
		BORDER-LEFT: #3f51b5 1px solid;
		BORDER-BOTTOM: #3f51b5 1px solid;
		COLOR: #ffffff;
	}
	</style>
	<?php
		session_start();
		$position = $_SESSION["position"] ;
		if(isset($_GET['editview'])){
			$editview =  $_GET['editview'];
			
		}else{
			$editview =  "undefined";
		}
	?>
	<body>
	<h1><center><img style="width: 310px" src="https://loadtrail.com/wp-content/uploads/2018/01/Webiste_LT-New-Logo_2018_FINAL-2.png" alt="Load Trail LLC" title="Load Trail LLC"></center><input type="button" value="Home" class="boton" onClick="home()"></h1>
	<center><h2>Scheduler</h2></center>
	<div align="center">
		<input class="botones" type="button" name="Loadtrail" onClick="javascript: window.location.href='scheduler.php?C=lt';" value =" Load trail">
		<input class="botones" type="button" name="Load max" onClick="javascript: window.location.href='scheduler.php?C=lm';" value =" Load max">
		<input class="botones" type="button" name="4L"  onClick="javascript: window.location.href='scheduler.php?C=cl';" value =" Cuatro l">
		<input class="botones" type="button" name="Como" onClick="javascript: window.location.href='scheduler.php?C=cm';" value ="Como">
		<input class="botones" type="button" name="LTOV" onClick="javascript: window.location.href='LTOV.php';" value ="LTOV">
	</div>
	</body>	
	

	<script>
	function home(){
		window.location.replace("http://192.168.1.77/dev/index.php?carge=<?php echo $position; ?>");
	}
	</script>
</html>