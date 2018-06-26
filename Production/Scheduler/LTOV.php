<html>
<head>
	

</head>
<style type="text/css">
	.botones{
		BORDER-RIGHT: #336699 1px solid;
		BORDER-TOP: #336699 1px solid;
		FONT-SIZE: 12px;
		BORDER-LEFT: #336699 1px solid;
		WIDTH: 90px;
		HEIGHT: 50PX;
		CURSOR: hand;
		COLOR: #ffffff;
		BORDER-BOTTOM: #336699 1px solid;
		FONT-FAMILY: Arial, Helvetica, sans-serif;
		BACKGROUND-COLOR: #31659c
	}
</style>
<body>
	<?php
		session_start();
		$position= $_SESSION["position"] ;	
	?>
	<input type="button" id="home" class="botones" onClick="home()" value="home">
	<input type="button" id="menu" class="botones" onClick="menu()" value="menu">
	</br> </br>
 <table border='1' cellpadding='0' cellspacing='0' width='100%' style="background-color:#CEE3F6" bordercolor='#FFFFFF'>
 	<tr>
		<th id="loadtrail1" width='25%'><h1>Load Trail Company</h1></th>
		<th id="loadmax1" width='25%'><h1>Load Max </h1> </th>
		<th id="como1" width='25%'><h1>Como</h1> </th>
		<th id="cuatrol1" width='25%'><h1>Cuatro l</h1>  </th>
 </tr>
 <tr> 
	<div>
	<td id="loadtrail2">
	<table width = '100%'>
	<tr>
      <th width='15%' style='font-weight: bold'>Name</th>    
      <th width='14%' style='font-weight: bold'>Line</th>   
	  <th width='27%' style='font-weight: bold'>Description</th>    
      <th width='22%' style='font-weight: bold'>Start Date</th>   
	  <th width='22%' style='font-weight: bold'>End Date</th> 
	 </tr>
	</table> 
	</td>
	</div>
	
	<div>
	<td id="loadmax2">
	<table width = '100%'>
	<tr>
     <th width='15%' style='font-weight: bold'>Name</th>    
      <th width='14%' style='font-weight: bold'>Line</th>   
	  <th width='27%' style='font-weight: bold'>Description</th>    
      <th width='22%' style='font-weight: bold'>Start Date</th>   
	  <th width='22%' style='font-weight: bold'>End Date</th> 
	 </tr>
	</table> 
	</td>
	</div>
	
	<div>
	<td id="como2">
	<table width = '100%'>
	<tr>
     <th width='15%' style='font-weight: bold'>Name</th>    
      <th width='14%' style='font-weight: bold'>Line</th>   
	  <th width='27%' style='font-weight: bold'>Description</th>    
      <th width='22%' style='font-weight: bold'>Start Date</th>   
	  <th width='22%' style='font-weight: bold'>End Date</th> 
	 </tr>
	</table> 
	</td>
	</div>
	
	<div>
	<td id="cuatrol2">
	<table width = '100%'>
	<tr>
      <th width='15%' style='font-weight: bold'>Name</th>    
      <th width='14%' style='font-weight: bold'>Line</th>   
	  <th width='27%' style='font-weight: bold'>Description</th>    
      <th width='22%' style='font-weight: bold'>Start Date</th>   
	  <th width='22%' style='font-weight: bold'>End Date</th> 
	 </tr>
	</table> 
	</td>
	</div>

 </tr>
 
 <tr>
 <td>
<div id="loadtrail3" >  

  <table border='1' cellpadding='0' cellspacing='0' width='100%' style="background-color:#CEE3F6" bordercolor='#FFFFFF'>  
  
<?php
date_default_timezone_set('america/mexico_city');
$user = "root";
$time = time();
$today = date("Y-m-d H:i:s", $time);
$a = 0;
				$servidor = "localhost";
				$database = "dev";
				$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
				$db = mysqli_select_db( $conection, $database ) or die ( "Ups! Well, it's going to be impossible to connect to the database" );
				$query = "SELECT * FROM scheduler WHERE startDate >= '$today' AND company='lt'";
				$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database1");				
				while ($columna = mysqli_fetch_array( $result )){
					$date = new DateTime ($columna['startDate']);
					$dateF =  date_format($date, 'Y/m/d H:i:s');
					$ed = new DateTime ($columna['endDate']);
					$enD =date_format($ed, 'Y/m/d H:i:s');
		
					echo "
						<tr>
							<th width='15%'>".$columna['name']."</th>";
					echo "
							<th width='14%'>".$columna['line']."</th>";
					echo "
							<td width='27%'>".$columna['description']."</td>";
					echo "
							<td width='22%'>".$dateF."</td>";
					echo "
							<td width='22%'>".$enD."</td></tr>";
					$a    =    $a + 1;
					
				} 
	   if($a==0){
		  echo "<center>There are no events</center>";
	  }
	  
					
?>  
	
   </table>   
</div>   
</td>
<td>
<div id = "loadmax3">  

  <table border='1' cellpadding='0' cellspacing='0' width='100%' style="background-color:#CEE3F6"  bordercolor='#FFFFFF'>  
    
<?php   
$user = "root";
$time = time();
$today = date("Y-m-d H:i:s", $time);
$b = 0;
				$servidor = "localhost";
				$database = "dev";
				$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
				$db = mysqli_select_db( $conection, $database ) or die ( "Ups! Well, it's going to be impossible to connect to the database" );
				$query = "SELECT * FROM scheduler WHERE startDate >= '$today' AND company='lm'";
				$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database2");			
				while ($columna = mysqli_fetch_array( $result )){
					
					$date = new DateTime ($columna['startDate']);
					$dateF =  date_format($date, 'Y/m/d H:i:s');
					$ed = new DateTime ($columna['endDate']);
					$enD =date_format($ed, 'Y/m/d H:i:s');
					
					echo "
						<tr>
							<th width='15%'>".$columna['name']."</th>";
					echo "
							<th width='14%'>".$columna['line']."</th>";
					echo "
							<td width='27%'>".$columna['description']."</td>";
					echo "
							<td width='22%'>".$dateF."</td>";
					echo "
							<td width='22%'>".$enD."</td></tr>";
					
					$b = $b + 1;
				} 
	   if($b==0){
		  echo "<center>There are no events</center>";
	  }
					
?>   
   </table>   
</div>   
</td>
<td>
<div id="como3">  


  <table border='1' cellpadding='0' cellspacing='0' width='100%' style="background-color:#CEE3F6" bordercolor='#FFFFFF'>  
     
<?php   
$user = "root";
$time = time();
$today = date("Y-m-d H:i:s", $time);
$c=0;
				$servidor = "localhost";
				$database = "dev";
				$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
				$db = mysqli_select_db( $conection, $database ) or die ( "Ups! Well, it's going to be impossible to connect to the database" );
				$query = "SELECT * FROM scheduler WHERE startDate >= '$today' AND company='cm'";
				$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database3");
	  
				while ($columna = mysqli_fetch_array( $result )){
					$date = new DateTime ($columna['startDate']);
					$dateF =  date_format($date, 'Y/m/d H:i:s');
					$ed = new DateTime ($columna['endDate']);
					$enD =date_format($ed, 'Y/m/d H:i:s');
					
					echo "
						<tr>
							<th width='15%'>".$columna['name']."</th>";
					echo "
							<th width='14%'>".$columna['line']."</th>";
					echo "
							<td width='27%'>".$columna['description']."</td>";
					echo "
							<td width='22%'>".$dateF."</td>";
					echo "
							<td width='22%'>".$enD."</td></tr>";
					$c = $c + 1;					
				}  
	   if($c==0){
		  echo "<center>There are no events</center>";
	  }
				
?>   
   </table>   
</div>   
</td>
<td>
<div id="cuatrol3">  

  <table border='1' cellpadding='0' cellspacing='0' width='100%' style="background-color:#CEE3F6" bordercolor='#FFFFFF'>  
     
<?php   
$user = "root";
$time = time();
$today = date("Y-m-d H:i:s", $time);
$d = 0;

				$servidor = "localhost";
				$database = "dev";
				$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
				$db = mysqli_select_db( $conection, $database ) or die ( "Ups! Well, it's going to be impossible to connect to the database" );
				$query = "SELECT * FROM scheduler WHERE startDate >= '$today' AND company='cl'";
				$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database4");
				while ($columna = mysqli_fetch_array( $result )){
					$date = new DateTime ($columna['startDate']);
					$dateF =  date_format($date, 'Y/m/d H:i:s');
					$ed = new DateTime ($columna['endDate']);
					$enD =date_format($ed, 'Y/m/d H:i:s');
					
					echo "
						<tr>
							<th width='15%'>".$columna['name']."</th>";
					echo "
							<th width='14%'>".$columna['line']."</th>";
					echo "
							<td width='27%'>".$columna['description']."</td>";
					echo "
							<td width='22%'>".$dateF."</td>";
					echo "
							<td width='22%'>".$enD."</td></tr>";
					
					$d = $d + 1;
				}  
	  if($d==0){
		  echo "<center>There are no events</center>";
	  }
?>   
   </table>   
</div>
</td>
</tr>   
</table>
</body> 

<script>
	if(<?php echo " '".$a."'";?>==0){
		div2 = document.getElementById('loadtrail2');
            div2.style.display = 'none';
	}
	
	if(<?php echo " '".$b."'";?>==0){
		div2 = document.getElementById('loadmax2');
            div2.style.display = 'none';
	}
	
	if(<?php echo " '".$c."'";?>==0){
		div2 = document.getElementById('como2');
            div2.style.display = 'none';
		
	}
	
	if(<?php echo " '".$d."'";?>==0){
		div2 = document.getElementById('cuatrol2');
            div2.style.display = 'none';
	}
	
	function home(){
		window.location.replace("http://192.168.1.77/dev/index.php?carge=<?php echo $position; ?>");
	}
	function menu(){
		window.location.replace("http://192.168.1.77/dev/Production/Scheduler/index.php");		
	}
</script> 

</html> 

