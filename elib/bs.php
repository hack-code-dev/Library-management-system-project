<?php
include_once('.//php//db.php');
include_once('.//php//myscript.php');
require_once './/image-resizer-master//lib//Image.php';
session_start();



$sno='';
$data=null;

function logincheck()
{

if($_SESSION["logged_in"]==True)
	return 0;
else
	return 1;

}
if(logincheck())
	header("location:index.php");

$data=null;
$message="";
$check="";
if(isset($_POST['_search']))
{
$sno=$_POST['idno'];
$data=all_books($sno);


}
if(isset($_POST['sub']))
{
	$d=explode(",",$_POST['ans']);
	$sno=$_POST['ID']; 
	
	$date = date('d/m/Y');
	
	foreach($d as $key)
		$check=returnbooks($key,$date);
		
		
		$data=all_books($sno);
		
		if(empty($data)==1)
		{
		$check=4;
		}
	

		
}		

if($check==0)
	$message="Success";

if($check==1)
	$message="Some Error Occur";

if($check==3)
	$message="Please Click CheckBox";

if($check==4)
	$message="No Records Found";
	


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
		document.getElementById("_sub").style.display='none';
		
        $('.dropdown-toggle').dropdown();
    });
	function f(txt)
	{
	
	document.getElementById('txt').value=txt;
	document.getElementById('frm').submit();
	}
	
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
	<a href="#" class="d-block px-3 py-2 text-center text-bold text-white old-bv">
	<?php echo collegename ;?></a>
	</div>
	
	<div class="panel" style='background:#563d7e'>
  <div class="panel-body">
  <i class="fa fa-user-circle" aria-hidden="true" style='font-size:30px;color:white;margin:10px 0px 0px 10px;'></i>
  <span style='position:absolute;margin:12px 0px 0px 10px;color:white;'><b>
  <?php
  echo collegename;
  ?>
  </b></span>
  
  </div>
 
</div>

<div class="row">
    <?php
	echo file_get_contents('menu.txt');
	?>
   
<div class="col-8" style='margin-left:5%;'>  
<?php
$date = date('d/m/Y');
echo<<<l
<form action='#' method='POST' >
<div class="d-flex justify-content-center">
<table "table text-center">
<tr class="table text-center">
<td><input type='text' class='form-control' name='idno' />

</td><td><input type='submit'  value='Search' name='_search' class='btn btn-success'  /></td>
</tr>

</table>
</div>
l;
echo "<table  class='table table-bordered '><form action='#' method='POST'  >";

echo<<<l
<thead  class="bg-info text-white">
    <tr class='text-center'>
      <th scope="col"></th>
      
      <th scope="col">BookID</th>
      <th scope="col">BookTitle</th>
	  <th scope="col">StudentID</th>
	  <th scope="col">EntryDate</th>
	  <th scope="col">ReturnDate</th>
    </tr>
  </thead>
l;

for($i=0;$i<count($data);$i++)
{
	array_pop($data[$i]);
	$v=$data[$i]['sno'];
	echo "<tr>";
	echo "<td class='text-center'> <input type='checkbox'  value=$v id=$v  onclick='f(value)'></td>";
	foreach($data[$i] as $index=> $key)
	{
		if($index=="sno")
		{
		echo "<td class='text-center' style='display:none;'> $key";
		}
		else 
		{
		echo "<td class='text-center'> $key";
		}
	}
	echo "<td class='text-center'>$date</td>";
	
	echo "</tr>";
	
}
echo "<tr style='border:none;'><td></td><td></td><td></td><td></td><td></td><td><input type='submit' name='sub' value='Submit' class='btn btn-success' style='position:absolute;margin-left:50px;'   id='_sub' /><br/><br/></td></tr>";
echo "</table>";

echo "<input type='hidden' id='checkvalues' name='ans'  />";
echo "<input type='hidden'  name='ID' value=$sno   />";
echo "</form></div>";
?>
</div>
    </div>
      
  </div>
   
   
  </div>
  
  



  
  
  


</div>

	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
<script src=".//js//cal.js"></script>
<script src=".//js/form.js"></script>
<script type="text/javascript">
    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
</script>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Message...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p><?php echo $message; ?></p>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>


<?php

if($check!="")
{
echo<<<l
<script>
$(document).ready(function(){
   $('#exampleModal').modal('show');
});
</script>

l;
}


?>
	
	
  </body>
</html>