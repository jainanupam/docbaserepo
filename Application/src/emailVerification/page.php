<?php
	ob_start();
    session_start();
    if(!isset($_SESSION['Username'])){
         header("Location: login.php");
    }
    /**
 * @category       PHP5.4 Progress Bar
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012, Pierre-Henry Soria. All Rights Reserved.
 * @license        CC-BY License - http://creativecommons.org/licenses/by/3.0/
 * @version        1.0.0
 */
 
 /*This page is displayed when the user is successfully logged in to application*/

/**
 * Check the version of PHP
 */
if (version_compare(phpversion(), '5.4.0', '<'))
    exit('ERROR: Your PHP version is ' . phpversion() . ' but this script requires PHP 5.4.0 or higher.');

/**
 * Check if "session upload progress" is enabled
 */
if (!intval(ini_get('session.upload_progress.enabled')))
    exit('session.upload_progress.enabled is not enabled, please activate it in your PHP config file to use this script.');

require_once 'Upload.class.php';
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Area </title>
<link rel="stylesheet" href="./static/css/common.css" />
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
 <div id="container">

  <!-- Debug Mod --> <!-- <form action="upload.php?show_transfer=on" method="post" id="upload_form" enctype="multipart/form-data" target="result_frame"> -->
  <form action="upload.php" method="post" id="upload_form" enctype="multipart/form-data" target="result_frame">
      <fieldset>
          <legend>Upload Images</legend>
          <input type="hidden" name="<?php echo ini_get('session.upload_progress.name');?>" value="<?php Upload::UPLOAD_PROGRESS_PREFIX ?>" />
          <label for="file">Images: 
		  	<input type="file" name="files[]" id="file" multiple="multiple" accept="image/*" required="required"/>
			<br/>
          		<small>
					<em>You can select multiple files at once by clicking multiple files while holding down the "CTRL" key.</em>
				</small>
			</label>
          <button type="submit" id="upload">Upload</button>
          <button type="reset" id="cancel">Cancel</button>

      <!-- Progress bar here -->
      <div id="upload_progress" class="hidden center progress">
          <div class="bar"></div>
      </div>
      </fieldset>
  </form>
  <iframe id="result_frame" name="result_frame" src="about:blank"></iframe>
</div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="./static/js/ProgressBar.class.js"></script>
  <script>
  $('#upload').click(function() {
    (new UploadBar).upload();
  });
  $('#cancel').click(function() {
    (new UploadBar).cancel();
  });
  </script>
</body>
</html>
