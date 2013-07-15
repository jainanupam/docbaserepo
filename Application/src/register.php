<?php
	include ("connect.php");
	require($_SERVER['DOCUMENT_ROOT'].'version/class.phpmailer.php');
	require($_SERVER['DOCUMENT_ROOT'].'version//class.smtp.php');
	if (isset($_POST['formsubmitted'])) 
	{	
	 	$error = array();//Declare An Array to store any error message
		if (empty($_POST['username'])) 
		{
			//if no name has been supplied 
	        $error[] = 'Please Enter a name ';//add to array "error"
	    }  
		else 
		{
			//else assign it a variable
	        $username = $_POST['username'];
	    }
		if (empty($_POST['e-mail'])) 
		{
	        $error[] = 'Please Enter your Email ';
	    }
		else 
		{
	        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail'])) 
			{
	           //regular expression for email validation
	            $Email = $_POST['e-mail'];
	        } 
			else 
			{
	             $error[] = 'Your EMail Address is invalid  ';
	        }
	    }
		if (empty($_POST['password'])) 
		{
	        $error[] = 'Please Enter Your Password ';
	    }
		else 
		{
	        $Password = $_POST['password'];
	    }
	
		//send to Database if there's no error '
		if (empty($error)) 
	   	{ 
			// If everything's OK...
	        // Make sure the email address is available:
	        $query_verify_email = "SELECT * FROM users  WHERE Email ='$Email'";
	        $result_verify_email = mysql_query($query_verify_email,$connect);
	        if (!$result_verify_email) 
			{
				//if the Query Failed ,similar to if($result_verify_email==false)
	            echo ' Database Error Occured ';
	        }

	        if (mysql_num_rows($result_verify_email) == 0) 
			{ 
				// IF no previous user is using this email .
	            // Create a unique  activation code:
	            $activation = md5(uniqid(rand(), true));
	            $query_insert_user = "INSERT INTO `users` ( `Username`, `Email`, `Password`, `Activation`) VALUES ( '$username', '$Email',  md5('".$_POST['password']."'), '$activation')";
	            $result_insert_user = mysql_query($query_insert_user,$connect);
	            if (!$result_insert_user)
				{
	                echo 'Query Failed ';
	            }
	            if (mysql_affected_rows($connect) == 1) 
				{ //If the Insert Query was successfull.
	                // Send the email:
	                $message = " To activate your account, please click on this link:  \n\n</br>";
	                $message .= WEBSITE_URL . '/version/activate.php?email=' . urlencode($Email) . "&key=$activation";
					$mail  = new PHPMailer();
					$body=$message;
					$mail->IsSMTP();
					$mail->SMTPAuth  = true;                 #enable SMTP authentication
					$mail->SMTPSecure = "ssl";               #sets the prefix to the server
					$mail->Host  = "smtp.gmail.com";         #sets GMAIL as the SMTP server
					$mail->Port       = 465;                 #set the SMTP port
					$mail->Username   = "payamrastogi";                  #your gmail username
					$mail->Password   = "";                  #Your gmail password
					$mail->From       = "payamrastogi@gmail.com";                  #your gmail id
					$mail->FromName   = "payam rastogi";                  #your name
					$mail->Subject    = "Verify your Email Account";
					$mail->WordWrap   = 50;
					$mail->AddAddress($Email,$username);
					$mail->MsgHTML($body);
					$mail->IsHTML(true); // send as HTML
					$result = $mail->Send();
					$systemError = FALSE;
					$alreadyRegistered = FALSE;
					if(!$mail->Send())
					{
						echo "Mailer Error: " . $mail->ErrorInfo;
					}
					else
					{
						//echo "Message has been sent";
					}
	            } 
				else 
				{ 
					// If it did not run OK.
				   $systemError=TRUE;
	            }
	        } 
			else 
			{ 
				// The email address is not available.
			   $alreadyRegistered=TRUE;
	        }
	    } 
		else 
		{//If the "error" array contains error msg , display them
			echo '<div class="errormsgbox"> <ol>';
	        foreach ($error as $key => $values) 
			{    
	            echo '	<li>'.$values.'</li>';
	        }
	        echo '</ol></div>';
	    }
	    mysql_close($connect);//Close the DB Connection
	}// End of the main Submit conditional.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>
<link rel="stylesheet" href="./css/bootstrap.css" />
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
<form action="register.php" method="post" class="form-horizontal">
    <legend><p class="text-left">Registration Form</p><p class="text-right">Already a member?<a class="btn btn-info" href="index.php">Log in</a></p></span></p></legend>
  
  <div class="container">
        	<div class="row-fluid">
            	<div class="span12">
                    <div class="span6">
                    	<div class="area">
                            <form class="form-horizontal">
                                <div class="heading">
                                    <h4 class="form-heading">Create a new Account</h4>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="username">Name</label>
                                    <div class="controls">
                                        <input type="text" id="username" name="username" placeholder="E.g. Bruce Wayne" required>
                                    </div>
                                </div>
          
                                <div class="control-group">
                                    <label class="control-label" for="e-mail">Email</label>
                                    <div class="controls">
                                        <input type="text" id="e-mail" name="e-mail" placeholder="E.g. test@batman.com" required>
                                    </div>
                                </div>
								
                                <div class="control-group">
                                    <label class="control-label" for="password">Password</label>
                                    <div class="controls">
                                        <input type="password" id="password" name="password" placeholder="##########">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input type="checkbox"> I agree all your <a href="#">Terms of Services</a>
                                        </label>
										<input type="hidden" name="formsubmitted" value="TRUE" />
                                        <button type="submit" class="btn btn-success">Sign Up</button>
										<button type="button" class="btn">Help</button>
                                    </div>
                                </div>
								
								<?php	
								global $result;
								if($result)
								{?>
									<div id="messageBox" class="alert alert-success">
                                    <a class="close" data-dismiss="alert" href="#">×</a>
                                    <strong>Confirmation: </strong> A confirmation email has been sent to your email.<br>
                                    Thank you for your registration.
                                </div>
								<?php 
								}
								global $systemError;
								if($systemError)
								{?>
									<div id="messageBox" class="alert alert-error">
                                    <a class="close" data-dismiss="alert" href="#">×</a>
                                    <strong>System Error: </strong>You could not be registered due to a system error. We apologize for any inconvenience.<br>
						<?php   }
								global $alreadyRegistered;
								if($alreadyRegistered)
								{ ?>
									<div id="messageBox" class="alert alert-error">
                                   <a class="close" data-dismiss="alert" href="#">×</a>
                                    <strong>System Error: </strong>That email address has already been registered.<br>								
								<?php 
								} ?>	
                            </form>	
						</div>                            
                    </div>
                </div>
            </div>
        </div>
</form>
</body>
</html>