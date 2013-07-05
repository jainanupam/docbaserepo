<?php
include('authenticate.php');
// Check for errors
if($_FILES['file_upload']['error'] > 0){
    die('An error ocurred when uploading. '.$_FILES['file_upload']['error']);
}

if(!getimagesize($_FILES['file_upload']['tmp_name'])){
    die('Please ensure you are uploading an image.');
}

// Check filetype
if($_FILES['file_upload']['type'] != 'image/jpeg'){
    die('Unsupported filetype uploaded.');
}

// Check filesize
if($_FILES['file_upload']['size'] > 3000000){
    die('File uploaded exceeds maximum upload size.');
}

// Check if the file exists
if(file_exists('../../upload/' . $_FILES['file_upload']['name'])){
    die('File with that name already exists.');
}

// Upload file
if(!move_uploaded_file($_FILES['file_upload']['tmp_name'], '../../upload/' . $_FILES['file_upload']['name'])){
    die('Error uploading file - check destination is writeable.');
}

//die('File uploaded successfully.');
?>
File Uploaded successfully.<br/>
<a href="home.php">Go Back</a>