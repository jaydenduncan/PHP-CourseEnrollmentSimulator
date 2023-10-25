<?php 
    require_once 'sidebar.php'
?>

                <div class="info">

                    <?php
                        if(isset($_GET["error"])) {
                            if($_GET["error"] === "stmtfailed") {
                                echo "<script>alert('Something went wrong searching for courses.');</script>";
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
                                <p class="cartTitle">Chosen Courses</p>
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

                                    if(empty($student->getClasses())) {
                                        echo 
                                        "<div class='defaultClassDiv'>
                                            <p>No classes in shopping cart. Click 'Add Course' to add a course.</p>
                                        </div>";
                                    }
                                    else {
                                        $classes = $student->getClasses();
                                        
                                        foreach($classes as $stuClass) {
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $courseCreditHrs = $course->getCreditHours();

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
                                            </div>";
                                        }

                                    }

                                ?>
                                <!--
                                <div id="stuClass1" class="stuClass">
                                    <p class="classCourse">CS 101</p>
                                    <p class="classSection">001</p>
                                    <p class="classInstr">Oswald Burrows</p>
                                    <p class="classST">10:00 AM</p>
                                    <p class="classET">11:00 AM</p>
                                    <p class="classDays">MWF</p>
                                    <p class="classCredits">3.0</p>
                                </div>
                                <div id="stuClass2" class="stuClass">
                                    <p class="classCourse">MS 101</p>
                                    <p class="classSection">001</p>
                                    <p class="classInstr">Oswald Burrows</p>
                                    <p class="classST">12:15 PM</p>
                                    <p class="classET">1:45 PM</p>
                                    <p class="classDays">TR</p>
                                    <p class="classCredits">3.0</p>
                                </div>
                                <div id="stuClass3" class="stuClass">
                                    <p class="classCourse">EH 101</p>
                                    <p class="classSection">001</p>
                                    <p class="classInstr">Oswald Burrows</p>
                                    <p class="classST">12:30 PM</p>
                                    <p class="classET">1:30 PM</p>
                                    <p class="classDays">MWF</p>
                                    <p class="classCredits">3.0</p>
                                </div>
                                <div id="stuClass4" class="stuClass">
                                    <p class="classCourse">CS 201</p>
                                    <p class="classSection">001</p>
                                    <p class="classInstr">Oswald Burrows</p>
                                    <p class="classST">2:15 PM</p>
                                    <p class="classET">3:45 PM</p>
                                    <p class="classDays">TR</p>
                                    <p class="classCredits">3.0</p>
                                </div>
                                <div id="stuClass5" class="stuClass">
                                    <p class="classCourse">HY 101</p>
                                    <p class="classSection">001</p>
                                    <p class="classInstr">Oswald Burrows</p>
                                    <p class="classST">WWW</p>
                                    <p class="classET">WWW</p>
                                    <p class="classDays">*</p>
                                    <p class="classCredits">3.0</p>
                                </div>
                                <div id="stuClass6" class="stuClass">
                                    <p class="classCourse">STU 101</p>
                                    <p class="classSection">001</p>
                                    <p class="classInstr">Oswald Burrows</p>
                                    <p class="classST">3:00 PM</p>
                                    <p class="classET">4:00 PM</p>
                                    <p class="classDays">MW</p>
                                    <p class="classCredits">3.0</p>
                                </div>
                                -->
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