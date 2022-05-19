<?php
require_once("db.php");

require_once("mysql_connection.php");
function data_lib($array)
{
	
$mysql = new MySQL(host, username,password,db);

try{
	$mysql->insert('issuebooks',
	array('id' => $array['id_no'], 
	'title' => $array['name'], 
	'student_id'=>$array['stdid'],
	'entrydate' => $array['entrydate'],
	'returndate' => '0'
	)
	);
	$mysql->where('id', $array['id_no'])->update('lib', array('status' => '1','taking'=>$array['stdid']));
	echo '<script>alert("Success")</script>';
		//echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		echo 'Caught exception: ', $e->getMessage();
	}

}

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

function returnbooks($id,$date)
{
	//,$lib,$entrydate
	$flag=0;
	
	$mysql = new MySQL(host, username,password,db);

try{
	
	$post=$mysql->where('sno',$id)->get("issuebooks");
	
	
	$mysql->where('sno',$id)->update('issuebooks', array('returndate' => $date));
	$mysql->where('id', $post[0]['id'])->update('lib', array('status' => '0','taking'=>'0'));

		
	}catch(Exception $e){
		$flag=1;
		echo '<script>alert("Please Check Details...")</script>';
		echo 'Caught exception: ', $e->getMessage();
	}

	

return $flag;
}
function return_lib($array)
{	
	
$mysql = new MySQL(host, username,password,db);

try{
	
	$mysql->where('id', $array['id_no'])->update('issuebooks', array('returndate' => $array['entrydate']));
	$mysql->where('id', $array['id_no'])->update('lib', array('status' => '0','taking'=>'0'));
	echo '<script>alert("Success")</script>';
		//echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		echo 'Caught exception: ', $e->getMessage();
	}

}


function book_return_lib($array)
{	
	
$mysql = new MySQL(host, username,password,db);

try{
	echo $array['entrydate'];
	$mysql->where('sno', $array['sno'])->update('issuebooks', array('returndate' => $array['entrydate']));
	$mysql->where('id', $array['id_no'])->update('lib', array('status' => '0','taking'=>'0'));
	echo '<script>alert("Success")</script>';
		//echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		echo 'Caught exception: ', $e->getMessage();
	}

}


function flag($array)
{
$flag=0;

foreach($array as $key=> $value)
{
	
if($value=="")
	{
	$flag=1;

	
	break;
	}

}

return $flag;
}

function insert_stdid()
{
$id="";
$id_num="10nr1f00";
$line=file_get_contents("id_list.txt");

if((int)$line<9)
	$id=$id_num."0".$line;
else
	$id=$id_num."".$line;

$line=$line+1;
$file=fopen("id_list.txt","w");
fwrite($file,$line);
fclose($file);
return  $id;

}



function login_check()
{
/*session_start();
$name=$_SESSION["username"];
$password=$_SESSION["password"];
if($name=='' && $password=='')
	return 0;
else
	return 1;
*/
}

function search($id)
{
	$mysql = new MySQL(host, username,password,db);
	try{
		$post = $mysql->where('sno', $id)->get('std_registraion');
		
		return $post;
		
		
		}catch(Exception $e){
			 
			echo 'Caught exception: ', $e->getMessage();
			
							}
}

function libsearch($id,$tablename,$col)
{
	$mysql = new MySQL(host, username,password,db);
	try{
		if($tablename=='lib')
		{
		$array['status']='0';
		$array['id']=$id;
		}
		else 
			$array['sno']=$id;
		$post = $mysql->where($array)->get($tablename);
		
		return $post;
		
		
		}catch(Exception $e){
			 
			echo 'Caught exception: ', $e->getMessage();
			
							}
}

function return_search($id,$tablename,$col)
{
	$mysql = new MySQL(host, username,password,db);
	try{
		if($tablename=='lib')
		{
		$array['status']='1';
		$array['id']=$id;
		}
		else 
			$array['sno']=$id;
		$post = $mysql->where($array)->get($tablename);
		
		return $post;
		
		
		}catch(Exception $e){
			 
			echo 'Caught exception: ', $e->getMessage();
			
							}
}

function insertimage($id,$col,$image)
{
$mysql = new MySQL(host, username,password,db);







try{
	$mysql->where($col, $id)->update('std_registraion',
	array('image' => $image));
	
		
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		//echo 'Caught exception: ', $e->getMessage();
	}

}

function insert_data($array)
{
$mysql = new MySQL(host, username,password,db);
$dob=$array['data']['DD']."-".$array['data']['mm']."-".$array['data']['yyyy'];

//echo $array['data']['dd'];
try{
	$mysql->insert('std_registraion',
	array('sno' => $array['data']['id_no'], 
	'name' => $array['data']['name'], 
	'dob' => $dob,
	'email' => $array['data']['email'],
	'edu' => $array['data']['edu'],
	'mobile_number' => $array['data']['mobile'],
	'gendar' => $array['data']['gender'],
	'address' => $array['data']['addr'],
	'image'=>$array['data']['image']
	)
	);
	echo '<script>alert("Success")</script>';
		//echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		//echo 'Caught exception: ', $e->getMessage();
	}

}

function update_data($array,$id)
{
$mysql = new MySQL(host, username,password,db);
$dob=$array['data']['DD']."-".$array['data']['mm']."-".$array['data']['yyyy'];





//echo $array['data']['dd'];
try{
	$mysql->where('sno', $id)->update('std_registraion',
	array('sno' => $array['data']['id_no'], 
	'name' => $array['data']['name'], 
	'dob' => $dob,
	'email' => $array['data']['email'],
	'edu' => $array['data']['edu'],
	'mobile_number' => $array['data']['mobile'],
	'gendar' => $array['data']['gender'],
	'address' => $array['data']['addr']
	)
	
	);
	echo '<script>alert("Success")</script>';
		//echo $mysql->insert_id(); // id of newly inserted post
	}catch(Exception $e){
		echo '<script>alert("Please Check Details...")</script>';
		//echo 'Caught exception: ', $e->getMessage();
	}

}





function logout($d)
{

$mysql = new MySQL(host, username,password,db);
	try{
		
		session_start();
			$name=$_SESSION["username"];
			$password=$_SESSION["password"];
		$posts = $mysql->where('name', $name,'password',$password)->get('users');
		
		
		
		
		if( $mysql->num_rows())
		{
			
			
			date_default_timezone_set('Asia/Kolkata');
			$now= date('d-m-Y H:i');
			print($now);
			
			$mysql->where('sno',$posts[0]["sno"])->update('users', array($d => $now));
			session_destroy();
			
		}
		else
		{
		echo '<script>alert("Please Check Details...")</script>';
		}
		// number of rows returned
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	





}
function login($name,$password,$d)
{
$mysql = new MySQL(host, username,password,db);
	try{
		$array=array('name'=>$name,
					'password'=>$password);
		$posts = $mysql->where($array)->get('users');
		print_r($posts);
		
		
		
		if( $mysql->num_rows())
		{
			session_start();
			$_SESSION["username"]=$name;
			$_SESSION["password"]=$password;
			$_SESSION["logged_in"]=True;
			date_default_timezone_set('Asia/Kolkata');
			$now= date('d-m-Y H:i');
			print($now);
			$mysql->where('sno',$posts[0]["sno"])->update('users', array($d => $now,'out_time'=>'------'
			
			));
			return True;
			
		}
		else
		{
		
		return False;
		}
		// number of rows returned
	}catch(Exception $e){
		echo 'Caught exception: ', $e->getMessage();
	}
	
}




?>