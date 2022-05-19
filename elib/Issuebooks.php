<?php
include_once('.//php//myscript.php');

require_once './/image-resizer-master//lib//Image.php';

session_start();

$sno="";
$name="";
$email="";
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
	
	if($_POST['data']['stdid']!="")
	{
	$r=libsearch($_POST['data']['stdid'],"std_registraion","sno");
	
	if(count($r[0])!=0 || $r[0]['name']!="")
	{
		$flag=flag($r[0]);
		if($flag==0)
		{
			data_lib($_POST['data']);
		
		}
		
	}
	else
			echo '<script>alert("Please Entervalid id")</script>';
	}

}

if(isset($_POST['search']))
{
	$data=libsearch($_POST['data']['id_no'],"lib","id");
	
	
	if(sizeof($data[0])==0)
	{
	echo '<script>alert("Please Entervalid id")</script>';
	}
	else
	{
	$sno=$data[0]['id'];
	$name=$data[0]['title'];
	$email=$data[0]['author'];
	
	}
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
     
	  <form action="#" class="signin-form" method='POST' enctype="multipart/form-data" onchange="loadFile(event)" onkeydown="return event.key != 'Enter';">
	  <br/>
	  <div class="col-lg-2">
      <span class='pagetitle'>IssueBooks</span>
	  
    </div>
	<hr class='w-75'/>
	  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Booknumber</p>
    </div>
      <div class="col-lg-5">
	  <!--input type='hidden'  value='<?php echo $sno; ?>' name="data[_id_no]" /-->
      <input type="text" accesskey="s" class="form-control" value='<?php echo $sno; ?>' name="data[id_no]" placeholder="Booknumber" >
    </div>
	
  </div>
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Bookname</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="Bookname" name="data[name]" value='<?php echo $name; ?>' >
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>Author</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="Author" name="data[email]" value='<?php echo $email; ?> '>
    </div>
	<div class="col-lg-4">
            <p id='txt'></p>
          </div>
  </div>
  
  <div class="row mb-3">
    <div class="col-lg-2">
      <p>StudentId</p>
    </div>
      <div class="col-lg-5">
      <input type="text" class="form-control" placeholder="Enter Student ID" value="" name="data[stdid]"  >
	  
    </div>
	<div class="col-lg-4">
            <p id='txt'>
	  <a href='search.php' target='new'>Check StudentDetails</a>
	  </p>
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
            <p id="txt"></p>
          </div>
  </div>
  
  

    </div>
	
  </div>

 
  
    
  <div class="form-group">
<button type="submit"  accesskey="a" name='search' class="form-control btn submit" id='btn' data-toggle="modal" data-target="#exampleModalCenter">Search</button>

<button type="submit" name='sub' class="form-control btn submit " id='btn' style='margin-left:-0px;' id='btn'>Save</button>
</div>

</form>

<!-- Button trigger modal -->


<!-- Modal -->

  </div>
</div>


	  
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
	
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
	
	
  </body>
</html>