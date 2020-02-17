<?php
/**
 * Main page 
 * In this project, It focus on Members system with RESTful services. 
 */	

	session_start(); 
	include_once("db_connect.php");	//connecting DB
	include_once("restEngine.php");	//RestEngine API to using REST services.
?>
<?php
	$restEn = new restEngine();		//Called RestEngine API. In the Engine we have two options for RestServices fuction that "doRestAPI($method, $httpParam, $url) and doRestAPI_void()".
	
	if (isset($_POST["actionCode"])){	//POST actions
		$restEn -> setRequMeth('POST');
		switch($_POST["actionCode"]){
			case '01':	//API01_user-registration
				$restEn -> setHttpParam(array(
					'account' => $_POST["account"],
					'password' => $_POST["password"]
				));
				$restEn -> setRestUrl('http://'.$_SERVER['HTTP_HOST'].'/v2/user/create.php');	
				$restEn -> doRestAPI_void();	//POST to API01_user-registration by REST API.	
				break;
				
			case '02':	//API03_chaging-password
				$restEn -> setHttpParam(array(
					'account_login' => $_SESSION["account_login"],
					'password_change' => $_POST["password_change"]
				));
				$restEn -> setRestUrl('http://'.$_SERVER['HTTP_HOST'].'/v2/user/pwd/change.php');
				$restEn -> doRestAPI_void();	//POST to API03_chaging-password by REST API.			
				break;
				
			case '03':	//API02_deleting-member
				$restEn -> setHttpParam(array(
					'account_delete' => $_POST["account_delete"]
				));
				$restEn -> setRestUrl('http://'.$_SERVER['HTTP_HOST'].'/v2/user/delete.php');	
				$restEn -> doRestAPI_void();	//POST to API02_deleting-member by REST API.
				$result = $restEn -> getResult();
				$json_output = json_decode($result);
				if (!($json_output -> Code)){	//if deleting was successfully, return the result.
					echo "<script> alert('Response: \"$result\"');</script>";
					echo "<script> location.href='./user/logout.php';</script>";
				}	
				break;							
		}
		$result = $restEn -> getResult();
	} else if (isset($_GET["actionCode"])){		//GET actions
		//API01_user-Login
		$result = $restEn -> doRestAPI('GET', array(			
			'account_login' => $_GET["account_login"],
			'password_login' => $_GET["password_login"]
			), 'http://'.$_SERVER['HTTP_HOST'].'/v2/user/login.php');	//GET to API01_user-Login by REST API.	
		$json_output = json_decode($result);	
		if (!($json_output -> Code)){	//if login success, making a Login session for the member.
			$_SESSION["login"] = true;
			$_SESSION["account_login"] = $_GET["account_login"];			
		}
		echo "<script> alert('Response: \"$result\"');</script>";
		echo "<script> location.href='index.php';</script>";		
	}
?>
<script>		//alert for reminding user to fill all boxes
	function check(che){	//01 check for user Regist
		if(che["account"].value == ""){
			alert("帳號未填寫!"); return; 
		}else if(che["password"].value == ""){
			alert("密碼未填寫!"); return; 
		}else if(che["password2"].value == ""){
			alert("確認密碼未填寫!"); return; 
		}else if((che["password"].value) != (che["password2"].value)){
			alert("密碼不一致!"); return; 
		}else if(confirm("確定送出?")){
			document.form1.submit();
		}else{
			return;
		}
	}
	
	function check2(che){	//04 check for Login
		if(che["account_login"].value == ""){
			alert("帳號未填寫!"); return; 
		}else if(che["password_login"].value == ""){
			alert("密碼未填寫!"); return; 
		}else{
			document.form2.submit();
		}
	}
	
	function check3(che){	//03 check for changing pwd
		if(che["password_change"].value == ""){
			alert("密碼未填寫!"); return; 
		}else{
			document.form3.submit();
		}
	}
</script>
<div style="border:0px green solid;height:100px;">
<?php
	//message box for getting response of REST_API
	if (isset($_POST["actionCode"])){
		echo "<div>Response:<br>".$result."</div>";		
	}
?>
</div>
<center><font face="Arial" color="#4F87BA" size="30"><b>奇迹科技 面試作業</b></font></center>
<hr size="5" noshade width="90%" color="A3A3A1">
<table align="center" style="font-size:25;" border="0" width="70%" cellspacing="0">
	<tr>
		<td bgcolor="#FFFFFF" align="center">		
			<table align="left" style="font-size:25;" border="0" width="100%" cellspacing="0">
				<form name="form1" method="POST" action="">
				<tr><td align="center">1. 新增會員</td></tr>
				<tr><td align="center">帳號: <input type="text" name="account"></td></tr>
				<tr><td align="center">密碼: <input type="password" name="password"></td></tr>
				<tr><td align="center">密碼確認: <input type="password" name="password2"></td></tr>	
				<tr><td align="center"><input type="hidden" name="actionCode" value="01"></td></tr>
				<tr><td align="center">
					<input type="button" value="確認" style="border-radius:5px" onclick="check(document.form1);">	<!---submit registration request--->
					<input type="reset" value="取消" style="border-radius:5px">
				</td></tr>		
				</form>			
			</table>					
		</td>
		<td bgcolor="#FFFFFF" align="center" border="1">
			<table align="left" style="font-size:25;" border="0" width="100%" cellspacing="0">								
					<?php	
						if (isset($_SESSION["login"])){		//if login success
							echo "<form name='form3' method='POST'>";						
							echo $_SESSION["account_login"]." 歡迎登入!<br>";	
							echo "3.  修改會員密碼<br><input type='text' name='password_change' placeholder='Enter a new password...'>";
							echo "<input type='hidden' name='actionCode' value='02'>";							
							echo "<input type='button' value='確認修改' style='border-radius:5px' onclick='check3(document.form3);'><br><br>";	//submit Changing request
							echo "</form>";			
							echo "<form name='form4' method='POST'>";							
							echo "<input type='button' value='2. 刪除會員' style='border-radius:5px' onclick='submit();'>";		//submit Deletion request								
							echo "<input type='hidden' name='account_delete' value='".$_SESSION["account_login"]."'>";
							echo "<input type='hidden' name='actionCode' value='03'>";	
							echo "<input type='button' value='登出' style='border-radius:5px' onclick='location.href=\"./user/logout.php\";'>";		
							echo "</form>";							
						} else {
							echo "<form name='form2' method='GET'>";
							echo "4. 驗證帳號密碼<br>帳號: <input type='text' name='account_login'><br>";
							echo "密碼: <input type='password' name='password_login'><br>";
							echo "<input type='hidden' name='actionCode' value='04'>";
							echo "<input type='button' value='登入' style='border-radius:5px' onclick='check2(document.form2);'>";	//submit Login request
							echo "<input type='reset' value='取消' style='border-radius:5px'>";
							echo "</form>";
						}
					?>
				</td></tr>									
			</table>
		</td>
	</tr>
</table>
				
				