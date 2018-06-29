<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kiosko</title>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
</head>
<!--Animation on set new element-->
<style>
	@keyframes example {
	0%   {background-color:#C8C8C8;}
    25%   {background-color:#D7D7D7;}
    50%  {background-color:#C8C8C8;}
    75% {background-color:#D7D7D7;}
    100% {background-color:#C8C8C8;}
	}	
</style>
<!--//Animation on set new element-->
<?php
	date_default_timezone_set('america/Chihuahua');
	$kiosko = $_GET['kiosko'];
	$AKI = 0; //Actual kiosko id
	$AKA = ""; //Actual kiosko action
	$KSTI = ""; //Kiosko's name station Incoming
	$KSTA = ""; //Kiosko's name station Actual
	$KSTO = ""; //Kiosko's name station Outgoing
	$KIdI = 0;  //Kiosko's id Incoming
	$KIdO = 0;  //Kiosko's id Outgoing
	//First database query-Takes the AKI's value and the action-type of the kiosko
	$user = "root";
	$servidor = "192.168.1.77";
	$database = "dev";
	$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
	$db = mysqli_select_db( $conection, $database ) or die ("Ups! Well, it's going to be impossible to connect to the database");
	$query = "SELECT orden,action,kiosko FROM kioskoSettings WHERE kiosko ='".$kiosko."'";
	$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database1");
		while ($columna = mysqli_fetch_array( $result )){
			$AKI = $columna['orden'];
			$AKA = $columna['action'];
			$KSTA = $columna['kiosko'];
		}
	//End of the query

	$KIdI = $AKI-1;//Setting Incoming Id
	$KIdO = $AKI+1;//Setting Outgoing Id

	//Second database query-Set KSTI and KSTO
	for($i = 0; $i<= 1; $i++){
		if($i == 0){$query = "SELECT kiosko FROM kioskoSettings WHERE orden =$KIdI ORDER BY orden ASC";}
		if($i == 1){$query = "SELECT kiosko FROM kioskoSettings WHERE orden =$KIdO ORDER BY orden ASC";}
		$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database2");
		while ($columna = mysqli_fetch_array( $result )){
			if($i == 0){$KSTI = $columna['kiosko'];}
			if($i == 1){$KSTO = $columna['kiosko'];}
		}
	}
	//End of the query
?>
<!--Style of the page-->
<style>
	.c{background-color: #2CB940; border-color:#1A5C17;border-left:none; border-top: none; border-bottom:10%; width: 150px; height: 75px;}
	.c:hover{background-color: #1AE937; border-color:#1A5C17;border-left:none; border-top: none; border-bottom:10%; width: 150px; height: 75px;}
	.columnaF {width:24.81%;float:left;margin: 0px;}
	.columnaC {width:50%;float:left;margin: 0px;border-left-style: groove;border-right-style: groove;}
	.hed {background-color: #3F4BD7;}
	.field{text-align: center;border-radius: 1px;}	
	.selected {background-color: brown;color: #FFF;}
	@media (max-width: 500px) {.columna {width:auto;float:none;}}
	td {text-align: center;background-color:#C8C8C8;transition: 0.5s;width: 0.0000001%;padding: 10px;cursor: pointer;}
	td:hover {background-color:#7D7D7D; padding: 15px; cursor: pointer;animation-iteration-count: 0;}
	input{font-size:18px;padding:10px 10px 10px 5px;display:block;width:300px;border:none;border-bottom:1px solid #757575;}
</style>
<!--//End of style-->
<body style="background-color: #FFFFFF; margin: 0px">
	<div class='columnaF'>
		<center>
			<div class='hed'>
				<table class='table'>
					<thead>
						<tr>
							<th><h3>Incoming</h3></th>
						</tr>
					</thead>
				</table>
			</div>
			<div>
				<table class='table' id='table'>
					<tbody>
						<?php
						//Third database query-Get the vin's of the table
						if($kiosko != "start"){
							$x = 0;
							$i = 0;
							$query = "SELECT vin FROM kioskoLog ORDER BY vin ASC";
							$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database3");
							while ($columna = mysqli_fetch_array( $result )){
								if($columna[0] != $i){
									$vim[$x] = $columna['vin'];
									$x++;
								}else{
									
								}
								$i = $columna[0];
							}
							//fourth database query-Get the vin's max(id) of the table
							for($r = 0; $r < count($vim); $r++){
								$query = "SELECT max(id) FROM kioskoLog WHERE vin=".$vim[$r]."";
								$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database4");
								while ($columna = mysqli_fetch_array( $result )){
									$vimid[$r] = $columna[0];
								}
							}
							//Last query to the database take all of the last id of the vin's and shows it if is nescesary
							for($r = 0; $r < count($vimid); $r++){
								$query = "SELECT * FROM kioskoLog WHERE id=".$vimid[$r]."";
								$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database5");
								while ($columna = mysqli_fetch_array( $result )){
									if($AKA!="start-end"){
										if($columna['station']==$KSTI){
											$query1 = "SELECT description FROM pruebas WHERE vin=".$columna['vin']."";
											$result1 = mysqli_query( $conection, $query1 ) or die ( "Something went wrong in the query to the database6");
											while ($columna1 = mysqli_fetch_array( $result1 )){
											$variab[]=array("id" => $columna['id'], "station" => $columna['station'], "action" => $columna['action'], "stamp" => $columna['stamp'],"vin" => $columna['vin'], "description" => $columna1['description']);
											}
											echo("<tr>");
											echo("<td style='animation-name: example;animation-duration: 4s;animation-iteration-count: 1;'>".$columna['vin']."</td>");
											echo("</tr>");
										}
									}else{
										if($columna['station']==$KSTI){
											$query1 = "SELECT description FROM pruebas WHERE vin=".$columna['vin']."";
											$result1 = mysqli_query( $conection, $query1 ) or die ( "Something went wrong in the query to the database6");
											while ($columna1 = mysqli_fetch_array( $result1 )){
											$variab[]=array("id" => $columna['id'], "station" => $columna['station'], "action" => $columna['action'], "stamp" => $columna['stamp'],"vin" => $columna['vin'], "description" => $columna1['description']);
											}
											echo("<tr>");
											echo("<td style='animation-name: example;animation-duration: 4s;animation-iteration-count: 1;'>".$columna['vin']."</td>");
											echo("</tr>");
										}
										if($columna['station']==$KSTA && $columna['action']!='end'){
											$query1 = "SELECT description FROM pruebas WHERE vin=".$columna['vin']."";
											$result1 = mysqli_query( $conection, $query1 ) or die ( "Something went wrong in the query to the database6");
											while ($columna1 = mysqli_fetch_array( $result1 )){
												$variab[]=array("id" => $columna['id'], "station" => $columna['station'], "action" => $columna['action'], "stamp" => $columna['stamp'],"vin" => $columna['vin'], "description" => $columna1['description']);
											}
											echo("<tr>");
											echo("<td onClick='document.getE'; style='animation-name: example;animation-duration: 4s;animation-iteration-count: 1;'>".$columna['vin']."</td>");
											echo("</tr>");
										}
									}
								}
							}
							$objJSON = json_encode($variab);
						}else{
							$query = "SELECT * FROM pruebas where started = 0";
							$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database5");
								while ($columna = mysqli_fetch_array( $result )){
									$variaa[]=array("vin" => $columna['vin'], "description" => $columna['description']);
									echo("<tr>");
									echo("<td style='animation-name: example;animation-duration: 4s;animation-iteration-count: 1;'>".$columna['vin']."</td>");
									echo("</tr>");
								}
								$objJSONS = json_encode($variaa);
						}
						?>
					</tbody>
				</table>
			</div>
		</center>
	</div>
	<div class="columnaC">
		<center>
			<div class="hed">
				<table class="table">
					<thead>
						<tr>
							<th><h3><?php echo(strtoupper($kiosko)); ?></h3></th>
						</tr>
					</thead>
				</table>
			</div>
			<div>
				<table class="table"style="padding-top: 20%">
					<thead>
						<tr>
							<?php
							if($AKA != "start"){
								echo("<th><h3><center>Trail vin: <br><input type='text' class='field' id='vin' value='' readonly></center></h3></th>");
							}else{
								echo("<th><h3><center>Trail vin: <br><input type='number' class='field' id='vin' value='' min='1000000' max='9999999'></center></h3></th>");
							}
							?>
						</tr>
					</thead>
				</table>
				<table class='table'>
					<thead>
						<tr>
						<?php
						if($AKA != "start"){
							echo("<th><h3 style='padding-top: 10%'><center>Trail Description: <br><input type='text' class='field' id='vinD' value='' readonly></center></h3></th>");
						}else{
							echo("<th><h3 style='padding-top: 10%'><center>Trail Description: <br><input type='text' class='field' id='vinD' value=''></center></h3></th>");
						}
						?>
						</tr>
					</thead>
				</table>
				<table class="table">
					<thead>
						<tr>
							<?php
								if($AKA == "pass"){
									echo("<button onclick=\"save('pass')\" class='c'>pass</button>");
								}else{
									if($AKA=="start-end"){
										echo("<button id='st' onclick=\"save('start')\" class='c'>start</button>");
										echo("<button onclick=\"save('end')\" class='c'>end</button>");
									}else{
										if($AKA=="start"){
											echo("<button onclick=\"start()\" class='c'>start</button>");
										}
									}
								}
							?>
						</tr>
					</thead>
				</table>
			</div>
			<div>
			
			</div>
		</center>
	</div>
	<div class="columnaF">
		<center>
			<div class="hed">
				<table class="table">
					<thead>
						<tr>
							<th><h3>Outgoing</h3></th>
						</tr>
					</thead>
				</table>
			</div>
			<div> 
				<table class="table">
					<tbody>
						<?php
							//Third database query-Get the vin's of the table
							$x = 0;
							$i = 0;
							$query = "SELECT vin FROM kioskoLog  ORDER BY vin ASC";
							$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database3");
							while ($columna = mysqli_fetch_array( $result )){
								if($columna[0] != $i){
									$vim[$x] = $columna['vin'];
									$x++;
								}else{
									
								}
								$i = $columna[0];
							}
							//fourth database query-Get the vin's max(id) of the table
							for($r = 0; $r < count($vim); $r++){
								$query = "SELECT max(id) FROM kioskoLog WHERE vin=".$vim[$r]."";
								$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database4");
								while ($columna = mysqli_fetch_array( $result )){
									$vimid[$r] = $columna[0];
								}
							}
							//Last query to the database take all of the last id of the vin's and shows it if is nescesary
							for($r = 0; $r < count($vimid); $r++){
								$query = "SELECT * FROM kioskoLog WHERE id=".$vimid[$r]."";
								$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database5");
								while ($columna = mysqli_fetch_array( $result )){
									if($columna['station']== $KSTA){
										echo("<tr>");
										echo("<td style='animation-name: example;animation-duration: 4s;animation-iteration-count: 1;'>".$columna['vin']."</td>");
										echo("</tr>");
									}
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</center>
	</div>
</body>
<script>
	
function start(){
	var x = $("#vin").val();
	var y = $("#vinD").val();
	var date = moment().format('YYYY-MM-DD H:mm:ss');
	var parametros = {
		"station" : "start",
		"action" : "start",
		"stamp" : date,
		"vin" : x,
		"description" : y
	};
	$.ajax({
		data:  parametros,
		url:   'kioskoMSC/startTrail.php',
		type:  'post',
		beforeSend: function () {
		},
		success:  function () {
			var x = $("#vin").val('');
			var y = $("#vinD").val('');
			location.reload();
		}
	});
}
function save(action){
	var x = $("#vin").val();
	var y = $("#vinD").val();
	if(y != "" && x!= "" ){
		var date = moment().format('YYYY-MM-DD H:mm:ss');
		var parametros = {
			"station" : "<?php echo($KSTA); ?>",
			"action" : action,
			"stamp" : date,
			"vin" : x,
			"description" : y
		};
		$.ajax({
			data:  parametros,
			url:   'kioskoMSC/SaveProg.php',
			type:  'post',
			beforeSend: function () {
			},
			success:  function () {
				var x = $("#vin").val('');
				var y = $("#vinD").val('');
				location.reload();
			}
		});
	}	
}
$("#table tr").click(function(){
   	$(this).addClass('selected').siblings().removeClass('selected');    
   	var value=$(this).find('td').html();
	none(value);  
});

$('.ok').on('click', function(e){
    alert($("#table tr.selected td:first").html());
});
function none(t){
	if("<?php echo($kiosko); ?>" != "start"){
		var json =<?php if(isset($objJSON)){echo($objJSON);}else{echo("null");} ?>;
		for(x = 0; x < json.length; x++){
			if(json[x].vin == t){
				var s = document.getElementById('vin');
				s.value = (json[x].vin);
				var s = document.getElementById('vinD');
				s.value = (json[x].description);
		   }
		}
	}else{
		var json =<?php if(isset($objJSONS)){echo($objJSONS);}else{echo("null");} ?>;
		for(x = 0; x < json.length; x++){
			if(json[x].vin == t){
				var s = document.getElementById('vin');
				s.value = (json[x].vin);
				var s = document.getElementById('vinD');
				s.value = (json[x].description);
		   }
		}
	}
}
</script>
</html>
