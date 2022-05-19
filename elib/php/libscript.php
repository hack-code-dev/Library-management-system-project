<?php
require_once("db.php");

require_once("mysql_connection.php");

function all_books($id)
{
 
try{
	$mysql = new MySQL(host, username,password,db);
	$array['student_id']=$id;
	$array['returndate']='0';
	
$posts = $mysql->where($array)->get('issuebooks');

if(empty($posts))
return null;
else
	return $posts;

//echo $mysql->last_query(); // the raw query that was ran
}catch(Exception $e){
return null;
echo 'Caught exception: ', $e->getMessage();
}
}


function getalldata()
{
 
try{
	$mysql = new MySQL(host, username,password,db);
	$array['status']='0';
	
$posts = $mysql->where($array)->get('lib');

if(empty($posts))
return null;
else
	return $posts;

//echo $mysql->last_query(); // the raw query that was ran
}catch(Exception $e){
return null;
echo 'Caught exception: ', $e->getMessage();
}
}
function insert_stdid()
{
$id="";
$id_num="Lib_00";
$line=file_get_contents("lib_list.txt");

if((int)$line<9)
	$id=$id_num."0".$line;
else
	$id=$id_num."".$line;

$line=$line+1;
$file=fopen("lib_list.txt","w");
fwrite($file,$line);
fclose($file);
return  $id;

}

function insertdata($array)
{
$mysql = new MySQL(host, username,password,db);

try{
	$mysql->insert('lib',
	array('id' => $array['id'], 
	'title' => $array['title'], 
	'author' => $array['author'],
	'price' => $array['price'],
	'entrydate' => $array['entrydate'],
	'taking' => '0',
	'status' => '0'
	)
	);
	echo '<script>alert("Success")</script>';
		//echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		//echo 'Caught exception: ', $e->getMessage();
	}

}


?>