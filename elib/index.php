<?php
//https://gist.github.com/mloberg/1181537/9ee5e7baf0528a604348f1d1bed721ef6d79d1fe
//require_once(".//php//db.php");

require_once(".//php//myscript.php");

if(isset($_POST['sub']))
{
	$name =($_POST['username']);
	$password=($_POST['password']);
	if(login($name,$password,'in_time'))
		header("location:main.php");
	else
		echo '<script>alert("Username or Password may be incorrect...")</script>';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=".//css//bootstrap.min.css">
	<link rel="stylesheet" href=".//stylesheets//style1.css">
	<link rel="stylesheet" href=".//stylesheets//s2.css">
	<link rel="stylesheet" href=".//stylesheets//fonts.css">
    <script src="jquery.js" ></script>
	<title>elib</title>
	<style>
	body{
		
	}
	</style>
  </head>
  <body>
  
    <div class="container-fluid ">
	<br/><br/>
<div class="row justify-content-center">
<div class="col-md-7 col-lg-5">
<div class="wrap" style='height:95%;'>

<div class='p-2 p-md-2  text-white' style='background:#254860;'>
<span class="row justify-content-center" id='ubunt'><?php
  echo collegename;
  ?></span>
</div>
<!--div class="img" style="background-image:url(.//images//logo.jpg)"></div-->
<div class="login-wrap p-4 p-md-5">
<div class="d-flex">
<div class="w-100">
<h3 class="mb-4">Log In</h3>
</div>
<div class="w-100">

</div>
</div>
<form action="#" class="signin-form" method='POST'>
<div class="form-group mt-3">
<input type="text" class="form-control" name='username' required="">
<label class="form-control-placeholder" for="username">Username</label>
</div>
<div class="form-group">
<input id="password-field" type="password" name='password' class="form-control" required="">
<label class="form-control-placeholder" for="password">Password</label>
<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
</div>
<div class="form-group">
<button type="submit" name='sub' class="form-control btn btn-primary rounded submit px-3">Sign In</button>
</div>
<div class="form-group d-md-flex">
<div class="w-50 text-left">

</div>
<div class="w-50 text-md-right">
<a href="#">Forgot Password</a>
</div>
</div>
</form>

</div>
</div>
</div>
</div>

	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
  </body>
</html>