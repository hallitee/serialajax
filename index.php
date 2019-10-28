<html>
 
  <head>
   <title>
     PYSERIAL
   </title>
   <link rel="stylesheet" href="bootstrap.min.css">

  </head>
<body>
<? $out=''; ?>
<br>
<br>
	<div class="container">
	<div class="row">
	<div class="col-md-8">
   <form class="form-group" method="post" id="htmlform">
      	<div class="form-group row">
		<label class="col-md-6 form-label">Indicator: </label>
		<select name="machine" id="machine" class="form-control col-md-6">
		<option value="AVERY">AVERY</option>
		<option value="BILANCIAI">BILANCIAI</option>
		<option value="METTLER">METTLER TOLEDO</option>
		</select>
	</div>
   	<div class="form-group row">
		<label class="col-md-6 form-label">Communication Channel: </label>
		<select name="channel" id="port" class="form-control col-md-6">
		<option value="COM">COM PORT</option>
		<option value="ETHERNET">ETHERNET PORT</option>
		</select>
	</div>
	<div class="form-group row" id="baudDiv">
		<label class="col-md-6 form-label">Baudrate: </label>
		<input type="text" class="col-md-6 form-control" value="9600" name="baudrate">
	</div>
	<div class="form-group row" id="ipDiv" style="display:none">
		<label class="col-md-6 form-label">IP Address: </label>
		<input type="text" class="col-md-6 form-control" value="88.200.125.216" name="ipaddress">
	</div>
	<div class="form-group row" id="comDiv">
		<label class="col-md-6 form-label">COM PORT: </label>
		<input class="col-md-6 form-control" type="text" value="COM3" name="port">
	</div>
	<div class="form-group row">
		<label class="col-md-6 form-label">Serial Command: </label>
		<input class="col-md-6 form-control" type="text" value="" name="command" id="cmd">
	</div>	
	<div class="form-group row">
		<input id="sub_btn" class="btn btn-primary col-md-4 offset-md-6" type="button" value="SEND COMMAND" name="GO">
	</div>
	<div class="form-group row">
		<label class="col-md-6 form-label">Results: </label>
		<textarea class="col-md-6 rows='20' cols='8' form-control" type="text" value=""  name="result"></textarea>
	</div>	
   </form>
	</div>
	<div class="col-md-4 h1" id="disp"></div>
   </div>
   </div>
   <script src="jquery.min.js"></script>
   <script src="bootstrap.min.js"></script>
   <script>
   
   $(document).ready(function(){
	   console.log("started");
	   $("#port").on('change', function(){
		   //var optionText = $("#dropdownList option:selected").text();
		   console.log("changed");
		   ip = $("#ipDiv");
		   baud = $("#baudDiv");
		   channel = $(this).find('option:selected').val();
		if(channel==='ETHERNET'){
			ip.show();
			$("#comDiv label").text("Port:");
			$("#comDiv input").val("3002");
			baud.hide();
		}else{
			$("#comDiv label").text("COM PORT: ");
			$("#comDiv input").val("COM3");
			baud.show();
			ip.hide();
		}
	   });
	   $("#sub_btn").on('click', function(){
			$form = $("#htmlform");
			$com = $("#cmd").val().toLowerCase();
			$port = $("#port").val();
			console.log($port);
			$formData = $form.serialize();
			    $.ajax({
				  url: 'serial.php',
				  type: 'POST',
				  dataType: 'JSON',
				  data: $formData,
				  success: function(data){
					console.log(data);
					$("textarea").val();
					//
					if(data.out){
						if($com=='pp' && !data.out.includes("error")){
					$("#disp").text(data.out.trim().substr(7,11)+' KG');
					$("textarea").val(data.out.trim().substr(7,11));
						}else{
					$("#disp").text('');
					$("textarea").val(data.out.trim());							
						}
					}else{
					'';
				  }
				  }
				});
	   });

	   
});
   </script>
 </body>
</html>

