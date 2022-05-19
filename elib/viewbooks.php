<?php
include_once('.//php//libscript.php');
require_once './/image-resizer-master//lib//Image.php';
session_start();

$book_id=insert_stdid();
$data=getalldata();


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
<style>
table.table-fit {
    width: auto !important;
    table-layout: auto !important;
}
table.table-fit thead th, table.table-fit tfoot th {
    width: auto !important;
}
table.table-fit tbody td, table.table-fit tfoot td {
    width: auto !important;
}
</style>

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
   
   
   <div class="row">
    <div>
	<br/>
      <table class="table table-bordered " style='margin-left:100px;'>
  <thead>
    <tr class="table-primary text-center"">
	<th scope="col ">Sno</th>
      <th scope="col">Idno</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Price</th>
	  <th scope="col">EntryDate</th>
	  <th scope="col">Student</th>
	  <th scope="col">status</th>
    </tr>
  </thead>
  <tbody>
  <?php
	for($i=0;$i<count($data);$i++)
	{
echo<<<l
<tr class=text-center>
      <th scope="row">$i</th>
l;
		foreach($data[$i] as $value)
		{
			$value = wordwrap($value, 20, "<br />\n",true);
			
			echo "<td class=text-center >".$value."</td>";
		}
	echo "</tr>";
	}
  
  ?>
  </tbody>
  
</table>
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
	
  </body>
</html>