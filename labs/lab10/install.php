<?php

// Contains databse info and tables SQL structure
require "config.php";

try {
	// Connect
	$conn = new PDO("pgsql:dbname={$config['DB_10']};host={$config['DB_HOST']}", $config['DB_USERNAME'], $config['DB_PASSWORD']);
	// Set attributes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// Print success
	echo "<div class='status'>Connected</div>";
} catch (PDOException $e) {
	// Failure - print error
	echo "ERROR: " . $e->getMessage();
}

if ($conn) {
	// Add table structure
	try {
		$result = $conn->exec($tables);
		echo "<div class='done'>Installed.</div>";
	} catch (PDOException $e) {
		// Failed to add tables
		echo "ERROR: " . $e->getMessage();
	}
}

?>