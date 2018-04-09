<?php 

$param = $_GET['param'];

// 1. list/add
// 2. list
// 3. list/delete/{id}
// 4. send

$param_array = explode('/', $param);
// var_dump($param_array);
// 用url的第一位访问文件，找list.php是不是存在
// $param_array[0]=list
if (!file_exists($param_array[0] . '.php')) {
	echo "Sorry, wrong route";
	exit;
}
require_once($param_array[0] . '.php');

$handle_obj = new $param_array[0]();

// 判断第一位存不存在
if (array_key_exists(1, $param_array)) {
	$method = $param_array[1] . 'Method';
} else {
	$method = 'defaultMethod';
}

if (array_key_exists(2, $param_array)) {
	$handle_obj->$method($param_array[2]);
} else {
	$handle_obj->$method();
}


?>