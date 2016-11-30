<?php

require 'dbconfig.php';

try {
	$conn = new PDO('mysql:host=localhost;dbname=noelj-websyslab9', $config['DB_USERNAME'], $config['DB_PASSWORD']);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "DB_ERROR: " . $e->getMessage();
}

if ($conn) {
	// Students list
	if (isset($_POST['students']) && $_POST['students'] == 'Students') {
		// Queery ordered by last then first name
		$sql = "SELECT `last name`, `first name`
						FROM `students`
						ORDER BY `last name` ASC, `first name` ASC;";
		// Loop through results and print 
		foreach($conn->query($sql) as $row) {
			echo "<div class='status'>" . $row['last name'] . ", " . $row['first name'] . "</div>";
		}
		echo "<div class='done'>Done.</div>";
	}
	// Grade distribution option
	else {
		// Prepared statement (NOTE: not a unique count)
		$stmt = $conn->prepare("SELECT COUNT(`rin`)
													 FROM `grades`
													 WHERE `grade` >= :min AND `grade` <= :max;");
		// Execute with each grade range
		$stmt->execute(array(':min' => 90, ':max' => 100));
		echo "<div class='status'>90-100: " . $stmt->fetch()[0] . "</div>";
		$stmt->execute(array(':min' => 80, ':max' => 89));
		echo "<div class='status'>80-89: " . $stmt->fetch()[0] . "</div>";
		$stmt->execute(array(':min' => 70, ':max' => 79));
		echo "<div class='status'>70-79: " . $stmt->fetch()[0] . "</div>";
		$stmt->execute(array(':min' => 65, ':max' => 69));
		echo "<div class='status'>65-69: " . $stmt->fetch()[0] . "</div>";
		$stmt->execute(array(':min' => 0, ':max' => 64));
		echo "<div class='status'>&lt; 65: " . $stmt->fetch()[0] . "</div>";
		echo "<div class='done'>Done.</div>";
	}
}