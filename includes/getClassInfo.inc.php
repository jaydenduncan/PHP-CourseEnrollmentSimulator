<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

if(isset($_GET["info"])){
    $id = intval($_GET["classid"]);

    $stuClassRow = findClassById($conn, $id);
    $courseRow = findCourseById($conn, $stuClassRow["classesCourseId"]);

    $courseId = $courseRow["coursesId"];
    $courseAbbr = $courseRow["coursesAbbr"];
    $courseNum = $courseRow["coursesCourseNum"];
    $courseTitle = $courseRow["coursesTitle"];
    $courseDesc = $courseRow["coursesDesc"];
    $courseCreditHrs = $courseRow["coursesCreditHrs"];
    $course = new Course($courseId, $courseAbbr, $courseNum, $courseTitle, $courseDesc, 
                $courseCreditHrs);
    $stuClass = new StudentClass($stuClassRow["classesId"], $course, $stuClassRow["classesSection"],
                            $stuClassRow["classesInstructor"], $stuClassRow["classesStartTime"], 
                            $stuClassRow["classesEndTime"], $stuClassRow["classesActiveDays"], $stuClassRow["classesType"]);
}
else{
    header("location: ../profile/planner.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title> Class Info Page </title>
        <link rel="stylesheet" type="text/css" href="../css/getClassInfo.css">
    </head>
    <body>
        <div class="classInfoDiv">
            <h4 class="courseNum"><?php echo $stuClass->getCourse()->getAbbreviation() . " " . $stuClass->getCourse()->getCourseNumber()?></h4>
            <p class="courseTitle"><b>Title:</b> <?php echo $stuClass->getCourse()->getTitle()?></p>
            <p class="classSection"><b>Section:</b> <?php echo $stuClass->getSection()?></p>
            <p class="courseCredits"><b>Credit Hours:</b> <?php echo $stuClass->getCourse()->getCreditHours()?></p>
            <p class="classInstr"><b>Instructor:</b> <?php echo $stuClass->getInstructor()?></p>
            <p class="classActiveDays"><b>Days:</b> <?php echo $stuClass->getActiveDays()?></p>
            <p class="classTime">
                <b>Time:</b>
                <?php 
                    $dateTimeImmutable = new DateTimeImmutable();

                    if(!($stuClass->getType()==="ONL")) {
                        $stFormatted = $dateTimeImmutable->setTimestamp($stuClass->getStartTime())->format('h:i A');
                        $etFormatted = $dateTimeImmutable->setTimestamp($stuClass->getEndTime())->format('h:i A');

                        echo $stFormatted . " - " . $etFormatted;
                    }
                    else{
                        echo "N/A";
                    }
                ?>
            </p>
            <p class="classType"><b>Type:</b> <?php echo $stuClass->getType()?></p>
            <p class="courseDesc"><b>Description:</b> <?php echo ($stuClass->getCourse()->getDescription()) ? $stuClass->getCourse()->getDescription() : "N/A"; ?></p>
            <a href="../profile/planner.php"><button class="backBtn">Back</button></a>
        </div>   
    </body>
</html>