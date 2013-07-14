<?php
	include('authenticate.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome!</title>
<style type="text/css">
<!--.style1 {
	font-size: 36px;
	font-weight: bold;
}
-->
</style>
<link rel="stylesheet" type="text/css" media="all" href="css\styles.css" />
</head>
 
<body>
<p align="center" class="style1">Welcome back <?php	echo $_SESSION['SESS_MEMBER_ID'];?>
 </p>
<p align="center">This page is the home, you can put some stuff here......</p>
<p>Upload file</p>
<form id="upload" method='post' enctype='multipart/form-data' action='file_upload.php'>
<fieldset>
<legend>HTML File Upload</legend>
<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="30000000" />
<div>
	<label for="file_upload">Files to upload:</label>
	<input type="file" id="file_upload" name="file_upload[]" multiple="multiple" />
	<div id="filedrag">or drop files here</div>
</div>
<div id="submitbutton">
	<button type="submit">Upload Files</button>
</div>
</fieldset>
	<!-- MAX_FILE_SIZE must precede the file input field -->
    <!--<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    File: <input type='file' name='file_upload'><br/>
    <input type='submit'>-->
</form>
<div id="progress"></div>
<div id="messages">
<p>Status Messages</p>
</div>

<p align="center"><a href="index.php">logout</a></p>
<script src="js\filedrag.js"></script>
</body>
</html>