<?php 

class templates {
	public function indexMethod() {
		return 'template index action is working';
	}

	//API 定义，相当于一个格式或模板,开发的人按照定义来开发，使用的人按照定义来使用
	/*
	* Method: POST
	* URL: templates/save
	* 
	* Request body format
	* req -post :
	* 
	* {
	*	"content": "<h1>html content</h1>",
	*	"name": "template 1",
	*	"var": "var1;var2"
	* }
	* 
	* will return format:
	* json:
	* {
	* 	"code": 200,
	* 	"message": "success"
	*}
	*/
	public function saveMethod() {
		$content = $_POST['content'];
		$name = $_POST['name'];
		$var = $_POST['var'];

		$conn = new DBConnection();
		$result = $conn->addTemplate($content, $name, $var);

		if ($result) {
			return json_encode(array(
				'code' => 200,
				'message' => "Template add successfully"
			));
		} else {
			return json_encode(array(
				'code' => 500,
				'message' => "Template add failed"
			));
		}
	}

	/*
	* Request body format
	* Method: GET
	* URL: templates/get
	* will return:
	* json:
	* {
	* 	{
	* 		"id": 1,
	* 		"content": "Hello",
	* 		"name": "template 1",
	*		"var": "var1;var2"
	* 	},
	* 	{
	* 		"id": 2,
	* 		"content": "Hello2",
	* 		"name": "template 2",
	*		"var": "var1;var2"
	* 	}
	* }
	*/

	public function getMethod() {
		$conn = new DBConnection();
		$results = $conn->getAllTemplates();

		if ($results) {
			return json_encode($results);
		} else {
			return json_encode(array(
				'code' => 400,
				'message' => "no Template exists"
			));
		}
	}
}

?>