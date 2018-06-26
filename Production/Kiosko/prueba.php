<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VIN</title>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<style>
	form{ 
	margin: 0 auto;
    width: 400px;
	padding: 1em;
	border: 1px solid #CCC;
	border-radius: 1em;
	}
	
	form div + div {
    margin-top: 1em;
	}	
	label {
    display: inline-block;
    width: 90px;
    text-align: right;
	}
	input, textarea {
    font: 1em sans-serif;

    width: 300px;
    -moz-box-sizing: border-box;
    box-sizing: border-box;

    border: 1px solid #999;
	}
	input:focus, textarea:focus {
    border-color: #000;
	}
	textarea {
    vertical-align: top;
		
    height: 5em;

    resize: vertical;
	}
	h1{
		background-color:darkslateblue;
		text-align: center;
		color: white;
	}
	
</style>
<body>
	<center>
		<h1>Load Trail</h1>
		<form>
			<div>
				<label for="vin">Vin:</label>
				<input type="text" id="vin" autofocus />
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
						alert(response);
					}
				});
			}
		}
	}
	
</script>
</html>
