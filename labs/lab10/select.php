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
	// This monstrocity of a query
	$sql = '
	SELECT r1."first name", r1."last name", r1."title"
	FROM (SELECT s."first name", s."last name", c."title", COUNT(*) AS ClassCount
		    FROM students AS s
		    JOIN grades AS g
		    ON g."rin"=s."rin"
		    JOIN courses AS c
		    ON g."crn"=c."crn"
		    WHERE g."grade">=90
		    GROUP BY s."first name", s."last name", c."title"
		 ) AS r1
	JOIN (SELECT r."first name", r."last name", MAX(r.ClassCount) AS MaxClassCount
	     FROM (SELECT s."first name", s."last name", c."title", COUNT(*) AS ClassCount
	            FROM students AS s
	            JOIN grades AS g
	            ON g."rin"=s."rin"
	            JOIN courses AS c
	            ON g."crn"=c."crn"
	            WHERE g."grade">=90
	            GROUP BY s."first name", s."last name", c."title"
	          ) AS r
	     GROUP BY r."first name", r."last name"
	   ) AS r2
	ON r1."first name" = r2."first name" AND r1."last name" = r2."last name" AND r1.ClassCount = r2.MaxClassCount
	GROUP BY r1."first name", r1."last name", r1."title";';
	echo "<table><tr><th>First Name</th><th>Last Name</th><th>Class</th></tr>";
	// previous is a tie-breaker, use only first result with same name
	$previous = "";
	foreach($conn->query($sql) as $row) {
		if ($previous=="{$row['first name']} {$row['last name']}") {
			continue;
		}
		echo "<tr><td>{$row['first name']}</td><td>{$row['last name']}</td><td>{$row['title']}</td></tr>";
		$previous="{$row['first name']} {$row['last name']}";
	}
	echo "</table>";
}

?>