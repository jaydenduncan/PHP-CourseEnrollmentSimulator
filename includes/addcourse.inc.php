<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

if(isset($_POST["submit"])) {

    $classIdInput = intval($_POST["classTimeSlot"]);
    
    $classRow = findClassById($conn, $classIdInput);

    if($classRow === false) {
        header("location: ../profile/planner4.php?error=classdoesnotexist");
        exit();
    }

    $classId = $classRow["classesId"];
    $courseId = $classRow["classesCourseId"];
    
    $courseRow = findCourseById($conn, $courseId);

    if($courseRow === false) {
        header("location: ../profile/planner4.php?error=coursedoesnotexist");
        exit();
    }

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

    $stuClass = new StudentClass($classId, $course, $classSection, $classInstr, $classSt, $classEt, $classDays, $classType);
    $_SESSION["studentProfile"]->addClass($stuClass);

    header("location: ../profile/planner.php?error=none");
}
else{
    header("location: ../profile/planner4.php");
    exit();
}