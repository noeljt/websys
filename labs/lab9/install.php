<?php

require 'dbconfig.php';

try {
	$conn = new PDO('mysql:host=localhost;dbname=noelj-websyslab9', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<div class='status'>Database already exists...</div>";
} catch (PDOException $e) {
	echo "<div class='status'>Database not found, installing...</div>";
	try {
		$newdb = new PDO("mysql:host=localhost", $config['DB_USERNAME'], $config['DB_PASSWORD']);
		$newdb->exec($sql1);
		// or die(print_r($newdb->errorInfo(), true));
		$newdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e2) {
		echo "<div class='error'>DB ERROR: " . $e2->getMessage() . "</div>";
	}
}

echo "<div class='done'>Done.</done>";