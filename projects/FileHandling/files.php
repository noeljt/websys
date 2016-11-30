<?php
if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
  // Delete the file if it exists
  if (file_exists("log.txt")) {
  	unlink("log.txt");
  }
}
else if (isset($_POST['append']) && $_POST['append'] == 'Append') {
  // Append to the file. It will be created if it doesn't exist already.
	$fp = fopen("log.txt", 'a');
	fwrite($fp, $_POST['txt'] . "\n");
	fclose($fp);
}
?>
<!doctype html>
<html>
<head>
  <title>Lecture #19 Example - Files</title>
</head>
<body>
<form action="files.php" method="post">
<input name="txt" type="text"/>
<input name="append" type="submit" value="Append"/>
<input name="delete" type="submit" value="Delete"/>
</form>
<?php 
if (file_exists('log.txt')) {
  // Escape HTML entities, then convert newlines to <br> tags
  echo nl2br(htmlentities(file_get_contents('log.txt')));
}
?>
</body>
</html>
