<!doctype html>
<html><head>
<meta charset="utf-8">
	<title>Kioskos admin</title>
	 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link href="https://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"></link>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>
<?php
	session_start();
	$position = $_COOKIE["cposition"];
	
?>

<style type="text/css">
	[draggable] { user-select: none;}
	
	.column:hover {border: 2px dotted #666666; background-color: #ccc; border-radius: 10px; box-shadow: inset 0 0 3px #000; cursor: move;}
	
	.boton {background-color: #3f51b5; WIDTH: 80px; HEIGHT: 40PX;	BORDER-RIGHT: #3f51b5 1px solid; BORDER-TOP: #3f51b5 1px solid; BORDER-LEFT: #3f51b5 1px solid; BORDER-BOTTOM: #3f51b5 1px solid; COLOR: #ffffff; margin-top: 15px;}
	
	.boton:hover{background-color: #283475;	border-right: groove; border-top: groove;}
	
	th,tr {text-align: center;}
	
	table, th, td {padding: 15px;}
	
	ul { list-style: none }
	
	li {margin-bottom: 20px; background-color: lightblue; text-align: center;}
	
	.hover{background-color: #5DADE2; border-bottom: groove;  }
	
	.hiddens { visibility: hidden;}
</style>
<body>
	<!--modal crear-->
	<div id="create" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create</h4>
				</div>
				<div class="modal-body">
					<center><input type="text" id="namek" size="35"  placeholder="Kiosko Name" style="text-align:center" autofocus>
						<select name="action" id="sel">
							<option value="" disabled selected>-Select Action-.</option>
							<option>start</option>
							<option>start-end</option>
							<option>pass</option>
						</select>
					</center>
				</div>
				<div class="modal-footer">
					<button id="createsevents" type="button" class="btn btn-default">Acept</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript: window.location.reload()">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--termina modal crear-->
	<!--modal editar-->
	<div id="edit" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit</h4>
				</div>
				<div class="modal-body">
					<div id="primero">	
						<center><label>Escoge el nombre del kiosko</label></center></br>
						<select style="width: 200px; margin-top: 20px; margin-left: 205px" name="action" id="seledit">
						<option value="" disabled selected>-Select-.</option>
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
						</select>
							<input type="button" id="aceptar" onClick="aceptar()"  value="Select">
					</div>
					<div id="segundo" style="visibility:hidden">
						<center><input type="text" id="namekiosko">
						<select name="action" id="selaction">
							<option value="" disabled selected>-Select Action-</option>
							<option>start</option>
							<option>start-end</option>
							<option>pass</option>
						</select></center>
					</div>
				</div>
				<div class="modal-footer">
					<button id="botonedit" style="visibility:hidden" type="button" class="btn btn-default" onClick="editar()">Edit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerrar()">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--termina modal editar-->
	<!--menu-->
	<div class="w3-sidebar w3-bar-block w3-light-grey w3-card w3-animate-left" style="display:none" id="mySidebar">
		<button class="w3-bar-item w3-button w3-large" onclick="w3_close()"> &times;</button>
		<input class="w3-bar-item w3-button w3-hover-blue" id="create" type="button" name="create" onClick="Create()" value ="&#9998; Create">
		<input class="w3-bar-item w3-button w3-hover-blue" id="edit" type="button" name="edit" onClick="Edit()" value ="&#9999; Edit">
		<input class="w3-bar-item w3-button w3-hover-blue" id="eliminar" type="button" name="delete" onClick="eliminar()" value =" &#10006; Delete">
		<input class="w3-bar-item w3-button w3-hover-blue" id="menu" type="button" name="menu" onClick="menu()" value ="&#9783; Menu">
		<input class="w3-bar-item w3-button w3-hover-blue" id="home" type="button" name="home" onClick="home()" value ="&#9751; Home">
	</div> 
	<div id="main">
		<div class="w3-indigo">
		  <button id="openNav" class="w3-button w3-indigo w3-xlarge" onclick="w3_open()">&#9881;</button>
		  <div class="w3-container">
			<h1><center><img style="width: 310px" src="https://loadtrail.com/wp-content/uploads/2018/01/Webiste_LT-New-Logo_2018_FINAL-2.png" alt="Load Trail LLC" title="Load Trail LLC"></center></h1>
		  </div>
		</div>
	<!--termina menu-->
	</br>
	<center>
		<table width="100%" height="100%" id="table">
		    <tr>
				<th width="33%"><h1>Kiosko</h1></th>  
				<th width="33%"><h1>Action</h1></th>
				<th width="33%"><h1>Index</h1></th>
			</tr>
			<tr>
				<th id="kiac" width="33%"> 
					<ul id="sortable" class="sortable">
						<?php
							require_once('settingsMSC/sortable.php');
							$elementos = get_elementos();
							foreach ($elementos as $elemento) {
							?>
							<li class="ui-state-default" id="elemento-<?php echo $elemento['id']; ?>" name="<?php echo $elemento['id']; ?>">
								<input type="checkbox" class="hiddens" name="checkboxes" id="<?php echo $elemento['id']; ?>"> <label for="<?php echo $elemento['id']; ?>">
								<?php echo $elemento['kiosko']; ?></label>
							</li>
						<?php } ?>
					</ul>					
				</th>
				<th id="kiac" width="33%"> 
					<ul id="sortablea" class="sortable">
						<?php
							require_once('settingsMSC/sortable.php');
							$elementos = get_elementos();
							foreach ($elementos as $elemento) {
							?>
							<li class="ui-state-default" id="elemento-<?php echo $elemento['id']; ?>_2" name="<?php echo $elemento['id']; ?>">
								
								<label> <?php echo $elemento['action']; ?></label>
							</li>
						<?php } ?>
					</ul>					
				</th>
				<th width="33%">
					<ul id="sortablei">
						<?php
							require_once('settingsMSC/sortable.php');
							$elementos = get_elementos();
							foreach ($elementos as $elemento) {
							?>
							<li class="ui-state-default" id="elemento-<?php echo $elemento['id']; ?>_3" name="<?php echo $elemento['id']; ?>">
								<label><?php echo $elemento['orden']; ?></label>
										
							</li>
						<?php } ?>
					</ul>
				</th>
			</tr>
		</table>
	</center>
<center><input type="button" class="boton" id="borrar" value="Delete" onClick="javascript: var parametros={
				'ida': b
			};	$.ajax({
			data: {'b':JSON.stringify(b)},
			url:   'settingsMSC/deleted.php',
			type:  'post',
			beforeSend: function () {
			},
			success:  function (response) {
				window.location.reload();
			}
		}); " style="visibility:hidden">
<input type="button" class="boton" id="cancelar" value="Cancel" onClick="cancelar()" style="visibility:hidden"></center>

<?php
	$conexion = mysqli_connect("192.168.1.77","root","toor")or die ("Unable to connect to the Database server");
	$db = mysqli_select_db($conexion,"dev")or die ("Ups! Well, it's going to be impossible to connect to the database");
	$consultas = "SELECT * FROM kioskoSettings WHERE 1";
	$result = mysqli_query( $conection, $consultas ) or die ( "Something went wrong in the query to the database1");
		while ($columna = mysqli_fetch_array( $result )){
			$variab[]=array("kiosko" => $columna['kiosko'], "action" => $columna['action'], "orden" => $columna['orden'], "id" => $columna['id']);
		}
	$objJSON = json_encode($variab);
?>
</body>
<script>
	var ids="null";
	var arr = [];
	var b = [];
	var c=0;
	var selectkiosko="null";
	<?php
		$user = "root";
		$servidor = "192.168.1.77";
		$database = "dev";
		$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
		$db = mysqli_select_db( $conection, $database ) or die ("Ups! Well, it's going to be impossible to connect to the database");
		$query = "SELECT Max(id) FROM kioskoSettings";
		$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database1");
			while ($columna = mysqli_fetch_array( $result )){
				$index = $columna[0];
			}
	
	?>
	//funcion crear eventos
	function Create(){
		$("#create").modal();
	}
	var i=<?php  echo $index+1; ?>;
	$("#createsevents").click(function () {
		var select = $('#sel').val();
		var nameks = $('#namek').val();
		var sort = $('#sortable');	
		
		if(nameks==""){
			alert("Please fill kiosko");
			$('#namek').focus();
		}else{
			if(select==null){
				alert("Please fill action");
				$('#select').focus();
			}else{
				var parametros={
				"nameks": nameks,
				"select": select,
				"orden": i
				};
				$.ajax({
					data: parametros,
					url:   'settingsMSC/insert.php',
					type:  'post',
					beforeSend: function () {
					},
					success:  function (response) {	
						if(response=="Existing kiosko"){
							alert(response);
							$('#namek').val("");
							$('#namek').focus();
						}else{
							$("#sortable").append(' <li class="ui-state-default" id="'+i+'"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><input type="checkbox" class="hidden" name="checkboxes" id="'+i+'"  /><label for="'+i+'">'+nameks+'</label></li>');
							$("#sortablea").append(' <li class="ui-state-default" id="'+i+'"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><label>'+ select +'</label></li>');
							$("#sortablei").append(' <li class="ui-state-default" id="'+i+'"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span ><label>'+ i +'</label></li>'); 

							 $('#namek').val("");
							 $('#sel').val("");
							 $('#namek').focus();
						}
					}
				});
					
			}
		}
		 i=i+1;

});	
	//funciones para editar
	function Edit(){
		$("#edit").modal();
	}
	function aceptar(){	
		var combo = document.getElementById("seledit");
		selectkiosko = combo.options[combo.selectedIndex].text;	

		if(selectkiosko=="-Select-."){
			alert("Please fill name");
		}else{
			var primero = document.getElementById("primero");
			primero.style.visibility = "hidden";

			var segundo = document.getElementById("segundo");
			segundo.style.visibility = "visible";

			var boton = document.getElementById("botonedit");
			boton.style.visibility = "visible";

			document.getElementById("namekiosko").value = selectkiosko;
			var json =<?php if(isset($objJSON)){echo($objJSON);}else{echo("null");} ?>;
			for(x = 0; x < json.length; x++){
				if(json[x].kiosko == selectkiosko){
					var sel = document.getElementById("selaction"); 
					sel.value = (json[x].action);
			   }
			}
		}
	}
	function editar(){
		var unamek = document.getElementById("namekiosko").value;
		
		var uaction = document.getElementById("selaction");
		var naction = uaction.options[uaction.selectedIndex].text;	
		
		if(unamek==""){
			alert("Please fill name");
		}else{
			if(naction=="-Select Action-"){
				alert("Please fill action");
			}else{
				var parametros={
				"unameks": unamek,
				"nactions": naction,
				"viejonamek": selectkiosko
			};
				$.ajax({
					data: parametros,
					url:   'settingsMSC/edit.php',
					type:  'post',
					beforeSend: function () {
					},
					success:  function (response) {	
						if(response=="Existing kiosko"){
							alert(response);
							document.getElementById("namekiosko").focus();
						}else{
						window.location.reload();
						}
					}
				});
			}
		}
	}
	function cerrar(){
		var primero = document.getElementById("primero");
		primero.style.visibility = "visible";

		var segundo = document.getElementById("segundo");
		segundo.style.visibility = "hidden";

		var boton = document.getElementById("botonedit");
		boton.style.visibility = "hidden";

		document.getElementById("namekiosko").value = "";
		document.getElementById("seledit").value = "";
		
		w3_close();
	}
	//funciones para eliminar
	function eliminar(){
		document.getElementById("main").style.marginLeft = "0%";
		document.getElementById("mySidebar").style.display = "none";
		document.getElementById("openNav").style.display = "inline-block";
		
		button = document.getElementById('borrar');
		button.style.visibility = "visible";
		buttonc = document.getElementById('cancelar');
		buttonc.style.visibility = "visible";
		
		for (var x=0;x<i;x++){
			$("#"+x).toggleClass('hiddens');
		}
		$( ':checkbox' ).on( 'click', function() {
			if( $(this).is(':checked') ){
				arr.push($(this).attr("id"));
				b =arr.map(Number);
				c=c+1;
			}else {
				var qid = $(this).attr("id");
				for(var x=0;x<arr.length;x++){
					if(qid==arr[x]){
						arr.splice(x,1);
						b =arr.map(Number);
						c=c-1;
					}
				}
		}
	});
  }	

	function cancelar(){
		button = document.getElementById('borrar');
		button.style.visibility = "hidden";
		buttonc = document.getElementById('cancelar');
		buttonc.style.visibility = "hidden";
		for (var x=0;x<i;x++){
			$("#"+x).toggleClass('hiddens');
		}
	}
	//funciones del menu
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
	
	//funciones de diseño-presentacion
	$(document).on('mouseover', 'li', function() {
     	var id = $(this).attr("id");
		for(var x = 0; x <= id.length; x++){
			if(id.substring(x,x+1)=="_"){
				var elemento = id.substring(0,x);
			}
		}
		if(elemento == undefined){
		 	var elemento = id;
		 }
		var elcol1 = elemento;
		var elcol2 = elemento + "_2";
		var elcol3 = elemento + "_3";
		$("#"+elcol1).addClass("hover");
		$("#"+elcol2).addClass("hover");
		$("#"+elcol3).addClass("hover");
	});	
	$(document).on('mouseout', 'li', function() {
     	var id = $(this).attr("id");
		for(var x = 0; x <= id.length; x++){
			if(id.substring(x,x+1)=="_"){
				var elemento = id.substring(0,x);
			}
		}
		if(elemento == undefined){
		 	var elemento = id;
		 }
		var elcol1 = elemento;
		var elcol2 = elemento + "_2";
		var elcol3 = elemento + "_3";
		$("#"+elcol1).removeClass("hover");
		$("#"+elcol2).removeClass("hover");
		$("#"+elcol3).removeClass("hover");	
	});
	
		 $( function() {
		$( "#sortable" ).sortable({
			update: function(event, ui) {
				var orden = $(this).sortable('toArray').toString();
					$.ajax({
						url: 'settingsMSC/st.php',
						data: {"data": orden},
						type: 'post'
					}).done(function(data) {
						window.location.reload();
				});
			}
		});

		$( "#sortable" ).disableSelection();
	  }); 
	
	function home(){
		window.location.replace('http://192.168.1.77/dev/index.php?carge=' + '<?php echo $position ; ?>');
	}
	function menu(){
		window.location.replace('http://192.168.1.77/dev/Production/Kiosko/index.php?carge=' + '<?php echo $position ; ?>');
	}
</script>
</html>
