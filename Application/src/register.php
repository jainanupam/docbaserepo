<?php
include ("connect.php");
if(mysql_num_rows(mysql_query("SELECT * from users WHERE username='" . $_POST['username'] . "'")) == 1){
   echo "Oops! Username is already in use!";
}
else if($_POST['password'] != $_POST['repassword']){
   echo "Oops! The two entered passwords don`t match!";
}
else if(strlen($_POST['username']) > 15){
   echo "Oops! Username is too long!";
}
else if(strlen($_POST['username']) < 6){
   echo "Oops! Username is too short!";
}
else if(strlen($_POST['password']) > 15){
   echo "Oops! Password is too long!";
}
else if(strlen($_POST['password']) < 6){
   echo "Oops! Password is too short!";
}
else{
   mysql_query("INSERT into users VALUES ('".$_POST['username']."', md5('".$_POST['password']."'))") or die(mysql_error());
   header('Location: register.html');
   //echo(md5($_POST['password']));
}
?>