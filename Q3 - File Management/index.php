<?php

define("FILE_LOCATION", "student-data.txt");

function get_student_info($student)
{
    $student_info = explode(", ", $student);
    return array("ID" => $student_info[0], "Name" => $student_info[1], "Age" => $student_info[2]);
}

$file_pointer_operation = readline("Enter the type of Operation to perform :\t");
$file_pointer_mode = NULL;

switch ($file_pointer_operation) {
    case "Read":
        $file_pointer_mode = "r";
        break;

    case "Write":
        $file_pointer_mode = "w+";
        break;

    case "Append":
        $file_pointer_mode = "a+";
        break;

    case "Delete":
        if (!unlink(FILE_LOCATION))
            throw new Error("Student File could not be deleted");

        echo FILE_LOCATION . " has been deleted\n";
        exit(0);

    default:
        throw new Error("Invalid File Operation provided");
}

$file_pointer = fopen(FILE_LOCATION, $file_pointer_mode) or die("Could not open Student File");

if ($file_pointer_operation !== "Read") {
    echo "\nCreating a New Student Record\n";

    $student_id = readline("Enter the ID of the Student :\t");
    $student_name = readline("Enter the Name of the Student :\t");
    $student_age = readline("Enter the Age of the Student :\t");

    if (fwrite($file_pointer, $student_id . ", " . $student_name . ", " . $student_age . "\n") === false)
        throw new Error("Could not write new record to the Student File");

    echo "\nAdded New Student record to the File\n";
}

rewind($file_pointer);
echo "Current Content of the Student File\n";


define("TABLE_MASK", "||%5.5s |%30.30s |%5.5s ||\n");

while (!feof($file_pointer)) {
    $line = trim(fgets($file_pointer));
    if ($line !== "") {
        $student = get_student_info($line);
        printf(TABLE_MASK, $student["ID"], $student["Name"], $student["Age"]);
    }
}

echo "Closing the Student File\n";
if (!fclose($file_pointer))
    throw new Error("Could not close Student File");

echo "Student File has been closed\n";
exit(0);
