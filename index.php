<?php 
    session_start();
if(!empty($_SESSION['karlu-user']))
  header("location: admin.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Mohammad Medicine Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>
 
<style>
@import 'https://fonts.googleapis.com/css?family=Libre+Franklin:100,300,400,600,700,900';
/* -----------------------
  Presentational stuff 
----------------------- */
body {
  font-family: 'Libre Franklin', sans-serif;
  background: url(assets/img/wall.jfif) no-repeat;
  background-size: cover;
}
h1 {
  font-weight: 900;
  color: #ff8d00;
}
@media (min-width: 1200px) {
  h1 {
    font-size: 60px;
  }
}
/* -----------------------
  Form 
----------------------- */
.form-control {
  border-radius: 0;
}
.form-control:focus {
  box-shadow: none;
}
.form-group {
  position: relative;
  margin-bottom: 25px;
}
.form-group > label {
  text-transform: uppercase;
  font-size: 10px;
  color: #a1a2a3;
  transform-origin: 0 0;
  transform: scale(1.4);
  pointer-events: none;
  position: relative;
  z-index: 5;
}
.form-group > input {
  width: 100%;
}
.form-group > label {
  transition: transform 0.4s;
  transform-origin: 0 0;
  transform: scale(1.4) translateY(20px);
}
.form-group.not-empty > label {
  transform: none;
}
/*------------------------------
	Form
------------------------------*/
.form-control {
  border: 0;
  border-bottom: 1px solid #a1a2a3;
}
.form-control,
.form-control:focus,
.form-control:focus:hover {
  color: #ff8d00;
  background: none;
  outline: none;
}
.form-control:focus,
.form-control:focus:hover {
  border-bottom: 1px solid #ff8d00;
}
.xx {
	margin:0 auto;
}

 </style>
  

</head>
<body>
<div class="container" >
<form class="form-horizontal m-t-5" id="login-form" method=post>

              <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 mx-auto">
	<div class="card card-primary">
                  <div class="card-header justify-content-center">
                    <h2 class="text-center mt-3">Mohammad Medicine</h2>
                  </div>
                  <div class="card-body">
<div class="row">
        <div class="col-md-6 mx-auto">
            <img src="assets/img/logo1.png" class="img-responsive">
        </div>
        </div>


<div class="row">
        <div class="col-md-6 mx-auto">
            <form class="mt-4 mt-md-0">
                <div class="form-group"><label for="name">User Name</label><input class="form-control" type="text" id="username" autocomplete="off" /></div>
                <div class="form-group"><label for="surname">Password</label><input class="form-control" type="Password" id="password" /></div>
                
            </form>
      
      <div class="form-group row">
             <div class="col-12 text-center" id="error">
             
             </div>
             </div>

      
      <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-12">
                        <button class="btn btn btn-primary btn-lg btn-block" type="submit" id="btn-login"><span class="mdi mdi-login-variant"></span> &nbsp Log In</button>

                      </div>
                    </div>
        </div>
        </div>



        <div class="col-md-6 offset-md-1">
            
					
        </div>
    </div>
</div>
</div>

<!-- General JS Scripts -->
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  	 <script type="text/javascript" src="ajaxcall/js/script.js"></script>
  <script>
  $(document).ready(function() {
   
$( () => {

  $('.form-group').each((i,e) => {
    $('.form-control', e)
      .focus( function () {
        e.classList.add('not-empty');
      })
      .blur( function () {
        this.value === '' ? e.classList.remove('not-empty') : null;
      })
    ;
  });
  
});  
  
  }); 
  
  </script>

  