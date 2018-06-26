<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	
	  <style>

        .round {
 -moz-border-radius: 15px;
 -webkit-border-radius: 11px;
 border-radius: 11px;


    }

    </style>
</head>
<body>
 
	<table width="800" border="0" cellpadding="0" cellspacing="0" height="80">
	<tr>
	
	<h2 align="center" style="margin-top: 0; margin-bottom: 0">Date </h2>
	</td></tr>	
	</table>
 
	<div align="center">
 
		<table width="600" border="0" cellpadding="0" cellspacing="0">
 
		<tr>
		<td width="100%">
 
		<table width="100%" border=1 cellPadding=5 cellSpacing=0 bgcolor="#eeeeee" bordercolor="#C0C0C0">
 
		<tbody>
 
		<tr>
		<td width="100%" align="center" Align=middle>
		<?php
			$name =  $_GET['name'];
			$sD = $_GET['sD'];
			$eD = $_GET['eD'];
			$company = $_GET['company'];
			$line = $_GET['line'];
		?>
<!--begin Form -->
		<table border=0 cellpadding=3 cellspacing=0 bordercolor="#FFFFFF">
 
		
		<tr>
		
			<td height="20" bgcolor="#CCCCCC" align="left">Name</td>
			<td colspan="2" align="center" height="28">
			<td height="20" bgcolor="#CCCCCC" align="left">Company</td>
		</tr>
 
		<tr>
			<td colspan="2" align="center" height="28">
			<INPUT id="name" TYPE="TEXT" SIZE="30" MAXLENGTH="50" value="<?php echo $name;?>" readonly style="text-align:center"></td>
 
			<td colspan="2" align="center" height="28">
				<INPUT NAME="Company" TYPE="TEXT" SIZE="30" MAXLENGTH="68" value="<?php echo $company;?>" readonly style="text-align:center; font-family: Verdana; font-size: 10pt;"></td>
				
				
		</tr>

		<tr>
			<td  height="20" bgcolor="#CCCCCC" align="left">Start Date</td>
			<td colspan="2" align="center" height="28">
			<td  height="20" bgcolor="#CCCCCC" align="left">End Date</td>
		</tr>
 
		<tr>
			<td colspan="2" align="center" height="28">
			<INPUT id="StartDate" TYPE="TEXT" SIZE="30" MAXLENGTH="68" value="<?php echo $sD;?>" readonly></td>
			
			<td colspan="2" align="center" height="28">
			<INPUT id="EndDate" TYPE="TEXT" SIZE="30" MAXLENGTH="68" value="<?php echo $eD;?>" readonly></td>
		</tr>
 
		<tr>
			<td  height="20" bgcolor="#CCCCCC" align="left">Line</td>
			<td colspan="2" align="center" height="28">
			<td  height="20" bgcolor="#CCCCCC" align="left">Descritption</td>
		</tr>
 
		<tr>
			<td colspan="2" align="center" height="280">
			
			<select name="Line" id="line" style="border-Color: red;">
					
					<option value="0">Select line</option> 
					<?php
					$x=1;
					while ($x <= $line) { 
			
					echo '<option value='.$x.'>'.$x.'</option>'; 
					$x++;
					}
					?> 

					
				</select>
				<input type="text" class="round" size"5" id="color" readonly style="visibility:hidden"></td>
			<td colspan="2" align="center" height="80">
			<TEXTAREA ROWS="5" COLS="64"  NAME="bodyl" id="description" style="border-Color: red;" onblur="Function(this)" title="Add a description or specifications for your date" ></TEXTAREA></td>
		</tr>
 
 
</table>
 

<!-- End Form -->
	<script>
	var color = [
    "#848484",
    "#088A68",
    "#FF8000",
    "#2E64FE",
    "#FE2E9A",
    "#DF0101",
    "#04B45F",
    "#DBA901",
    "#A9E2F3",
    "#F5A9E1",
    "#0B610B",
    "#0B3861",
    "#610B0B",
    "#F79F81",
    "#D0A9F5",
    "#6A0888",
    "#0489B1"
	]; 
	
	function send(){
		var n = $("#name").val();	
		var combo = document.getElementById("line");
		var selectline = combo.options[combo.selectedIndex].text;		
		for(x=0;x<17;x++){
			if(selectline==(x+1)){
				var colorF = color[x];
			}
		}
		var startDate = $("#StartDate").val();
		var endDate = $("#EndDate").val();
		var description = $("#description").val();
		
		 
	var param = {
		"name":n,
		"sD": startDate,
		"eD": endDate,
		"selectline": selectline,
		"description": description,
		"color": colorF,
		"company": <?php echo " '".$company."'";?>
	}
		$.ajax({
			data: param,
			url: 'sender.php',
			type: 'post',
			success: function(){
				alert("ok");
				window.opener.location.reload();
				window.close();
			}
		});
	}
	var select = document.getElementById('line');
select.addEventListener('change',
  function(){
    var selectedOption = this.options[select.selectedIndex].text;
	for(x=0;x<17;x++){
			if(selectedOption==(x+1)){
				var colorF = color[x];
				var ic = document.getElementById('color');
				ic.style.visibility = "visible"; 
				ic.style.background= colorF;
				line.style.borderColor = "#00FF00";
			}
		}
  });
  function cancel(){
	  window.close();
	  window.opener.location.reload();
  }
 
function Function(x){
	var description = $("#description").val();
	if (description==""){
		
		}else{x.style.borderColor = "#00FF00";
		}
	 
}

	 

	</script>

</td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</br>
 
<button onclick="send()"> <b>Submit</b></button>
 <button onclick="cancel()"> <b>Cancel</b></button>

</div>
 
</body>
</html>