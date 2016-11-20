<!doctype html>
<html>
  <head>
    <title>Lab 9</title>
    <link rel="stylesheet" href="lab9.css"/>
  </head>
<body>
	<div id="wrapper">
		<div class="header">
			<h1>Choose Your Button!</h1>
		</div>
		<form method="post" action="index.php">
			<input type="submit" name="install" value="Install" />
			<input type="submit" name="load" value="Load" />
			<input type="submit" name="students" value="Students" />
			<input type="submit" name="grade_distribution" value="Grade Distribution" />
		</form>
		<div class="header">
			<h1>The Results Of Your Actions:</h1>
		</div>
		<div id="results">
			<?php
				if (isset($_POST['install']) && $_POST['install'] == 'Install') {
				  require 'install.php';
				}
				if (isset($_POST['load']) && $_POST['load'] == 'Load') {
					require 'insert.php';
				}
				if ((isset($_POST['students'])					 && $_POST['students']           == 'Students') ||
						(isset($_POST['grade_distribution']) && $_POST['grade_distribution'] == 'Grade Distribution')) {
					require 'output.php';
				}
			?>
		</div>
	</div>
</body>
</html>