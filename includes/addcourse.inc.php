<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

function timestampToFormat($ts){
    $dateTimeImmutable = new DateTimeImmutable();

    $timeFormatted = $dateTimeImmutable->setTimestamp($ts)->format('h:i A');
    return $timeFormatted;
}

function formatToTimestamp($format){
    $ts = strtotime("today $format");
    return $ts;
}

function hasInterference($nextST, $nextET, $currST, $currET){
    // See if start time of new class falls between the start and end time of another class in the cart
    if(($nextST >= $currST) && ($nextST <= $currET)){
        return true;
    }
    else if(($nextET >= $currST) && ($nextET <= $currET)){
        return true;
    }

    return false;
}

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

    // Determine if the class the user is trying to add interferes with any other class in the cart
    $nextCartClass = findClassById($conn, $classIdInput);
    $currCartClasses = $_SESSION["studentProfile"]->getClasses();

    $nextCartClassType = $nextCartClass['classesType'];
    $nextCartClassActiveDays = $nextCartClass['classesActiveDays'];
    $nextCartClassST = $nextCartClass['classesStartTime'];
    $nextCartClassET = $nextCartClass['classesEndTime'];

    $nextCartClassST = formatToTimestamp(timestampToFormat($nextCartClassST));
    $nextCartClassET = formatToTimestamp(timestampToFormat($nextCartClassET));

    if(count($currCartClasses) > 0){
        foreach($currCartClasses as $cartClass){
            $currCartClassType = $cartClass->getType();
            $currCartClassActiveDays = $cartClass->getActiveDays();
            $currCartClassST = formatToTimestamp(timestampToFormat($cartClass->getStartTime()));
            $currCartClassET = formatToTimestamp(timestampToFormat($cartClass->getEndTime()));

            if($nextCartClassType !== "ONL"){
                if($nextCartClassActiveDays === $currCartClassActiveDays){
                    if(hasInterference($nextCartClassST, $nextCartClassET, $currCartClassST, $currCartClassET) || 
                       hasInterference($currCartClassST, $currCartClassET, $nextCartClassST, $nextCartClassET)){
                        header("location: ../profile/planner2.php?error=classinterference");
                        exit();
                    }
                }
            }
        }
    }

    // Determine if the user already has enough credit hours in cart 
    if(count($currCartClasses) > 0){
        $totalHrs = 0;
        foreach($currCartClasses as $cartClass){
            $totalHrs += $cartClass->getCourse()->getCreditHours();
        }
        if($totalHrs >= 15){
            header("location: ../profile/planner.php?error=toomanyhours");
            exit();
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

    // Determine if the user is adding a duplicate course
    if(count($currCartClasses) > 0){
        foreach($currCartClasses as $cartClass){
            $currCartClassCourseId = $cartClass->getCourse()->getId();
            if($currCartClassCourseId === $courseId){
                header("location: ../profile/planner2.php?error=coursealreadyincart");
                exit();
            }
        }
    }
    
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