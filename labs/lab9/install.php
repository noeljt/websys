<?php

require 'dbconfig.php';

$config = array(
   'DB_HOST'     => 'localhost',
   'DB_USERNAME' => 'root',
   'DB_PASSWORD' => '',
);

try {
	$conn = new PDO('mysql:host=localhost;dbname=noelj-websyslab9', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "\nDatabase not found, installing...";
	try {
		$newdb = new PDO("mysql:host=localhost", $config['DB_USERNAME'], $config['DB_PASSWORD']);
		$newdb->exec($sql1);
		// or die(print_r($newdb->errorInfo(), true));
		$newdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e2) {
		die("\nDB ERROR: " . $e2->getMessage());
	}
}

echo " Done.";