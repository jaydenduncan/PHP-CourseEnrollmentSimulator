<?php 
    require_once 'sidebar.php';
    require_once '../includes/functions.inc.php';
    require_once '../includes/dbh.inc.php';

    $rows = findSubjects($conn);

    $subjectsList = array();
    if(count($rows) > 0) {
        foreach($rows as $row) {
            array_push($subjectsList, $row["coursesAbbr"]);
        }
    }
    else {
        header("location: ../profile/planner.php?error=nosubjects");
        exit();
    }
?>

                <div class="info">

                    <?php
                        if(isset($_GET["error"])) {
                            if($_GET["error"] === "stmtfailed") {
                                echo "<script>alert('Something went wrong.');</script>";
                            }
                            elseif($_GET["error"] === "emptyinput") {
                                echo "<script>alert('The input you entered was empty. Please try adding the course again.');</script>";
                            }
                            elseif($_GET["error"] === "nocourses") {
                                echo "<script>alert('No courses in that subject are available at this time.');</script>";
                            }
                            elseif($_GET["error"] === "coursedoesnotexist") {
                                echo "<script>alert('This course is not available at this time. Try adding another course.');</script>";
                            }
                            elseif($_GET["error"] === "noclasses") {
                                echo "<script>alert('No classes in that course are available at this time.');</script>";
                            }
                        }
                    ?>
                    
                    <div class="classFormContainer">
                        <form class="classForm" action="planner3.php" method="post">
                            <h1>Choose an available subject below:</h1>

                            <label for="classSubject">Subject:</label>
                            <select id="classSubject" name="classSubject" size="3">
                                <?php
                                    foreach($subjectsList as $subject) {
                                        echo "<option>$subject</option>";
                                    }
                                ?>
                            </select>

                            <div class="btnSet">
                                <a href="planner.php"><button type="button">Cancel</button></a>
                                <button class="nextBtn" type="submit" name="submit">Next</button>
                            </div>
                        </form>
                    </div>

                </div> 

<?php
    require_once 'footer.php';
?>