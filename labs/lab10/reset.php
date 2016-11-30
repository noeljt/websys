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
	echo "<div class='error'>ERROR: " . $e->getMessage() . "</div>";
}

if ($conn) {
	$sql = "DROP TABLE public.grades;
			DROP TABLE public.courses;
			DROP TABLE public.students;";
	try {
		$conn->exec($sql);
		echo "<div class='done'>PGSQL Database Reset.</div>";
	} catch (PDOException $e) {
		echo "<div class='error'>PGSQL Database Already Empty.</div>";
	}
}

?>