<?php
/**
 * 01新增會員_API 
 * 新增會員至MYSQL, API回傳狀態等訊息.
 */	
	include_once("../db_connect.php");
	
	class create {	//Init output 
		public $Code = 0;
		public $Message;
		public $Result = array(
			"IsOK" => ""
		);
	}

	$resp = new create();
	
	if (isset($_POST["account"])){
		//check for an existing account
		$sql = "SELECT * FROM mrctech WHERE account = '".$_POST["account"]."'";
		if ($result = $conn->query($sql)) {
			$data = $result->fetch_assoc();
			if ($data['Account'] != $_POST["account"]){		//if account doesn't exist	
				//registration for new member
				$regi="INSERT INTO mrctech(`Account`,`Password`,`updatetime`) VALUES('".$_POST["account"]."','".$_POST["password"]."',now())";
				if ($conn->query($regi) === TRUE) {
					$resp -> Message = "Your registration was successful!";
					$resp -> Result["IsOK"] = true;
				} else {
					echo "Error: " . $regi . "<br>" . $conn->error;
				}				
			} else {
				$resp -> Message = 'The account was existing, please enter another.';	
				$resp -> Result["IsOK"] = false;				
			}
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		echo json_encode($resp);	//finally, return results of the POST request.	
	}
?>