<?php
$students = 10;
$studentDetails = array();

// Collecting the details about the students
for ($i = 1; $i <= $students; $i++) {
    echo "Enter the Student Name: ";
    $studentName = readline();

    echo "Enter the Registration Number: ";
    $studentRegi = readline();

    echo "Enter the Marks Attained: ";
    $studentMarks = readline();

    $studentDetails[] = array(
        'name' => $studentName,
        'reg' => $studentRegi,
        'marks' => $studentMarks
    );
}

// Print out all student details
echo "\nDetails of all 10 students:\n";

foreach ($studentDetails as $index => $student) {
    echo "Student " . ($index + 1) . ":\n";
    echo "Name: " . $student['name'] . "\n";
    echo "Registration Number: " . $student['reg'] . "\n";
    echo "Marks Attained: " . $student['marks'] . "\n\n";
}
?>