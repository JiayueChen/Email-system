<?php 

// echo "list.php is used";
class emailList{
	// function __construct() {
	// 	echo "list object is created";
	// }

	public function addMethod() {
		echo "Using Add Method";
	}

	public function deleteMethod($id) {
		echo "Using Delete Method" . $id;
	}

	public function defaultMethod() {
		echo "Using Default Method";
	}
}
?>