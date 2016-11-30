<!doctype html>
<html>
  <head>
    <title>Lab 10</title>
    <link rel="stylesheet" href="lab10.css"/>
  </head>
<body>
	<div id="wrapper">
		<div class="header">
			<h1>Choose Your Button!</h1>
		</div>
		<form method="post" action="index.php">
			<input type="submit" name="install" value="Install" />
			<input type="submit" name="migrate" value="Migrate" />
			<input type="submit" name="select" value="Select" />
			<input type="submit" name="reset" value="Reset" />
		</form>
		<div class="header">
			<h1>The Results Of Your Actions:</h1>
		</div>
		<div id="results">
			<?php
				if (isset($_POST['install']) && $_POST['install'] == 'Install') {
				  require 'install.php';
				}
				if (isset($_POST['migrate']) && $_POST['migrate'] == 'Migrate') {
					require 'migrate.php';
				}
				if (isset($_POST['select']) && $_POST['select'] == 'Select') {
					require 'select.php';
				}
				if (isset($_POST['reset']) && $_POST['reset'] == 'Reset') {
					require 'reset.php';
				}
			?>
		</div>
	</div>
</body>
</html>