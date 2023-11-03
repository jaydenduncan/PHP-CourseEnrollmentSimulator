<?php 
    require_once 'sidebar.php';
    require_once '../includes/functions.inc.php';
    require_once '../includes/dbh.inc.php';

    if(isset($_POST["submit"])) {
        $courseInput = $_POST["classCourse"];

        if(empty($courseInput)) {
            header("location: planner2.php?error=emptyinput");
            exit();
        }

        $rows = findClasses($conn, $courseInput);
        $classesList = array();
        if(count($rows) > 0) {
            foreach($rows as $row) {
                $courseRow = findCourseById($conn, $row["classesCourseId"]);
                $courseId = $courseRow["coursesId"];
                $courseAbbr = $courseRow["coursesAbbr"];
                $courseNum = $courseRow["coursesCourseNum"];
                $courseTitle = $courseRow["coursesTitle"];
                $courseDesc = $courseRow["coursesDesc"];
                $courseCreditHrs = $courseRow["coursesCreditHrs"];
                $course = new Course($courseId, $courseAbbr, $courseNum, $courseTitle, $courseDesc, 
                            $courseCreditHrs);

                $stuClass = new StudentClass($row["classesId"], $course, $row["classesSection"],
                            $row["classesInstructor"], $row["classesStartTime"], 
                            $row["classesEndTime"], $row["classesActiveDays"], $row["classesType"]);

                array_push($classesList, $stuClass);
            }
        }
        else {
            header("location: planner2.php?error=noclasses");
            exit();
        }
    }
    else{
        header("location: planner3.php");
        exit();
    }
?>

                <div class="info">

                    <?php
                        if(isset($_GET["error"])) {
                            if($_GET["error"] === "classdoesnotexist") {
                                echo "<script>alert('Something went wrong adding the class.');</script>";
                            }
                            elseif($_GET["error"] === "coursedoesnotexist") {
                                echo "<script>alert('Something went wrong adding the course.');</script>";
                            }
                        }
                    ?>
                    
                    <div class="classFormContainer">
                        <form class="classForm" action="../includes/addcourse.inc.php" method="post">
                            <h1>Choose an available class below:</h1>

                            <label for="classTimeSlot">Choose from the available time slots:</label> <br/>
                            <select id="classTimeSlot" name="classTimeSlot" size="3">
                                <?php
                                    $dateTimeImmutable = new DateTimeImmutable();

                                    foreach($classesList as $stuClass) {
                                        $classId = $stuClass->getId();
                                        $classInstr = $stuClass->getInstructor();
                                        $classSection = $stuClass->getSection();
                                        $stTimestamp = $stuClass->getStartTime();
                                        $etTimestamp = $stuClass->getEndTime();
                                        $classDays = $stuClass->getActiveDays();
                                        $classType = $stuClass->getType();

                                        if(!empty($stTimestamp)){
                                            $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('h:i A');
                                        }
                                        else{
                                            $stFormatted = "WWW";
                                        }


                                        if(!empty($etTimestamp)){
                                            $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('h:i A');
                                        }
                                        else{
                                            $etFormatted = "WWW";
                                        }

                                        echo "<option value='$classId'>$classInstr | Section $classSection: $stFormatted - $etFormatted 
                                                | $classDays | $classType</option>";
                                    }
                                ?>
                            </select>

                            <div class="btnSet">
                                <a href="planner.php"><button type="button">Cancel</button></a>
                                <a href="planner3.php"><button type="button">Back</button></a>
                                <button type="submit" class="addBtn" name="submit">Add</button>
                            </div>
                        </form>
                    </div>

                </div> 

<?php
    require_once 'footer.php';
?>