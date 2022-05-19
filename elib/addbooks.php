<?php
include_once('.//php//libscript.php');
require_once './/image-resizer-master//lib//Image.php';
session_start();

$book_id=insert_stdid();
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

$flag=0;

foreach($_POST['data'] as $key=> $value)
{
if($value=="")
	{
	$flag=1;
echo<<<l
<script>alert("Please Check  $key Details")</script>
l;
	
	break;
	}
}
	if($flag==0)
	{
		insertdata($_POST['data']);
	}
	

//echo $key."=".$value."<br/>";
	
		
	
		
	//echo '<script>alert("Please Check Details")</script>';
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
    <link href=".//css//bootstrap-datepicker.min.css" rel="stylesheet"/>
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
      <p>Book_id</p>
    </div>
      <div class="col-lg-5">
      <input type="text" onkeydown="return false" class="form-control" placeholder="" name="data[id]" value='<?php echo $book_id; ?>' >
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>BookTitle</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="" name="data[title]" required="" >
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>BookAuthor</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="" name="data[author]"  required="">
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>BookPrice</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="" name="data[price]" required="" >
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>EntryDate</p>
    </div>
      <div class="col-lg-5">
      <div class="row">
        <div class="col">
            <input data-date-format="dd/mm/yyyy" id="datepicker" class="form-control" name="data[entrydate]">
        </div>
    </div>
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
	
<script src=".//js//cal.js"></script>
<script type="text/javascript">
    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
</script>
	
  </body>
</html>