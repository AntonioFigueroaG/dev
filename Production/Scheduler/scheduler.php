<!Doctype html>
<head>
	<script src="https://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script>
	<link href="https://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"></link>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
</head>
<body>		
	<div id="wrapper" class="yui3-skin-sam"><div id="myScheduler"></div></div>
	
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Are you shure?</h4>
				</div>
				<div class="modal-body">
					<input type="text" size="10" id="name" readonly>
					<input type="text" size="65" id="startDate" readonly>	
					<input type="text" size="65" id="endDate" readonly>	
				</div>
				<div class="modal-footer">
					<button id="send" type="button" class="btn btn-default">Acept</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div id="myToolbar" class="toolbar">
  		<div id="checkgroup2" class="btn-group btn-group-checkbox">
    		<button class="btn btn-default" onclick="home()">Home Page</button>
    		<button class="btn btn-default" onclick="menu()">Menu</button>
  		</div> 
  	</div>
	
	<div id="id01" class="modal">
  
  <form class="modal-content animate" action="http://192.168.1.77/dev/validator.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'; window.location.replace('http://192.168.1.77/dev/index.php');" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input id="uname" type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" id="pass" required>
		
		<input type="text" readonly style="visibility:hidden" name="href" id="href" value="window.location.href" >
    
      <button type="submit" class="positbtn">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <center><button type="button" onclick="document.getElementById('id01').style.display='none'; window.location.replace('http://192.168.1.77/dev/index.php');" class="cancelbtn">Cancel</button></center>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
</body>
	<script>
		document.getElementById('href').value=(window.location.href);
		var dt = new Date();
		// Display the month, day, and year. getMonth() returns a 0-based number.
		var month = dt.getMonth();
		var day = dt.getDate();
		var year = dt.getFullYear();	
		// Output: current month, day, year
		YUI().use(
		'aui-scheduler',
		function(Y) {
			<?php
			session_start();
			$position= $_SESSION["position"] ;
			$alter = $_GET["C"];
			if(isset($position)){
				if($position=='admin'){
					$eventrecorder = "eventRecorder: eventRecorder,";
				}else{
					$eventrecorder = "";
				}
			}else{
				echo  "var alert = confirm('You are not loggin in yet, do you want to loggin?');
				if (alert) {
				document.getElementById('id01').style.display='block'; document.getElementById('myScheduler').style.display='none'; }else{window.location.replace('http://192.168.1.77/dev/index.php');}";
			}
			date_default_timezone_set('america/Chihuahua');
			?>
			var agendaView = new Y.SchedulerAgendaView();
			var dayView = new Y.SchedulerDayView();
			var weekView = new Y.SchedulerWeekView();
			var monthView = new Y.SchedulerMonthView();
			var startDate = null;
			var endDate = null;
			var parametros = null;
			var description = null;
			var events = [
			<?php
				$user = "root";
				$servidor = "192.168.1.77";
				$database = "dev";
				$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
				$db = mysqli_select_db( $conection, $database ) or die ("Ups! Well, it's going to be impossible to connect to the database");
				$query = "SELECT * FROM scheduler WHERE company = '$alter'";
				$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database");
				while ($columna = mysqli_fetch_array( $result )){
					$date = new DateTime ($columna['startDate']);
					$dateF = date_format($date, 'Y,m-1,d,H,i');
					$ed = new DateTime ($columna['endDate']);
					$enD =date_format($ed, 'Y,m-1,d,H,i');
					echo "{";
					echo "color: '".$columna['color']."',";
					echo "content: ".$columna['name'].",";
					echo "description: '".$columna['description']."',";
					echo "startDate: new Date(".$dateF."),";
					echo "endDate: new Date(".$enD.")";
					echo "},";
					$variab[]=array("color" => $columna['color'], "content" => $columna['name'], "description" => $columna['description'], "startDate" => $dateF, "endDate" => $enD);
				}
				$objJSON = json_encode($variab);
			?>
			];
			<!--var eventRecorder = new Y.SchedulerEventRecorder();-->
			var eventRecorder = new Y.SchedulerEventRecorder({
				on: {
					save: function(event) {
						var d = this.get('startDate').toLocaleString();
						var df = this.get('endDate').toLocaleString();
						var n = this.getContentNode().val();
						for(x=0;x<d.length;x++){
							var dat= d.substring(x,x+1);
							if(dat== ' '){
								var c = x;
								var dateF = d.substring(0,c);
								var timeF = d.substring(c,d.length);
								parametros = {
									"dateF" : dateF,
									"timeF" : timeF
								};
								$.ajax({
									data:  parametros,
									url:   'Formater.php',
									type:  'post',
									beforeSend: function () {
									},
									success:  function (StartDate) {
										startDate = StartDate;
									}
								});
								x = d.length;
							}
						}
						for(x=0;x<df.length;x++){
							var dat= df.substring(x,x+1);
							if(dat== ' '){
								var c = x;
								var dateF = df.substring(0,c);
								var timeF = df.substring(c,df.length);
								parametros = {
									"dateF" : dateF,
									"timeF" : timeF
								};
								$.ajax({
									data:  parametros,
									url:   'Formater.php',
									type:  'post',
									beforeSend: function () {
									},
									success:  function (StartDate) {																	
										endDate = StartDate;
										var param = {
											"name":n,
											"sD": startDate,
											"eD": endDate,
											"company": "<?php echo($alter);?>"
										}
										ruta="form.php";
										envio1="name="+n;
										envio2="sD="+startDate;
										envio3="eD="+endDate;
										envio4="company="+"<?php echo($alter);?>";
										<?php
										$user = "root";
										$servidor = "192.168.1.77";
										$database = "dev";
										$conection = mysqli_connect( $servidor, $user, "toor" ) or die ("Unable to connect to the Database server");
										$db = mysqli_select_db( $conection, $database ) or die ("Ups! Well, it's going to be impossible to connect to the database");
										$query = "SELECT Line FROM line WHERE company = '$alter'";
										$result = mysqli_query( $conection, $query ) or die ( "Something went wrong in the query to the database");
										while ($columna = mysqli_fetch_array( $result )){
											$rt = $columna[0];
										}
										?>
										envio5="line="+"<?php echo($rt); ?>";
										url=ruta+"?"+envio1+"&"+envio2+"&"+envio3+"&"+envio4+"&"+envio5;
										window.open(url,'ventana','scrollbars=NO,menubar=NO,resizable=NO,titlebar=NO,status=NO');
									}
								});
									x = df.length;
								}
							}
					},
					edit: function(event) {
					},
					delete: function(event) {
						var n=this.getContentNode().val();
						var json = <?php echo $objJSON ; ?>;
						for (x = 0; x < json.length; x++){
							if(n == json[x].content){
									document.getElementById("name").value = json[x].content;
								var datesf = json[x].startDate;
								var dateff = json[x].endDate;
								for (x=0;x<datesf.length;x++){
									var idatesf=datesf.substring(x,x+1);
									if(idatesf== "-"){
										var montho = datesf.substring(0,x);
										var rdate = datesf.substring(x+2,datesf.lenght);
									}
							
								}
								document.getElementById("startDate").value = montho+rdate;
								for (x=0;x<dateff.length;x++){
									var idateff=dateff.substring(x,x+1);
									if(idateff=="-"){
										var fdateff = dateff.substring(0,x);
										var rdate = datesf.substring(x+2,idatesf.lenght);
										
									}
								}
								document.getElementById("endDate").value = fdateff+rdate;
							}
						}
						$("#myModal").modal();
						document.getElementById("send").onclick = function(){
							var pdelete = {
								"name": n,
								"company": "<?php echo($alter);?>"
							}	
							$.ajax({
								data: pdelete,
								url:   'deleted.php',
								type:  'post',
								beforeSend: function () {
								},
								success:  function (response) {
									window.location.reload();
									
								}
							});
						}
					}
				}
			});	
		 'scheduler-view-agenda',
		function(Y) {
			var agendaView = new Y.SchedulerAgendaView();
			ATTRS: {
				 bodyContent: {
                	value: 'event'
                 }
			};
};   
			new Y.Scheduler({
				activeView: weekView,
				boundingBox: '#myScheduler',
				date: new Date(year, month, day),
				<?php echo $eventrecorder; ?>
				items: events,
				render: true,
				views: [dayView, weekView, monthView, agendaView]
			});
			
		});  
YUI().use(
  'aui-toolbar',
  function(Y) {
    new Y.Toolbar(
      {
        boundingBox: '#myToolbar'
      }
    ).render();
  }
);
	</script>
	<script>
		YUI().use('event-hover', function(Y){
			Y.all('.scheduler-event').on('hover', function (e) {
				//var e = document.getElementsByClassName('.scheduler-event-content').innerHTML;//var e = ($(this).get().innerHTML);//alert(e);
				//alert(e.target._yuid); 		
			});
		});
	</script>
	<script>
		function menu(){
			window.location.replace('http://192.168.1.77/dev/Production/Scheduler/index.php');
		}
		function home(){
			window.location.replace('http://192.168.1.77/dev/index.php?carge=' + '<?php echo $position ; ?>');
		}
	</script>
</html>
