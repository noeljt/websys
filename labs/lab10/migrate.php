<?php

require 'config.php';

try {
	$connMS = new PDO("mysql:host={$config['DB_HOST']};dbname={$config['DB_9']}", $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$connMS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<div class='status'>MySQL Database Connected.</div>";
} catch (PDOException $e) {
	echo "ERROR: " . $e->getMessage();
}

try {
	$connPG = new PDO("pgsql:dbname={$config['DB_10']};host={$config['DB_HOST']}", $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$connPG->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<div class='status'>PostgreSQL Database Connected.</div>";
} catch (PDOException $e) {
	echo "ERROR: " . $e->getMessage();
}

if ($connMS && $connPG) {
	//  empty if possible
	$sql = "DELETE FROM public.grades;
					DELETE FROM public.courses;
					DELETE FROM public.students;";
	try {
		$connPG->exec($sql);
		echo "<div class='status'>PGSQL Tables Emptied.</div>";
	} catch (PDOException $e) {
		die($e->getMessage());
	}
	//  courses
	$stmt = $connPG->prepare('
		INSERT INTO courses(crn, prefix, "number", title, section, year) 
		VALUES (:crn, :prefix, :number, :title, :section, :year);
	');
	$sql = "SELECT * FROM courses";
	foreach($connMS->query($sql) as $row) {
		$stmt->execute(array(':crn' 		=> $row['crn'],
												 ':prefix'  => $row['prefix'],
												 ':number'  => $row['number'],
												 ':title' 	=> $row['title'],
												 ':section' => $row['section'],
												 ':year' 	 	=> $row['year']));
	}
	echo "<div class='done'>Courses Migrated.</div>";
	//  students
	$stmt = $connPG->prepare('
		INSERT INTO students(rin, rcisID, "first name", "last name", alias, phone, street, city, st, zip) 
		VALUES (:rin, :rcisID, :firstname, :lastname, :alias, :phone, :street, :city, :st, :zip);
	');
	$sql = "SELECT * FROM students";
	foreach($connMS->query($sql) as $row) {
		$stmt->execute(array(':rin' 			=> $row['rin'],
												 ':rcisID'  	=> $row['rcisID'],
												 ':firstname' => $row['first name'],
												 ':lastname' 	=> $row['last name'],
												 ':alias' 		=> $row['alias'],
												 ':phone' 	 	=> $row['phone'],
												 ':street' 		=> $row['street'],
												 ':city' 			=> $row['city'],
												 ':st' 				=> $row['st'],
												 ':zip' 			=> $row['zip']));
	}
	echo "<div class='done'>Students Migrated.</div>";
	//  grades
	$stmt = $connPG->prepare('
		INSERT INTO grades(crn, rin, grade) 
		VALUES (:crn, :rin, :grade);
	');
	$sql = "SELECT * FROM grades";
	foreach($connMS->query($sql) as $row) {
		$stmt->execute(array(':crn' 			=> $row['crn'],
												 ':rin'  	=> $row['rin'],
												 ':grade' => $row['grade']));
	}
	echo "<div class='done'>Grades Migrated.</div>";
} else {
	echo "ERROR: Cannot migrate without connection to both databases.";
}