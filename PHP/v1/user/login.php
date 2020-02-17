<?php
/**
 * 04驗證帳號密碼_API 
 * 驗證登入會員, API回傳狀態等訊息.
 */	
	include_once("../db_connect.php");
	
	class login {	//Init output 
		public $Code = 0;
		public $Message;
		public $Result;
	}

	$resp = new login();
	
	if (isset($_GET["account_login"])){
		$sql = "SELECT * FROM mrctech WHERE Account = '".$_GET["account_login"]."'";
		if ($result = $conn->query($sql)) {		//requesting password
			$data = $result->fetch_assoc();
		}
		if($_GET["password_login"] == $data['Password']){	//if match
			$resp -> Code = 0;
			$resp -> Message = "Login successful";
		}else{
			$resp -> Code = 2;
			$resp -> Message = 'Login Failed';	
		}
		echo json_encode($resp);	//finally, return results of the GET request.	
	}

?>