<?php 
    require_once 'sidebar.php';
    require_once '../includes/functions.inc.php';
    require_once '../includes/dbh.inc.php';

    if(isset($_POST["submit"])) {
        $subject = $_POST["classSubject"];

        if(empty($subject)) {
            header("location: planner2.php?error=emptyinput");
            exit();
        }

        $rows = findCourses($conn, $subject);
        $coursesList = array();
        if(count($rows) > 0) {
            foreach($rows as $row) {
                $course = new Course($row["coursesId"], $row["coursesAbbr"], $row["coursesCourseNum"],
                            $row["coursesTitle"], $row["coursesDesc"], $row["coursesCreditHrs"]);

                array_push($coursesList, $course);
            }
        }
        else {
            header("location: ../profile/planner2.php?error=nocourses");
            exit();
        }
    }
    else{
        header("location: planner2.php");
        exit();
    }
?>

                <div class="info">
                    
                    <div class="classFormContainer">
                        <form class="classForm" action="planner4.php" method="post">
                            <h1>Choose an available course below:</h1>

                            <label for="classCourse">Course:</label> </br>
                            <select id="classCourse" name="classCourse" size="7">
                                <?php
                                    foreach($coursesList as $course) {
                                        $abbr = $course->getAbbreviation();
                                        $courseNum = $course->getCourseNumber();
                                        $title = $course->getTitle();
                                        $creditHours = $course->getCreditHours();

                                        echo "<option>$abbr $courseNum: $title | Credits: $creditHours</option>";
                                    }
                                ?>
                            </select>

                            <div class="btnSet">
                                <a href="planner.php"><button type="button">Cancel</button></a>
                                <a href="planner2.php"><button type="button">Back</button></a>
                                <button class="nextBtn" type="submit" name="submit">Next</button>
                            </div>
                        </form>
                    </div>

                </div>

<?php
    require_once 'footer.php';
?>