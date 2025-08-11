<?php
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

$currCartClasses = $_SESSION["studentProfile"]->getClasses();

// Determine if the user has too few credits in their cart
if(count($currCartClasses) > 0){
    $totalHrs = 0;
    foreach($currCartClasses as $cartClass){
        $totalHrs += $cartClass->getCourse()->getCreditHours();
    }
    if($totalHrs < 12){
        header("location: ../profile/planner.php?error=notenoughhours");
        exit();
    }
}
else{
    header("location: ../profile/planner.php?error=noclassesincart");
    exit();
}

// Register classes
header("location: ../profile/planner.php?success=registeringclasses");
exit();