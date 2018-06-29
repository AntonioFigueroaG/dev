<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VIN</title>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<style>
	form{margin: 0 auto; width: 400px; padding: 1em; border: 1px solid #CCC; border-radius: 1em; background-color:whitesmoke;}
	
	form div + div { margin-top: 1em;}	
	label {display: inline-block; width: 90px; text-align: right;}
	
	input, textarea {font: 1em sans-serif; width: 300px; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999;}
	
	input:focus, textarea:focus { border-color: #000;}
	
	textarea {vertical-align: top; height: 5em; resize: vertical;}
	
	img {padding-top: 5px;}
	h1 {background-color: #3f51b5;margin: 0px;height: auto;align-content: center;}
	
</style>
<body style="margin: 0px" bgcolor="#C6C6C6">
		<div id="cabecera"><h1><center><img style="width: 310px" src="https://loadtrail.com/wp-content/uploads/2018/01/Webiste_LT-New-Logo_2018_FINAL-2.png" alt="Load Trail LLC" title="Load Trail LLC"></center></h1>
		<center><h2>Create vin</h2></center></div>
		</br>
	<center>
		<form>
			<div>
				<label for="vin">Vin:</label>
				<input type="number" id="vin" autofocus min="1000000" title="Add a vin"/> 
			</div>
			<div>
				<label for="description">Description:</label>
				<textarea id="description" title="Add a description or specifications"></textarea>
			</div>
			<div>
				<input type="button" onClick="save()" value="Submit">
			</div>
		</form>
	</center>
</body>
<script>
	function save(){
		var nvin = document.getElementById("vin").value;
		var des = document.getElementById("description").value;
		if(nvin.length<6){
			alert("Invalid vin");
			document.getElementById("vin").focus();
		}else{
			if(nvin==""){
				alert("Please fill vin");
				document.getElementById("vin").focus();
			}else{
				if(des==""){
					alert("Please add description");
					document.getElementById("description").focus();
				}else{
					var parametros={
					"nvin": nvin,
					"des": des,
				};
					$.ajax({
						data: parametros,
						url:   'kioskoMSC/loquesea.php',
						type:  'post',
						beforeSend: function () {
						},
						success:  function (response) {	
							if(response=="Existing vin"){
								alert(response);
								document.getElementById("vin").focus();
								document.getElementById("vin").value="";
							}else{
								window.location.reload();
							}
						}
					});
				}
			}
		}
	}
</script>
</html>

