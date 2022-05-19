<?php
//Author Chinthapalli_srinivas
include_once('.//php//db.php');

class tables
{
	private $conn;
	private $info=array();
	private $db;
	function __construct($host, $user, $pass, $db)
	{	
		$this->info=array('host'=>$host,
						  'user'=>$user,
						  'pass'=>$pass,
						  'db'=>$db);
		
		$this->connection();
		$this->select_db();
		

	}
	function connection()
	{
	$this->conn =mysql_connect($this->info['host'], $this->info['user'], $this->info['pass']);
	if (!$this->conn) {
    die('Could not connect: ' . mysql_error());
}
	}
	function getconnection()
	{	$this->connection();
		return $this->conn;
	}
	function createDatabase($dbname)
	{
		$command="create database ".$dbname;
		echo $command;
		
		$result=mysql_query($command, $this->conn);
		if (!$result) 
		{
		die('Invalid query: ' . mysql_error());
		}
		else 
		{
		echo "TableCreated...<br/>";
		}
		
	}
	function select_db()
	{
		$this->connection();
		$db_selected = mysql_select_db($this->info['db'], $this->conn);
			if (!$db_selected) 
			{
				$this->createDatabase('e_lib');
				//die ('Can\'t use foo : ' . mysql_error());
				
			}
			
		
		
		
	}
	function sqlcommands($data)
	{
		$query=$data;
		$result=mysql_query($query, $this->conn);
		if (!$result) 
		{
		die('Invalid query: ' . mysql_error());
		}
		else 
		{
		echo "TableCreated...<br/>";
		}
		
	
	}
	function __destruct() {
	mysql_close($this->conn);
	}
	
	function insert_data($table,$array)
	{	$fields = '';
		$values = '';
		foreach($array as $col=>$value)
		{
		$fields .= sprintf("`%s`,", $col);
		$values.=sprintf("'%s',", mysql_real_escape_string($value));
		}
		$fields = substr($fields, 0, -1);
		$values = substr($values, 0, -1);
		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $fields, $values);
	if(!mysql_query($sql)){
	echo mysql_error();
	}
	else
	{echo mysql_error();
		echo 'Username password created';
	}
	}
}


$mysql=new tables(host,username,password,db);

$t1=<<<l
CREATE TABLE IF NOT EXISTS `issuebooks` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(700) NOT NULL,
  `title` varchar(5000) NOT NULL,
  `student_id` varchar(5000) NOT NULL,
  `entrydate` varchar(5000) NOT NULL,
  `returndate` varchar(5000) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

l;
$t2=<<<l
CREATE TABLE IF NOT EXISTS `lib` (
  `id` varchar(700) NOT NULL,
  `title` varchar(5000) NOT NULL,
  `author` varchar(5000) NOT NULL,
  `price` varchar(5000) NOT NULL,
  `entrydate` varchar(5000) NOT NULL,
  `taking` varchar(5000) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


l;
$t3=<<<l

CREATE TABLE IF NOT EXISTS `std_registraion` (
  `sno` varchar(500) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `dob` varchar(1000) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `edu` varchar(1000) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `gendar` varchar(1000) NOT NULL,
  `address` varchar(5000) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

l;
$t4=<<<l
CREATE TABLE IF NOT EXISTS `users` (
  `sno` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(5000) NOT NULL,
  `password` varchar(5000) NOT NULL,
  `in_time` varchar(5000) NOT NULL,
  `out_time` varchar(5000) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

l;
$mysql->sqlcommands($t1);
$mysql->sqlcommands($t2);
$mysql->sqlcommands($t3);
$mysql->sqlcommands($t4);


$mysql->insert_data('users',array('name'=>'srinivas','password'=>'12345'));
?>