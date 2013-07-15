<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="./css/bootstrap.css" />
<title>Activate Your Account</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
<script>
$(document).ready(function(){
  $(".close").click(function(){
    $("#messageBox").hide();
  });
});
</script>
</head>
<body>
<?php
$statusSuccess = FALSE;
$systemError2 = FALSE;
include ('connect.php');
if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email']))
{
    $email = $_GET['email'];
}
if (isset($_GET['key']) && (strlen($_GET['key']) == 32))//The Activation key will always be 32 since it is MD5 Hash
{
    $key = $_GET['key'];
}
if (isset($email) && isset($key))
{
    // Update the database to set the "activation" field to null
    $query_activate_account = "UPDATE users SET Activation=NULL WHERE(email ='$email' AND Activation='$key')LIMIT 1";
    $result_activate_account = mysql_query($query_activate_account,$connect) ;
    // Print a customized message:
    if (mysql_affected_rows($connect) == 1)
    {
		//if update query was successfull
		$statusSuccess = TRUE;
    } 
    else
    {
		$statusSuccess = FALSE;
    }
    mysql_close($connect);
} 
else 
{
	$systemError2 = TRUE;
    //echo '<div class="errormsgbox">Error Occured .</div>';
}
?>
<?php	
	if($statusSuccess)
	{?>
		<div id="statusMessage" class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">×</a>
		Your account is now active. You may now <a href="index.php">Log in</a>
       	</div>
<?php }
	else
	{ ?>
		<div id="statusMessage" class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">×</a>
        Oops !Your account could not be activated. Please recheck the link or contact the system administrator.
       	</div>
<?php }
	if($systemError2)
	{ ?>
		<div id="statusMessage" class="alert alert-info">
        <a class="close" data-dismiss="alert" href="#">×</a>
        Error Occured .
       	</div>
<?php	}
?>
</body>
</html>