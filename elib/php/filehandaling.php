<?php
function get_id()
{

$array = explode("\n", file_get_contents('id_list.txt'));
if($array[0]<9)
	return '0'.$array[0];
else
	return $array[0];

}
print(get_id());

?>