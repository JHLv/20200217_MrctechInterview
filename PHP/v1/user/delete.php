<?php
/**
 * 02刪除會員_API 
 * 刪除會員於MYSQL, API回傳狀態等訊息
 */	
	include_once("../db_connect.php");
	
	class _delete {	//Init output 
		public $Code = 0;
		public $Message;
		public $Result = array(
			"IsOK" => ""
		);
	}

	$resp = new _delete();

	if (isset($_POST["account_delete"])){
		$dele="DELETE FROM mrctech WHERE Account='".$_POST["account_delete"]."'";	
		if ($conn->query($dele) === TRUE) {		//deleting request
			$resp -> Message = "The member had been deleted successfully!";
			$resp -> Result["IsOK"] = true;
		} else {
			$resp -> Message = 'The deleting was false.';	
			$resp -> Result["IsOK"] = false;	
		}		
		
		echo json_encode($resp);	//finally, return results of the POST request.	
	}
?>