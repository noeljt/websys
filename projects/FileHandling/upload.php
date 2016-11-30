<?php
if (isset($_POST['upload']) && $_POST['upload'] == 'Upload') {
  // Get the temporary filename and path
  $tmp = $_FILES['file_up']['tmp_name'];
  $filename = basename($_FILES['file_up']['name']);
  // Check to make sure it's an image/grab metadata
  if ($img = getimagesize($tmp)) {
  	// Try to move it
  	if (!move_uploaded_file($tmp, $filename)) {
  		// If it fails throw an exception
  		throw Exception('Unable to sasve file.');
  	}
  }
  // Make sure the file was found/exists
  if (isset($filename) && file_exists($filename)) {
  	// Set header
  	header('Content-type: ' . $img['mime']);
  	// Read and echo file
  	readfile($filename);
  	// Done here
  	exit();
  }
} else {
?>
<!doctype html>
<html>
<head>
  <title>Lecture #19 Example - Uploads</title>
</head>
<body>
<form enctype="multipart/form-data" action="upload.php" method="post">
<input name="file_up" type="file"/>
<input name="upload" type="submit" value="Upload"/>
</form>

</body>
</html>
<?php } ?>
