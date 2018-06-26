<!Doctype html><head>
	<title>Index</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="modal.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
	#container {margin:10% auto;text-align:center;} 
	.botones {background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;
	}
	
	
	@media screen and (max-width: 300px) {span.psw {display: block;float: none;}
	.cancelbtn {width: 100%;}}
	.dropdown-submenu {position: relative;}
	.dropdown-submenu .dropdown-menu {top: 0;left: 100%;margin-top: -1px;}
	.dropdown-submenu {position: relative;}
	.dropdown-submenu>.dropdown-menu {top: 100%;left: 30%;margin-top: -6px;margin-left: -1px;-webkit-border-radius: 0 6px 6px 6px;-moz-border-radius: 0 6px 6px 6px;border-radius: 0 6px 6px 6px;}
	.dropdown-submenu:hover>.dropdown-menu {display: block;}
	.dropdown-submenu>a:after {display: block;content: " ";float: right;width: 0;height: 0;border-color: transparent;border-style: solid;border-width: 5px 0 5px 5px;border-left-color: #cccccc;margin-top: 5px;margin-right: -10px;}
	.dropdown-submenu:hover>a:after {border-left-color: #ffffff;}
	.dropdown-submenu.pull-left {float: none;}
	.dropdown-submenu.pull-left>.dropdown-menu {left: -100%;margin-left: 10px;-webkit-border-radius: 6px 0 6px 6px;-moz-border-radius: 6px 0 6px 6px;border-radius: 6px 0 6px 6px;}
</style>
<body>
	<div class="w3-sidebar w3-bar-block w3-light-grey w3-card w3-animate-left" style="display:none" id="mySidebar">
	 	<button class="w3-bar-item w3-button w3-large"
	  onclick="w3_close()"> &times;</button>
		<input class="w3-bar-item w3-button w3-hover-blue" id="acounting" type="button" name="Acounting" onClick="javascript: window.location.href='Acounting';" value =" Acounting">
		<input class="w3-bar-item w3-button w3-hover-blue" id="hr" type="button" name="HR" onClick="javascript: window.location.href='HR';" value =" HR">
		<input class="w3-bar-item w3-button w3-hover-blue" id="it" type="button" name="IT" onClick="javascript: window.location.href='IT';" value =" IT">
		
		
		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px; *width: 180px;">
			<li class="dropdown-submenu ">
			<a tabindex="-1" id="production" class="dropdown-toggle topLevel" data-toggle="dropdown" href="#">Production
				<i class="icon icon-caret-right"></i>
			</a>
			<ul class="dropdown-menu">
				<li class="dropdown-submenu">
					<a href="Production/Scheduler/index.php">Scheduler</a>
					<ul class="dropdown-menu"></li>
						<li><a href="Production/Scheduler/scheduler.php?C=lt">lt</a></li>
						<li><a href="Production/Scheduler/scheduler.php?C=lm">lm</a></li>
						<li><a href="Production/Scheduler/scheduler.php?C=cl">cl</a></li>
						<li><a href="Production/Scheduler/scheduler.php?C=cm">cm</a></li>
						<li><a href="Production/Scheduler/LTOV.php">ltov</a></li>
					</ul>
				</li>
				<li class="dropdown-submenu">
					<a href="Production/Kiosko/index.php">Kiosko</a>
					<ul class="dropdown-menu">
						<li><a href="Production/Kiosko/setting.php">Admin settings</a></li>
						<li><a href="?<?php echo("carge=".$_GET['carge']."&sch=true");?>">Kiosko</a></li>
					</ul>
				</li>
			</ul>
			</li>
		</ul>
		<input class="w3-bar-item w3-button w3-hover-blue" id="safety" type="button" name="Safety" onClick="" value =" Safety">
		<input class="w3-bar-item w3-button w3-hover-blue" id="sales" type="button" name="Sales" onClick="javascript: window.location.href='Sales';" value =" Sales">
		<input class="w3-bar-item w3-button w3-hover-blue" id="shipping" type="button" name="Shiping" onClick="javascript: window.location.href='Shipping';" value =" Shipping">
		<input class="w3-bar-item w3-button w3-hover-blue" id="logout" type="button"  onClick="logout()" value =" Log out">
	</div> 	 
	<div id="main">
		<div class="w3-indigo">
		  <button id="openNav" class="w3-button w3-indigo w3-xlarge" onclick="w3_open()">&#9776;</button>
		  <div class="w3-container">
			<h1><center><img style="width: 310px" src="https://loadtrail.com/wp-content/uploads/2018/01/Webiste_LT-New-Logo_2018_FINAL-2.png" alt="Load Trail LLC" title="Load Trail LLC
			"></center></h1>
		  </div>
		</div>
		<center>
		<?php
			session_start();
			if(isset($_GET['carge'])){
				if(isset($_SESSION['profile'])){
					$ps = $_SESSION['profile'];
					$array = array("acounting", "hr", "it", "production", "safety", "sales" , "shipping");
					echo "<script>";
					for($i = 0; $i < 7; $i++){
						if(substr($ps,$i,1)=="1"){
							echo "document.getElementById('".$array[$i]."').style.display='block';";
						}else{
							echo "document.getElementById('".$array[$i]."').style.display='none';";
						}
					}
					echo "</script>";
				}else{

				}
			}else{
				session_start();
				unset($_SESSION["position"]);
				unset($_SESSION["profile"]);
				unset($_COOKIE["position"]);
				echo "<h2>You are not logged in yet, do you want to login now?</h2>";
				echo "<button onclick='mostrar()' class='positbtn' style='width:auto;'>Login</button>";
				echo "<script> document.getElementById('openNav').style.display = 'none'</script>";
			}
		?>
		<?php
		if(isset($_GET['sch'])){
			echo("<div id=container>");
			echo("<h3>We are working on your petition, please mark or select the configuration to the page</h3>");
			echo("<h5>Please select the kiosko to manage</h5>");
			echo("<center><select style='width: 200px; margin-top: 2%' name='action' id='sel'>");
			echo("<option value='' disabled selected>-Select-.</option>");
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
			echo("</select></center>");
			echo("<input type='button' style='margin-top: 3%' class='botones' id='kik' name='' value='kiosko' onClick='start();'>");
			echo("</div>");
		}
		?>
		<div id="id01" class="modal">
			<form class="modal-content animate" action="validator.php">
				<div class="imgcontainer">
					<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
				<div class="container">
					<label for="uname"><b>Username</b></label>
					<input id="uname" type="text" placeholder="Enter Username" name="uname" required>
					<label for="psw"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="pass" id="pass" required>
					<button class="positbtn" type="submit">Login</button>
						<label>
							<input type="checkbox" checked="checked" name="remember"> Remember me
						</label>
				</div>
				<div class="container" style="background-color:#f1f1f1">
					<center><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button></center>
					<span class="psw">Forgot <a href="#">password?</a></span>
				</div>
			</form>
		</div>
		</center>
	</div>
</body>
<script>
function start(){
	var select = document.getElementById("sel").options[document.getElementById("sel").selectedIndex].value;
	if (select.val == ""){
		alert("Define el kiosko en el que estaras trabajando");
	}else{
		window.location.href=('Production/Kiosko/kiosko.php?kiosko='+select+'');
	}
}
</script>
<script>
// Get the modal
var modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function w3_open() {
  document.getElementById("main").style.marginLeft = "20%";
  document.getElementById("mySidebar").style.width = "20%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
function myDropFunc() {
    var x = document.getElementById("demoDrop");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-blue";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-blue", "");
    }
}
function mostrar(){
	document.getElementById("id01").style.display="block";
}
function logout(){
	var alert = confirm("Are you shure to log out?");
		if (alert) {
			window.location.replace(' http://192.168.1.77/dev/index.php');
		}
}
</script>	

</html>