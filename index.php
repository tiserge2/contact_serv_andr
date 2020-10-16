<?php
    include("connection.php");
    $select = $connection->prepare("SELECT * FROM contact_tb");
	$select->execute();
	
	$array = array();
	$contacts = $select->fetchAll(PDO::FETCH_ASSOC);
	foreach($contacts as $contact) {
		array_push($array,$contact);	
	}
	echo '{"contact_tb":' . json_encode($array) . '}'; 
?>  