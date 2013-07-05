<html>
<head>
</head>
<body>

<form name="loginform" action="login_exec.php" method="post">
<div align="center" style="border:solid;border-color:blueviolet;font-family: Arial;">
<table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
	<tr>
		<td colspan="2" align="center">
			Enter your credentials to proceed
		</td>
	</tr>
  <tr>
    <td colspan="2">
		<!--the code bellow is used to display the message of the input validation-->
		 <?php
			session_start();
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 )
			{
				echo '<ul class="err">';
				foreach($_SESSION['ERRMSG_ARR'] as $msg) 
				{
					echo '<li>',$msg,'</li>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			unset($_SESSION['SESS_MEMBER_ID']);
			}
			session_destroy();
		?>
	</td>
  </tr>
  <tr>
    <td width="116"><div align="right">Username</div></td>
    <td width="177"><input name="username" type="text" tabindex="1" /></td>
  </tr>
  <tr>
    <td><div align="right">Password</div></td>
    <td><input name="password" type="password" tabindex="2" /></td>
  </tr>
  <tr>
    <td><div align="right"><a href="register.html">New User?</a></div></td>
    <td><input name="" type="submit" value="login" tabindex="3" /></td>
  </tr>
</table>
</div>
</form>
</body>
</html>