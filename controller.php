<?php
	header("Content-type: text/json");
	require_once('connection.php');
	
	if(isset($_GET['action'])){
		$action = $_GET['action'];

		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		if(isset($_GET['firstname'])) {
			$firstname = $_GET['firstname'];
		}
		if(isset($_GET['lastname'])) {
			$lastname = $_GET['lastname'];
		}
		if(isset($_GET['phone'])) {
			$phone = $_GET['phone'];
		}

		switch($action){
			case 'insert':
				if(isset($phone))
					insertContact($firstname, $lastname, $phone);
				break;

			case 'select':
					selectContact();
				break;

			case 'update':
				if(isset($id) && isset($phone))
					updateContact($id, $firstname, $lastname, $phone);
				break;

			case 'delete':
				if(isset($id))
					deleteContact($id);
				break;

			default:
				break;
		}
	}

	if(isset($_POST['action'])) {
		$action = $_POST['action'];

		if(isset($_POST['id'])) {
			$id = $_POST['id'];
		}
		if(isset($_POST['firstname'])) {
			$firstname = $_POST['firstname'];
		}
		if(isset($_POST['lastname'])) {
			$lastname = $_POST['lastname'];
		}
		if(isset($_POST['phone'])) {
			$phone = $_POST['phone'];
		}
		switch($action){
			case 'insert':
				if(isset($phone))
					insertContact($firstname, $lastname, $phone);
				break;

			case 'select':
					selectContact();
				break;

			case 'update':
				if(isset($id) && isset($phone))
					updateContact($id, $firstname, $lastname, $phone);
				break;

			case 'delete':
				if(isset($id))
					deleteContact($id);
				break;

			default:
				break;
		}
	}

	function selectContact(){
		global $connection;
		$select = $connection->prepare("SELECT * FROM contact_tb");
		$select->execute();
		
		$array = array();
		$contacts = $select->fetchAll(PDO::FETCH_ASSOC);
		foreach($contacts as $contact) {
			array_push($array,$contact);	
		}
		echo '{"contact_tb":' . json_encode($array) . '}'; 
	}

	function insertContact($firstname, $lastname, $phone){
		global $connection;
		$insert = $connection->prepare("INSERT INTO contact_tb(firstname, lastname, phone) values (:firstname, :lastname, :phone)");
			$insert->bindValue(":firstname", $firstname);
			$insert->bindValue(":lastname", $lastname);
			$insert->bindValue(":phone", $phone);
			// $insert->execute();
		if($insert->execute()) {
			echo json_encode(array("response" => "success"));
		} else {
			echo json_encode(array("response" => "faillure"));
		}
	}

	function updateContact($id, $firstname, $lastname, $phone){
		global $connection;
		$update = $connection->prepare("UPDATE contact_tb SET lastname= :lastname, firstname= :firstname, phone= :phone WHERE id= :id");
			$update->bindValue(":id", $id);
			$update->bindValue(":firstname", $firstname);
			$update->bindValue(":lastname", $lastname);
			$update->bindValue(":phone", $phone);
		// $update->execute();
		if($update->execute()) {
			echo json_encode(array("response" => "success"));
		} else {
			echo json_encode(array("response" => "faillure"));
		}
	}

	function deleteContact($id){
		global $connection;
		$del = $connection->prepare("DELETE FROM contact_tb WHERE id= :id");
			$del->bindValue(":id", $id);	
			// $del->execute();
			if($del->execute()) {
				echo json_encode(array("response" => "success"));
			} else {
				echo json_encode(array("response" => "faillure"));
			}
	}

	/*
	LINK pour faire des TESTS:
		CREATE -- http://localhost/contact/controller.php?action=insert&firstname=John&lastname=Doe&phone=jd@gmail.com
	 	READ   -- http://localhost/contact/controller.php?action=select
		UPDATE -- http://localhost/contact/controller.php?action=update&id=1&firstname=Jane&lastname=Doe&phone=jane.doe@gmail.com
		DELETE -- http://localhost/contact/controller.php?action=delete&id=1
	*/
?>