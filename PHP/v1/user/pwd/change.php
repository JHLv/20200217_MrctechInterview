<?php
/**
 * 03修改會員密碼_API 
 * 修改會員密碼至MYSQL, API回傳狀態等訊息.
 */	
	include_once("../../db_connect.php");
	
	class change {	//Init output 
		public $Code = 0;
		public $Message;
		public $Result = array(
			"IsOK" => ""
		);
	}

	$resp = new change();

	if (isset($_POST["password_change"])){
		$chan="update mrctech set`Password`='".$_POST["password_change"]."'WHERE account='".$_POST["account_login"]."'";
		if ($conn->query($chan) === TRUE) {		//if Update request was successfully 
			$resp -> Message = "The password changed successfully!";
			$resp -> Result["IsOK"] = true;
		} else {
			$resp -> Message = 'The changed password was false.';	
			$resp -> Result["IsOK"] = false;	
		}		
		
		echo json_encode($resp);	//finally, return results of the POST request.	
	}
?>