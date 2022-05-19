<?php
include_once('.//php//myscript.php');
require_once './/image-resizer-master//lib//Image.php';
session_start();


function logincheck()
{

if($_SESSION["logged_in"]==True)
	return 0;
else
	return 1;

}
if(logincheck())
	header("location:index.php");

$std_id=insert_stdid();

if(isset($_POST['sub']))
{
	
	
	if(count($_POST['data'])==10)
	{
		if (isset($_FILES['banner_image']['error']))
	{
		if ($_FILES['banner_image']['error'] == 4)
		{
		echo "please select image";
		}
		else 
		{
		$image_name=$_FILES['banner_image']['name'];
		$data=upload_image($image_name);
		$_POST['data']['image']=$data;
		insert_data($_POST);
		}
	}
		
	}
	else
		echo '<script>alert("Please Check Details")</script>';
}


function upload_image($image_name)
{
	try{
	$width=200;
	$height=200;
	$temp = explode(".", $image_name);
       $image = $_FILES['banner_image']['tmp_name']; 
	   $a='10nr1f0001';
	   $newfilename = $a . '.' . end($temp);
	   $imagepath=".//candidate_images//".$newfilename;
	   
	   move_uploaded_file($_FILES["banner_image"]["tmp_name"],$imagepath);
	    $image = new Image($imagepath);
		$image->resize($width,$height);
		$image->save();
		
	   
	   $image_base64 =  base64_encode(file_get_contents($imagepath));
	   $imageFileType = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
		
	   $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
	   //insertimage('10nr1f0001','sno',$image);
	   //$array=search('10nr1f0001');
	   //$data= $array[0]['image'];
	   //echo "<img src=$data />";
	   unlink($imagepath);
	   return $image;
	}catch(Exception $e){}
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
	<link rel="stylesheet" href=".//stylesheets//std_reg1.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    
	<script src="jquery.js" type="text/javascript"></script>
  <script src=".//js/bootstrap.min.js"></script>
  <script src=".//js/form.js"></script>
	<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
	  
    }
  };
</script>
	<title>elib</title>
	<link rel="stylesheet" href=".//stylesheets//fonts.css">
  </head>
  <body>
  
    <div class="container-fluid" style='padding:0px;margin:0px;'>
	<div style='background:#322348'>
	<a href="#" class="d-block px-3 py-2 text-center text-bold text-white old-bv"><?php
  echo collegename;
  ?></a>
	</div>
	
	<div class="panel" style='background:#563d7e'>
  <div class="panel-body">
  <i class="fa fa-user-circle" aria-hidden="true" style='font-size:30px;color:white;margin:10px 0px 0px 10px;'></i>
  <span style='position:absolute;margin:12px 0px 0px 10px;color:white;'><b><?php
  echo collegename;
  ?></b></span>
  
  </div>
 
</div>

<div class="row">
    <?php
	echo file_get_contents('menu.txt');
	?>
    <div class="col-8" style='margin-left:5%;'>
     
	  <form action="#" class="signin-form" method='POST' enctype="multipart/form-data" onchange="loadFile(event)">
	  <br/>
	  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Student id</p>
    </div>
	
      <div class="col-lg-5">
	  
      <input type="text" class="form-control" value='<?php echo $std_id; ?>' name="data[id_no]" placeholder="studentid" onkeydown="return false" alt="THIS IS READONLY" >
	  
    </div>
	
	<div class="col-lg-4">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=""   id='output'/>
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>First Name</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="First name" name="data[name]" required="">
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Date Of Birth</p>
    </div>
      <div class="col-lg-2">
	  <select class="form-select form-control" aria-label="Default select example" name="data[DD]">
  <option selected disabled>DD</option>
  <?php
  for ($i=1;$i<=31;$i++)
  {
  echo '<option value='.$i.' style="padding:10px;">'.$i.'</option>';
  }
 ?>
</select>

		
    </div>
	<div class="col-lg-2">
	  <select class="form-select form-control" aria-label="Default select example" name="data[mm]">
  <option selected disabled>MM</option>
  <?php
  for ($i=1;$i<=12;$i++)
  {
  echo '<option value='.$i.' style="padding:10px;">'.$i.'</option>';
  }
 ?>
</select>

		
    </div>
	<div class="col-lg-2">
	  <select class="form-select form-control" aria-label="Default select example" name="data[yyyy]">
  <option selected disabled>YYYY</option>
  <?php
  for ($i=1900;$i<=2030;$i++)
  {
  echo '<option value='.$i.' style="padding:10px;">'.$i.'</option>';
  }
 ?>
</select>

		
    </div>
	
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Email</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="Email" name="data[email]" required="">
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Education</p>
    </div>
      <div class="col-lg-5">
      <select class="form-select form-control" aria-label="Default select example"  required="" name="data[edu]">
  <option selected disabled>Education</option>
  <?php

$file = fopen("course_list.txt", "r");
$array = explode("\n", file_get_contents('course_list.txt'));


  foreach($array as $value)
  {
  echo '<option value='.$value.' style="padding:10px;">'.$value.'</option>';
  }
 ?>
</select>
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Mobile number</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="Mobilenumber" name="data[mobile]">
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Uploadphoto</p>
    </div>
      <div class="col-lg-5">
	  &nbsp;&nbsp;<input type="file" name="banner_image"   name="data[img]" accept="image/*" >
      
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Gendar</p>
    </div>
      <div class="col-lg-2">
      
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="data[gender]" id="flexRadioDefault1" value='m'>Male
    </div>
	<div class="col-lg-2">
      
	  <input class="form-check-input" type="radio" name="data[gender]" id="flexRadioDefault1" required="" value='f'>Female
    </div>
	<div class="col-lg-1">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Full Address</p>
    </div>
      <div class="col-lg-5">
      <textarea class="form-control" rows="5" required="" name="data[addr]" style='resize: none;' ></textarea>
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  
  <div class="form-group">
<button type="submit" name='sub' class="form-control btn submit w-25" id='btn'>Submit</button>
</div>

</form>
	  
    </div>
  </div>




  
  
  




	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
  </body>
</html>