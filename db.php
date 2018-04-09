<?php 

class DBConnection {
	protected $connection;

	public function getConnInstant() {
		if (!isset($this->connection)) {
			$this->connection = new PDO ('mysql:host=localhost;dbname=Email;charset=utf8mb4', 'root', 'root');
		}
		return $this->connection;
	}

	public function addTemplate($content, $name, $vars) {
		// TODO: Add Check - content,name,vars

		// Add to DB
		// 列名和数据库对应 templates(tcontent)
		$stmt = $this->getConnInstant()->prepare("INSERT into templates(tcontent, tname, tvar) VALUES(:content, :name, :vars)");
		$result = $stmt->execute(
			array(
				':content' => $content,
				':name' => $name,
				':vars' => $vars
			)
		);
		return $result;
	}

	public function getAllTemplates() {
		$stmt = $this->getConnInstant()->query("SELECT * FROM templates");
		$templates = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//TODO: array to object, templates class model to oject class model.

		$result = array();
		foreach ($templates as $template) {
			$temp = array(
				//和数据库对应
				'content' => $template['tcontent'],
				'name' => $template['tname'],
				'vars' => $template['tvar'],
				'id' => $template['tid']
			);
			$result[] = $temp;
		}
		return $result;
	}

	public function getTemplateById($id) {
		$stmt = $this->getConnInstant()->prepare("SELECT * FROM templates WHERE (tid = :id)");
		$stmt->execute(
			array(
				':id'=> $id,
			)
		);
		//fetch 配合搜索结果，取回结果
		$template = $stmt->fetch();
		$result = array(
			'content' => $template['tcontent'],
			'name' => $template['tname'],
			'vars' => $template['tvar'],
			'id' => $template['tid']
		);
		return $result;

	}
}

/*测试 getAllTemplate()*/
// $db = new DBConnection();
// $sth = $db->getAllTemplates();
// var_dump($sth);

/*测试 getTemplateById(1)*/
// $db = new DBConnection();
// var_dump($db->getTemplateById(1));



?>