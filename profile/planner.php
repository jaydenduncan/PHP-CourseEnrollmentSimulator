<?php 
    require_once 'sidebar.php';
?>

                <div class="info">

                    <?php
                        // Handle successes
                        if(isset($_GET["success"])) {
                            if($_GET["success"] === "removedclassfromcart") {
                                echo "<script>alert('Class successfully removed!');</script>";
                            }
                        }

                        // Handle errors
                        if(isset($_GET["error"])) {
                            if($_GET["error"] === "stmtfailed") {
                                echo "<script>alert('Something went wrong searching for courses.');</script>";
                            }
                            elseif($_GET["error"] === "cartfailedtoload") {
                                echo "<script>alert('Failed to retrieve classes saved to cart.');</script>";
                            }
                            elseif($_GET["error"] === "failedtoremoveclass") {
                                echo "<script>alert('Failed to remove the class from the cart.');</script>";
                            }
                            elseif($_GET["error"] === "nosubjects") {
                                echo "<script>alert('No courses are available at this time.');</script>";
                            }
                            elseif($_GET["error"] === "none") {
                                echo "<script>alert('Class successfully added!');</script>";
                            }
                        }
                    ?>
                    
                    <div id="addCourseLinkDiv">
                        <a id="addCourseLink" href="planner2.php">
                            <p>Add Course</p>
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>

                    <div id="cartContainer">
                        <div id="coursesCart">
                            <div class="cartHeading">
                                <p class="cartTitle">Course Cart</p>
                                <div class="status">
                                    <?php
                                        if(!$registered){
                                            echo "<p class='statusText'>Status: Not Registered</p>";
                                        }
                                        else{
                                            echo "<p class='statusText'>Status: Registered</p>";
                                        }
                                    ?>
                                    <a href="#"><i class="far fa-question-circle"></i></a>
                                </div>
                            </div>

                            <hr/>

                            <div class="classesHeader">
                                <h5 class="courseHeader">Course</h5>
                                <h5 class="sectionHeader">Section</h5>
                                <h5 class="instrHeader">Instructor</h5>
                                <h5 class="stHeader">From</h5>
                                <h5 class="etHeader">To</h5>
                                <h5 class="daysHeader">Days</h5>
                                <h5 class="creditsHeader">Credits</h5>
                            </div>

                            <div id="stuClasses">
                                <?php
                                    // Show default message if the student has no classes in cart
                                    if(empty($student->getClasses())) {
                                        echo 
                                        "<div class='defaultClassDiv'>
                                            <p>No classes in shopping cart. Click 'Add Course' to add a course.</p>
                                        </div>";
                                    }
                                    // Else, display list of all classes w/class information
                                    else {
                                        $classes = $student->getClasses();
                                        
                                        foreach($classes as $stuClass) {
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $courseCreditHrs = $course->getCreditHours();

                                            $classId = $stuClass->getId();
                                            $classSection = $stuClass->getSection();
                                            $classInstr = $stuClass->getInstructor();
                                            $stTimestamp = $stuClass->getStartTime();
                                            $etTimestamp = $stuClass->getEndTime();
                                            $classDays = $stuClass->getActiveDays();

                                            $dateTimeImmutable = new DateTimeImmutable();

                                            if(!empty($stTimestamp)) {
                                                $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('h:i A');
                                            }
                                            else {
                                                $stFormatted = "WWW";
                                            }

                                            if(!empty($etTimestamp)) {
                                                $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('h:i A');
                                            }
                                            else {
                                                $etFormatted = "WWW";
                                            }

                                            echo 
                                            "<div class='stuClass'>
                                                <p class='classCourse'>$courseAbbr $courseNum</p>
                                                <p class='classSection'>$classSection</p>
                                                <p class='classInstr'>$classInstr</p>
                                                <p class='classST'>$stFormatted</p>
                                                <p class='classET'>$etFormatted</p>
                                                <p class='classDays'>$classDays</p>
                                                <p class='classCredits'>$courseCreditHrs</p>
                                                <div class='stuClassTools'>
                                                    <a href='../includes/getClassInfo.inc.php?info=true&classid=$classId'><p class='infoBtn'><i class='fas fa-info'></i></p></a>
                                                    <a href='../includes/editClass.inc.php?edit=true&classid=$classId'><p class='editBtn'><i class='fas fa-solid fa-pen'></i></p></a>
                                                    <a href='../includes/deleteClass.inc.php?delete=true&classid=$classId'><p class='deleteBtn'><i class='fas fa-solid fa-trash'></i></p></a>
                                                </div>
                                            </div>";
                                        }

                                    }

                                ?>
                            </div>
                        </div>    
                    </div>

                    <div id="registerBtnArea">
                        <div id="registerBtnContainer">
                            <a href="register.inc.php"><button id="registerBtn">Register</button></a>
                        </div>
                    </div>

                </div> 

<?php
    require_once 'footer.php';
?>