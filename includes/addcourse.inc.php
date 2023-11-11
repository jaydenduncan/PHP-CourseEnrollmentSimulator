<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

if(isset($_POST["submit"])) {
    $studentid = $_SESSION["studentProfile"]->getId();
    $classIdInput = intval($_POST["classTimeSlot"]); // Class id sent from previous form

    // Determine if the class the user is trying to add is a duplicate
    $stuClassesRows = getClassesFromCart($conn, $studentid);

    if(count($stuClassesRows) > 0){
        foreach($stuClassesRows as $row){
            if($row["classesId"] === $classIdInput){
                header("location: ../profile/planner2.php?error=classalreadyincart");
                exit();
            }
        }
    }
    
    // Use class id the find class in database
    $classRow = findClassById($conn, $classIdInput);

    if($classRow === false) {
        header("location: ../profile/planner4.php?error=classdoesnotexist");
        exit();
    }


    $classId = $classRow["classesId"];
    $courseId = $classRow["classesCourseId"]; // Gets course id from class record
    
    // Use course id to find course in database
    $courseRow = findCourseById($conn, $courseId);

    if($courseRow === false) {
        header("location: ../profile/planner4.php?error=coursedoesnotexist");
        exit();
    }

    // Use course info to create an instance of the course
    $courseAbbr = $courseRow["coursesAbbr"];
    $courseNum = $courseRow["coursesCourseNum"];
    $courseTitle = $courseRow["coursesTitle"];
    $courseDesc = $courseRow["coursesDesc"];
    $courseCreditHrs = $courseRow["coursesCreditHrs"];
    $course = new Course($courseId, $courseAbbr, $courseNum, $courseTitle, $courseDesc, $courseCreditHrs);

    $classSection = $classRow["classesSection"];
    $classInstr = $classRow["classesInstructor"];
    $classSt = $classRow["classesStartTime"];
    $classEt = $classRow["classesEndTime"];
    $classDays = $classRow["classesActiveDays"];
    $classType = $classRow["classesType"];

    // Create a student class instance and add the class to the student's list of classes
    $stuClass = new StudentClass($classId, $course, $classSection, $classInstr, $classSt, $classEt, $classDays, $classType);
    $_SESSION["studentProfile"]->addClass($stuClass);

    // Link the student to the right class in the database
    addClassToCart($conn, $studentid, $classId);

    header("location: ../profile/planner.php?error=none");
}
else{
    header("location: ../profile/planner4.php");
    exit();
}