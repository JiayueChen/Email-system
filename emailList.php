<?php 

// echo "list.php is used";
class emailList{
	// function __construct() {
	// 	echo "list object is created";
	// }

	public function addMethod() {
		echo "Using Add Method";
	}

	/*
	* @Method otherMethod
	* @Input int id input id to delete
	* @Output boolean if trun delete
	* Detail - Current 
	*/
	public function deleteMethod($id) {
		echo "Using Delete Method" . $id;
	}

	public function indexMethod() {
		echo "Using Default Method";
	}
}
?>