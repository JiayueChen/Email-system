<?php 
class send {
	// function __construct() {
	// 	echo "send object is send";
	// }


	// public function otherMethod() {
	// 	echo "Using Other Method";
	// }


	/*
	* Request:
	* Method: POST
	* URL: send
	* Data:
	* {
	* 	"id": "3"
	*	"rcpt": "info@gmail.com"
	* }
	* Will Return:
	* 
	*/
	public function indexMethod() {
		// echo "Using Default Method";
		$tid = $_POST['id'];
		$recipient = $_POST['rcpt'];
		$conn = new DBConnection();
		$result = $conn->getTemplateById($tid);

		try {
			$mandrill = new Mandrill('aSznWSiyxJ8Kv-JemSNvgQ');
			$message = array(
				'html' => $result['content'],
				'subject' => $result['name'],
				'from_email' => 'postman@sunnyfuture.ca',
				'from_name' => 'Julia',
				'to' => array(
					array(
						'email' => $recipient,
						'type' => 'to'
					)
				),
				'headers' => array(
					'Reply-To' => 'chenjy527@gmail.com'
				),
				'important' => true,
				'track_opens' => true,
				'track_clicks' => true
			);
			$async = false;
			$ip_pool = 'Main Pool';
			$result = $mandrill->messages->send($message, $async, $ip_pool);
			return json_encode(array(
				'code' => 200,
				'message' => "success"
			));
		} catch(Mandrill_Error $e) {
			return json_encode(array(
				'code' => 500,
				'message' => "failed"
			));
		}
	}
}
?>