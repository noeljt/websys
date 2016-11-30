<?php

require 'dbconfig.php';

try {
	$conn = new PDO('mysql:host=localhost;dbname=noelj-websyslab9', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected to database... ";
	$conn->exec("DROP DATABASE `noelj-websyslab9`;");
	echo "database dropped.";

} catch (PDOException $e) {
	echo "Database not found, nothing to reset.";
}