<!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>

.navbar-inverse {
    background-color: #4b6312;
    color: #fff;
    margin-bottom: 20px;
}
.box {
	margin-top:30px;
	
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius:4px;
	box-shadow: 0px 10px 28px rgba(0,0,0,0.36);
	
  
}
.panel-body {padding:20px;}

.panel-default>.panel-heading {
    color: #fff;
    background-color: #4b6312;
    border-color: #4b6312;
}
.row {margin-top:20px;}
.alert-success {
    color: #fff;
    background-color: #4b6312;
    border-color: #4b6312;
}
.alert {
    padding: 5px;
    margin-bottom: 5px;
	margin-top: 15px;
    border: 1px solid transparent;
    border-radius: 4px;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #dccece;
    cursor: default;
    background-color: #1a2104;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
	display:block;
}
.nav-tabs {
    
    background-color: transparent;
    width: 100%;
	border-bottom: 1px solid transparent;
	 border-radius: 7px 7px 0 0;
}
.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.42857143;

    border-radius: 7px 7px 0 0;
}




</style>
<title>Restore</title>
</head>
<body >
<nav class="navbar navbar-inverse">
<div class="navbar-header">
<a class="navbar-brand" href="index.html"><img src="../assets/images/logo_light.png" width=100 alt=""></a>
</div>
<ul class="nav navbar-nav">
<li><a href="../index.php">Home</a></li>
<li><a href="index.php">Backup</a></li>
</ul>
</div>
</form>
</nav>
<div class="container">
<div class="col-sm-8 col-sm-offset-2 box">
<div class="panel panel-default">
<div class="panel-heading">Restore</div>
<div class="panel-body">
      <?php
$dir = 'data/';
$files = scandir($dir);
rsort($files);
?>
<div class="row">
<ul class="nav nav-tabs">
<li class="active"><a href="#option1" data-toggle="tab">Upload Your sql to restore</a></li>
<li><a href="#option2" data-toggle="tab">Select sql from system</a></li>
</ul>

<div class="tab-content">

<div id="option1" class="tab-pane fade active in">
<p>&nbsp;</p>
<form class="form-horizontal" method=post id="load" enctype="multipart/form-data">
<div class="form-group">
    <label class="control-label col-sm-2" for="email">Select File</label>
    <div class="col-sm-6">
      <input type=file name=file id=file class="form-control">
    </div>
	<div class="col-sm-4">
    <button type=submit class="btn btn-primary "><i class="glyphicon glyphicon-upload"></i> Upload & Restore</button>
    </div>
  </div>
  </form>
  </div>

<div id="option2" class="tab-pane fade ">
<p>&nbsp;</p>
<form method=post id="load1">
<div class="form-group">
    <label class="control-label col-sm-2" for="email">Select the backup File</label>
    <div class="col-sm-6">
      <select name=datafile id=datafile class="form-control">
<?php
foreach ($files as $file)
if ($file != '.' && $file != '..')
echo "<option>$file </option>";
?>
</select>
    </div>
	<div class="col-sm-4">
    <button type=submit class="btn btn-primary "><i class="glyphicon glyphicon-refresh"></i> Restore Now</button>
    </div>

</div>
</form>
</div>
</div>

</div>

<div id="row">
<div class="col-sm-6 col-sm-offset-3">
<div id="output" ></div>
</div>

</div></div></div></div>


	
</body>
</html>

<script>
$(document).ready(function() {
	$("#load").submit(function(e) {
		e.preventDefault();
		
		 
		$("#output").html("<img src='images/Processing.gif'>");
		var formData = new FormData();
		if(!$('#file')[0].files[0]) {alert("Select a Backup File First"); $("#output").html("");return;}
formData.append('file', $('#file')[0].files[0]);
 

$.ajax({
       url : 'script.php',
       type : 'POST',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
	   
       success : function(data) {
       
		$("#output").html(data);

       }
});
	
	});
	
	
	
	
	$("#load1").submit(function(e) {
		e.preventDefault();
		$("#output").html("");
		$("#output").html("<img src='images/Processing.gif'>");
		$.post("job.php",{datafile: $("#datafile").val()},function(result){
			$("#output").html(result);
		});
	});
	

	

	
	

	});

</script>
