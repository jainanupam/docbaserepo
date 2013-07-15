<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="./css/bootstrap.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
<div class="row">
<div class="span4 offset4 well">
			<legend>Sign in</legend>
<form class="" name="loginform" action="login_exec.php" method="post">
		<!--the code bellow is used to display the message of the input validation-->
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
	<div>
		<label class="control-label" for="username">Username</label>
		<input class="span4" id="username" name="username" type="text" tabindex="1" placeholder="test@batman.com" required/>
	</div>
    <div>
		<label class="control-label" for="password">Password</label>
		<input class="span4" id="password" name="password" type="password" tabindex="2" placeholder="Password" required/>
	</div>
  	<div>
		<label class="checkbox">
     		<input type="checkbox" name="remember" value="1">Remember Me
		</label>
	</div>
	<div>
	<button name="submit" type="submit" value="login" tabindex="3" class="btn btn-info btn-block">Sign in</button>
	</div>
	</form>
</div>
</div>
</div>
</body>
</html>