<?php

require 'dbconfig.php';

try {
	$conn = new PDO('mysql:host=localhost;dbname=noelj-websyslab9', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Failed to connect, have you tried 'Install' yet?";
	echo "<br /> DB_ERROR: " . $e->getMessage();
}

if ($conn) {
	// Check current contents
	$offset = $conn->query('select count(*) from `courses`')->fetchColumn(); 
	// Courses
	$CS = array("Computer Science", "Data Structures", "Foundations of Computer Science", "Intro to Algorithms", "Computer Organization");
	$IT = array("Intro to IT", "Intro to HCI", "Web Systems Development", "IT and Society", "Managing IT Resources");
	// Prepared course statement
	$sqlINSERT = $conn->prepare("INSERT INTO `courses` 
															 (`crn`,`prefix`,`number`,`title`,`section`,`year`) 
															 VALUES 
															 ( :crnCS, 'CSCI', :numberCS, :titleCS, 1, 2017),
															 ( :crnIT, 'ITWS', :numberIT, :titleIT, 2, 2016);");
	for ($x = 0; $x < 5; $x++) {
		// CS courses
		$csCRN = 0+$offset+$x;
		$csNUMBER = $csCRN;
		$csTITLE = ($offset == 0 ? $CS[$x] : $CS[$x] . " " . $offset/10);
		// Out of course numbers for CS and IT
		if ($csNUMBER > 9999) {
			die("ERROR: Max number of courses reached.");
		}
		// IT courses
		$itCRN = 5+$offset+$x;
		$itNUMBER = $itCRN;
		$itTITLE = ($offset == 0 ? $IT[$x] : $IT[$x] . " " . $offset/10);
		// Execute prepared statement
		$sqlINSERT->execute(array(':crnCS' => $csCRN, ':numberCS' => $csNUMBER, ':titleCS' => $csTITLE,
															':crnIT' => $itCRN, ':numberIT' => $itNUMBER, ':titleIT' => $itTITLE));
	}
	echo "<div class='status'>Courses added.</div>";
	// Students
	$rcisArr = array("noelj", "noelm", "noels", "salzm", "noelp", "noelr", "salzd", "noelw", "salzb", "salza");
	$firstArr = array("Joseph", "Michael", "Sara", "Michelle", "Philip", "Roland", "Doug", "William", "Brenda", "Albert");
	$lastArr = array("Noel", "Noel", "Noel", "Salz", "Noel", "Noel", "Salz", "Noel", "Salz", "Salz");
	$aliasArr = array("Joe", "Mike", "", "", "Phil", "", "", "Bill", "", "Al");
	$streetArr = array("First Street", "Second Ave", "Third Circle", "Fourth Place", "Fifth Alley", "Sixth Way", "Seventh Pass", "Eighth Lane", "Ninth Boulevard", "Tenth Court");
	$cityArr = array("Troy", "NYC", "Boston", "Cheshire", "Cheshire", "Gabriel", "Tampa", "Malboro", "Monroe", "Lucas");
	$stateArr = array("NY", "NY", "MA", "CT", "CT", "NA", "FL", "MA", "NJ", "NA");
	// Prepared students statement
	$sqlINSERT = $conn->prepare("INSERT INTO `students` 
															 (`rin`, `rcisID`, `first name`, `last name`, `alias`, `phone`, `street`, `city`, `st`, `zip`) 
															 VALUES 
															 (:rin, :rcisID, :first, :last, :alias, :phone, :street, :city, :st, :zip);");
	for ($x = 0; $x < 10; $x++) {
		// Student values
		$rin = 0+$offset+$x;
		$rcisID = ($offset==0 ? $rcisArr[$x] : $rcisArr[$x] . $offset/10);
		$first = ($offset==0 ? $firstArr[$x] : $firstArr[$x] . " " . $offset/10);
		$last = $lastArr[$x];
		$alias = $aliasArr[$x];
		$phone = $rin;
		$street = $x+($offset/10) . " " . $streetArr[$x];
		$city = $cityArr[$x];
		$st = $stateArr[$x];
		$zip = $rin;
		// Limiting factor in my implementation for students
		if (strlen($rcisID)>7) {
			die("ERROR: RCSID too long.");
		}
		
		// Execute prepared statement
		$sqlINSERT->execute(array(':rin' => $rin, ':rcisID' => $rcisID, ':first' => $first, ':last' => $last, ':alias' => $alias,
														  ':phone' => $phone, ':street' => $street, ':city' => $city, ':st' => $st, ':zip' => $zip));
	}
	echo "<div class='status'>Students added.</div>";
	// Grades
	// Make this ahead of time to avoid making it every loop
	$duplicate = $conn->prepare('select * from `grades` WHERE crn=:course AND rin=:student');
	for ($x = 0; $x < 25; $x++) {
		// Generate random pairs of classes and students
		$student = rand($offset,$offset+9);
		$course  = rand($offset,$offset+9);
		// Check to ensure class-student pair wasn't already added
		$check = $duplicate->execute(array(':student' => $student, ':course' => $course));
		if ($duplicate->fetch()) {
			// Pair already existed, try again
			$x--;
			continue;
		}
		// Fresh pair, generate random grade from 0-100
		$grade = rand(0,100);
		// Curve it, the grades were really sad otherwise :'(
		$grade = ($grade+30>100 ? 100 : $grade+30);
		// Prepared grades statement
		$sqlINSERT = $conn->prepare("INSERT INTO `grades` 
															 	 (`crn`,`rin`,`grade`) 
															 	 VALUES 
															 	 (:crn, :rin, :grade);");
		// Execute
		$sqlINSERT->execute(array(':crn' => $course, ':rin' => $student, ':grade' => $grade));
	}
	echo "<div class='status'>Grades added.</div>";
	echo "<div class='done'>Done.</div>";															 
}