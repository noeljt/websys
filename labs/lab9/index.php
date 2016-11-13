<?php

if (isset($_POST['install']) && $_POST['install'] == 'Install') {
  require 'install.php';
}

?>

<form method="post" action="index.php">
<input type="submit" name="install" value="Install" />
<input type="submit" name="load" value="Load" />
<input type="submit" name="students" value="Students" />
<input type="submit" name="grade_distribution" value="Grade Distribution" />
</form>