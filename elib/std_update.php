<?php
include_once('.//php//myscript.php');
require_once './/image-resizer-master//lib//Image.php';

session_start();

$sno="";
$name="";
$dd="";
$mm="";
$yyyy="";
$email="";
$edu="";
$gendar="";
$address="";
$mobile='';
$gen="";
$data="";
$_image="";
function logincheck()
{

if($_SESSION["logged_in"]==True)
	return 0;
else
	return 1;

}
if(logincheck())
	header("location:index.php");
if(isset($_POST['sub']))
{
	
	if(count($_POST['data'])==10)
	{
		if (isset($_FILES['banner_image']['error']))
	{
		if ($_FILES['banner_image']['error'] == 4)
		{
		//echo '<script>alert("Please select Image")</script>';
		}
		else 
		{
		$image_name=$_FILES['banner_image']['name'];
		$data=upload_image($image_name);
		$_POST['data']['image']=$data;
		update_data($_POST,$_POST['data']['id_no']);
		insertimage($_POST['data']['id_no'],'sno',$data);
		}
	}
	}
	//insert_data($_POST);
	else
		echo '<script>alert("Please Check Details")</script>';
	
}


if(isset($_POST['search']))
{
	
	$data=search($_POST['data']['id_no']);
	
	if(sizeof($data[0])==0||$data[0]['name']=='')
	{
	echo '<script>alert("Please Entervalid id")</script>';
	}
	else
	{
	$sno=$data[0]['sno'];
	$name=$data[0]['name'];
	$email=$data[0]['email'];
	$edu=$data[0]['edu'];
	$d=$data[0]['dob'];
	$d=explode("-",$d);
	
	$dd=$d[0];
	$mm=$d[1];
	$yyyy=$d[2];
	$address=$data[0]['address'];
	$mobile=$data[0]['mobile_number'];
	$gen=$data[0]['gendar'];
	$_image=$data[0]['image'];
	
	
	
	}
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
//	   insertimage($_sno,'sno',$image);
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
	  
      <input type="text" accesskey="s" class="form-control" value='<?php echo $sno; ?>' name="data[id_no]" placeholder="Student Id" >
    </div>
	<div class="col-lg-4">
            <div class="form-group">
<button type="submit" name='search' class="form-control btn submit w-25" id='btn' style='margin-left:-0px;'>Search</button>

	&nbsp;&nbsp;&nbsp;&nbsp;<img src='<?php echo $_image ?>'   id='output' />
    
</div>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>First Name</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="First name" name="data[name]" value='<?php echo $name; ?>' >
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
	  if($i==(int)$dd)
		echo '<option  selected value='.$i.' selected  style="padding:10px;">'.$i.'</option>';
	else	
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
  if($i==(int)$mm)
		echo '<option  selected value='.$i.' selected  style="padding:10px;">'.$i.'</option>';
	else	
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
  if($i==(int)$yyyy)
		echo '<option  selected value='.$i.' selected  style="padding:10px;">'.$i.'</option>';
	else	
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
      <input type="text" class="form-control" placeholder="Email" name="data[email]" value='<?php echo $email; ?> '>
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
      <select class="form-select form-control" aria-label="Default select example"   name="data[edu]">
 <option selected disabled>Education</option>
  <?php

$file = fopen("course_list.txt", "r");
$array = explode("\n", file_get_contents('course_list.txt'));



  foreach($array as $value)
  {
	  
	if(strpos($value,$edu)!==false)
	{
	
	echo '<option   value='.$value.' selected  style="padding:10px;">'.$value.'</option>';
	}
	else	
		echo '<option value='.$value.'  style="padding:10px;">'.$value.'</option>';  
  
  }
 ?>
</select>
    </div>
	
	
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Mobile number</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="Email" name="data[mobile]" value='<?php echo $mobile; ?>' >
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
<?php
echo<<<l
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Gendar</p>
    </div>
      
<div class="col-lg-2">
l;
?>

	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" name="data[gender]" id="flexRadioDefault1" value='m' 
	  <?php 
	  if($gen=='m')
	  echo 'checked';
	  ?> >Male
<?php
echo<<<l
    </div>
	<div class="col-lg-2">
l;
?>
	  <input class="form-check-input" type="radio" name="data[gender]" id="flexRadioDefault1"  value='f' <?php 
	  if($gen=='f')
	  echo 'checked';
	  ?> >Female
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
      <textarea class="form-control" rows="5"  name="data[addr]" style='resize: none;' ><?php echo $address;
	  ?></textarea>
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  
    
  <div class="form-group">
<button type="submit"  accesskey="a" name='sub' class="form-control btn submit w-25" id='btn'>Submit</button>
</div>

</form>
	  
    </div>
  </div>




  
  
  




	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
  </body>
</html>