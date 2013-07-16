<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="./css/bootstrap.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
 <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
<script>
$(document).ready(function(){
  $(".close").click(function(){
    $("#messageBox").hide();
  });
});
</script>
</head>
<body>
	<div class="container">
	<?php
				session_start();
				if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 )
				{
					echo '<div id ="messageBox" class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a><ul>';
					foreach($_SESSION['ERRMSG_ARR'] as $msg) 
					{
						echo '<li>',$msg,'</li>'; 
					}
				echo '</ul></div>';
				unset($_SESSION['ERRMSG_ARR']);
				unset($_SESSION['SESS_MEMBER_ID']);
				}
				session_destroy();
			?>
		<form class="form-signin" name="loginform" action="login_exec.php" method="post">
		<!--the code bellow is used to display the message of the input validation-->
		 	
        	<h2 class="form-signin-heading">Please sign in</h2>
        	<input type="text" id="username" name="username" class="input-block-level" placeholder="Email address" tabindex="1">
        	<input type="password" id="password" name="password" class="input-block-level" placeholder="Password" tabindex="2">
        	<label class="checkbox">
         		<input type="checkbox" value="remember-me"> Remember me
        	</label>
        	<button class="btn btn-large btn-primary" type="submit" name="submit" value="login">Sign in</button>
      </form>
    </div>
</body>
</html>