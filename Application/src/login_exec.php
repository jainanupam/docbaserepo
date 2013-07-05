<?php
	//Start session
	session_start();
 
	//Include database connection details
	include("connect.php");
 
	//Array to store validation errors
	$errmsg_arr = array();
 
	//Validation error flag
	$errflag = false;
 
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
 
	//Sanitize the POST values
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);
 
	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
 
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
 
	//Create query
	//echo $username . " : " . $password ;
	$qry="SELECT * FROM users WHERE username='$username'";
	$result=mysql_query($qry);
 
	//echo "result: ".$result;
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			//$_SESSION['SESS_MEMBER_ID'] = $member['mem_id'];
			$enc_password = $member['password'];
			$usr_password = md5($password);
			if($enc_password === $usr_password) {
				$_SESSION['SESS_MEMBER_ID'] = $member['username'];
				session_write_close();
				header("location: home.php");
				exit();
			} else {
				// Login Failed	
				/*$errmsg_arr[] = 'Incorrect user name/password';
				$errflag = true;
				if($errflag) {
					$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
					session_write_close();
					header("location: index.php");
					exit();
				
				}*/
				die('login failed');
			}
		}else {
			//Login failed
			$errmsg_arr[] = 'user name and/or password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
		}
	}else {
		die("Query failed");
	}

?>