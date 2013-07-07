/*This page is displayed when the user is successfully logged in to application*/
<?php
	ob_start();
    session_start();
    if(!isset($_SESSION['Username'])){
         header("Location: login.php");
    }
    
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Area </title>
<style type="text/css">
 .success {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;
     font-weight:bold;
     width:450px;
     color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('images/success.png');
     
}



</style>
</head>

<body>
<div class="success">Welcome , <?php echo $_SESSION['Username']	; ?></div>
</body>
</html>
