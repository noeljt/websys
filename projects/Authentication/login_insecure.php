<?php
session_start();

// Connect to the database
try {
  $dbname = 'lecture18';
  $user = 'root';
  $pass = '';
  $dbconn = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
}
catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

if (isset($_POST['login']) && $_POST['login'] == 'Login') {
// Check login
// setup a prepared statement to read the username from the database and 
//   compare it to the one entered on the form ($_POST)
	$login_stmt = $dbconn->prepare('SELECT username, uid 
																	FROM users 
																	WHERE username=:username AND password=:password');
	$login_stmt->execute(array(':username' => $_POST['username'], ':password' => $_POST['pass']));

	// if you got a match - lets set up the session

	if ($user = $login_stmt->fetch()) {
		$_SESSION['username'] = $user['username'];
		$_SESSION['uid'] = $user['uid'];
	} else {
		$err = 'Incorrect username or password.';
	}
}

// Logout
if (isset($_SESSION['username']) && isset($_POST['logout']) && $_POST['logout'] == 'Logout') {
  // put your code to end the session here

	unset($_SESSION['username']);
	unset($_SESSION['uid']);
	setcookie(session_name(), '', time() - 72000);
	session_destroy();
  $err = 'You have been logged out.';
}


?>
<!doctype html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <?php if (isset($_SESSION['username'])): ?>
  <h1>Welcome, <?php echo htmlentities($_SESSION['username']) ?>.</h1>
  <form method="post" action="login_insecure.php">
    <input name="logout" type="submit" value="Logout" />
  </form>
  <?php else: ?>
  <h1>Login</h1>
  <?php if (isset($err)) echo "<p>$err</p>" ?>
  <form method="post" action="login_insecure.php">
    <label for="username">Username: </label><input type="text" name="username" />
    <label for="pass">Password: </label><input type="password" name="pass" />
    <input name="login" type="submit" value="Login" />
  </form>
  <?php endif; ?>
</body>
</html>
