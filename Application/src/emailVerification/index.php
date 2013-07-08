
<?php
/*registration page*/


include ('database_connection.php');
require($_SERVER['DOCUMENT_ROOT'].'emailVerification/class.phpmailer.php');
require($_SERVER['DOCUMENT_ROOT'].'emailVerification//class.smtp.php');
if (isset($_POST['formsubmitted'])) {
    $error = array();//Declare An Array to store any error message  
    if (empty($_POST['name'])) {//if no name has been supplied 
        $error[] = 'Please Enter a name ';//add to array "error"
    } else {
        $name = $_POST['name'];//else assign it a variable
    }

    if (empty($_POST['e-mail'])) {
        $error[] = 'Please Enter your Email ';
    } else {


        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail'])) {
           //regular expression for email validation
            $Email = $_POST['e-mail'];
        } else {
             $error[] = 'Your EMail Address is invalid  ';
        }


    }


    if (empty($_POST['password'])) {
        $error[] = 'Please Enter Your Password ';
    } else {
        $Password = $_POST['password'];
    }


    if (empty($error)) //send to Database if there's no error '

    { // If everything's OK...

        // Make sure the email address is available:
        $query_verify_email = "SELECT * FROM members  WHERE Email ='$Email'";
        $result_verify_email = mysqli_query($dbc, $query_verify_email);
        if (!$result_verify_email) {//if the Query Failed ,similar to if($result_verify_email==false)
            echo ' Database Error Occured ';
        }

        if (mysqli_num_rows($result_verify_email) == 0) { // IF no previous user is using this email .


            // Create a unique  activation code:
            $activation = md5(uniqid(rand(), true));


            $query_insert_user = "INSERT INTO `members` ( `Username`, `Email`, `Password`, `Activation`) VALUES ( '$name', '$Email', '$Password', '$activation')";


            $result_insert_user = mysqli_query($dbc, $query_insert_user);
            if (!$result_insert_user) {
                echo 'Query Failed ';
            }

            if (mysqli_affected_rows($dbc) == 1) { //If the Insert Query was successfull.


                // Send the email:
                $message = " To activate your account, please click on this link:  \n\n</br>";
                $message .= WEBSITE_URL . '/emailVerification/activate.php?email=' . urlencode($Email) . "&key=$activation";
				
				$mail  = new PHPMailer();
				$body=$message;
				$mail->IsSMTP();
				$mail->SMTPAuth  = true;                 #enable SMTP authentication
				$mail->SMTPSecure = "ssl";               #sets the prefix to the server
				$mail->Host  = "smtp.gmail.com";         #sets GMAIL as the SMTP server
				$mail->Port       = 465;                 #set the SMTP port
				$mail->Username   = "";                  #your gmail username
				$mail->Password   = "";                  #Your gmail password
				$mail->From       = "";                  #your gmail id
				$mail->FromName   = "payam rastogi";                  #your name
				$mail->Subject    = "Verify your Email Account";
				$mail->WordWrap   = 50;
				$mail->AddAddress($Email,$name);
				$mail->MsgHTML($body);
				$mail->IsHTML(true); // send as HTML
				if(!$mail->Send())
				{
					echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
					echo "Message has been sent";
				}
				
                //mail($Email, 'Registration Confirmation', $message, 'From: ismaakeel@gmail.com');

                // Flush the buffered output.


                // Finish the page:
                echo '<div class="success">Thank you for
registering! A confirmation email
has been sent to '.$Email.' Please click on the Activation Link to Activate your account </div>';


            } else { // If it did not run OK.
                echo '<div class="errormsgbox">You could not be registered due to a system
error. We apologize for any
inconvenience.</div>';
            }

        } else { // The email address is not available.
            echo '<div class="errormsgbox" >That email
address has already been registered.
</div>';
        }

    } else {//If the "error" array contains error msg , display them
        
        

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            
            echo '	<li>'.$values.'</li>';


       
        }
        echo '</ol></div>';

    }
  
    mysqli_close($dbc);//Close the DB Connection

} // End of the main Submit conditional.



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Form</title>
<link rel="stylesheet" href="./static/css/bootstrap.css" />
</head>
<body>


<form action="index.php" method="post" class="form-horizontal">
    <legend><p class="text-left">Registration Form</p><p class="text-right">Already a member?<a class="btn btn-info" href="login.php">Log in</a></p></span></p></legend>
  
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
                                    <label class="control-label" for="name">Name</label>
                                    <div class="controls">
                                        <input type="text" id="name" name="name" placeholder="E.g. Bruce Wayne" required>
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
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">�</button>
                                    <strong>Confirmation: </strong> A confirmation email has been sent to your email.<br>
                                    Thank you for your registration.
                                </div>
                            </form>	
						</div>                            
                    </div>
                </div>
            </div>
        </div>
  
</form>

</body>
</html>
