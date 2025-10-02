<?php 
    require_once 'sidebar.php';
    require_once '../includes/functions.inc.php';

    $mwfPositions = array();
    $trPositions = array();

    $classes = $student->getClasses();
    foreach($classes as $stuClass){
        if($stuClass->getType() !== "ONL"){
            $posMap = array();

            $stTimestamp = $stuClass->getStartTime();
            $etTimestamp = $stuClass->getEndTime();

            $stArr = getClassHourAndMinute($stTimestamp);
            $etArr = getClassHourAndMinute($etTimestamp);
            $classPos = getClassStartAndEndPos($stArr, $etArr);

            $posMap["classId"] = $stuClass->getId();
            $posMap["startTimePos"] = $classPos[0];
            $posMap["endTimePos"] = $classPos[1];

            if($stuClass->getActiveDays() === "MWF"){
                array_push($mwfPositions, $posMap);
            }
            else if($stuClass->getActiveDays() === "TR"){
                array_push($trPositions, $posMap);
            }
        }
    }

    usort($mwfPositions, "stPosSort");
    usort($trPositions, "stPosSort");

    setMarginTopOffsets($mwfPositions);
    setMarginTopOffsets($trPositions);

    $mtOffsets = array();
    foreach($mwfPositions as $mwfPos){
        $mtOffsets[$mwfPos["classId"]] = $mwfPos["mtOffset"];
    }

    foreach($trPositions as $trPos){
        $mtOffsets[$trPos["classId"]] = $trPos["mtOffset"];
    }
?>

                <div class="info">
                    <div class="daysOfWeekHeader">
                        <p></p>
                        <p>MON</p>
                        <p>TUE</p>
                        <p>WED</p>
                        <p>THU</p>
                        <p>FRI</p>
                    </div>
                    <div id="scheduleDiv" class="scheduleDiv">
                        <div class="timeLabels">
                            <p>12:00 AM</p>
                            <p>1:00 AM</p>
                            <p>2:00 AM</p>
                            <p>3:00 AM</p>
                            <p>4:00 AM</p>
                            <p>5:00 AM</p>
                            <p>6:00 AM</p>
                            <p>7:00 AM</p>
                            <p>8:00 AM</p>
                            <p>9:00 AM</p>
                            <p>10:00 AM</p>
                            <p>11:00 AM</p>
                            <p>12:00 PM</p>
                            <p>1:00 PM</p>
                            <p>2:00 PM</p>
                            <p>3:00 PM</p>
                            <p>4:00 PM</p>
                            <p>5:00 PM</p>
                            <p>6:00 PM</p>
                            <p>7:00 PM</p>
                            <p>8:00 PM</p>
                            <p>9:00 PM</p>
                            <p>10:00 PM</p>
                            <p>11:00 PM</p>
                        </div>
                        <div class="monClasses">
                            <?php
                                $classes = $student->getClasses();
                                usort($classes, "stuClassSTSort");
                                if(count($classes) > 0 && $registered){
                                    foreach($classes as $stuClass){
                                        $classDays = strtolower($stuClass->getActiveDays());
                                        if($classDays === "mwf"){
                                            $classId = $stuClass->getId();
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $stTimestamp = $stuClass->getStartTime();
                                            $etTimestamp = $stuClass->getEndTime();
                                            $dateTimeImmutable = new DateTimeImmutable();
                                            $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('g:i A');
                                            $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('g:i A');
                                            $marginTop = $mtOffsets[$classId];

                                            echo
                                            "<div class='classSlot $classDays' style='margin-top: $marginTop" . "px'>
                                                <h3>$courseAbbr $courseNum</h3>
                                                <p>$stFormatted - $etFormatted</p>
                                            </div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="tueClasses">
                            <?php
                                $classes = $student->getClasses();
                                usort($classes, "stuClassSTSort");
                                if(count($classes) > 0 && $registered){
                                    foreach($classes as $stuClass){
                                        $classDays = strtolower($stuClass->getActiveDays());
                                        if($classDays === "tr"){
                                            $classId = $stuClass->getId();
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $stTimestamp = $stuClass->getStartTime();
                                            $etTimestamp = $stuClass->getEndTime();
                                            $dateTimeImmutable = new DateTimeImmutable();
                                            $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('g:i A');
                                            $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('g:i A');
                                            $marginTop = $mtOffsets[$classId];

                                            echo
                                            "<div class='classSlot $classDays' style='margin-top: $marginTop" . "px'>
                                                <h3>$courseAbbr $courseNum</h3>
                                                <p>$stFormatted - $etFormatted</p>
                                            </div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="wedClasses">
                            <?php
                                $classes = $student->getClasses();
                                usort($classes, "stuClassSTSort");
                                if(count($classes) > 0 && $registered){
                                    foreach($classes as $stuClass){
                                        $classDays = strtolower($stuClass->getActiveDays());
                                        if($classDays === "mwf"){
                                            $classId = $stuClass->getId();
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $stTimestamp = $stuClass->getStartTime();
                                            $etTimestamp = $stuClass->getEndTime();
                                            $dateTimeImmutable = new DateTimeImmutable();
                                            $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('g:i A');
                                            $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('g:i A');
                                            $marginTop = $mtOffsets[$classId];

                                            echo
                                            "<div class='classSlot $classDays' style='margin-top: $marginTop" . "px'>
                                                <h3>$courseAbbr $courseNum</h3>
                                                <p>$stFormatted - $etFormatted</p>
                                            </div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="thuClasses">
                            <?php
                                $classes = $student->getClasses();
                                usort($classes, "stuClassSTSort");
                                if(count($classes) > 0 && $registered){
                                    foreach($classes as $stuClass){
                                        $classDays = strtolower($stuClass->getActiveDays());
                                        if($classDays === "tr"){
                                            $classId = $stuClass->getId();
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $stTimestamp = $stuClass->getStartTime();
                                            $etTimestamp = $stuClass->getEndTime();
                                            $dateTimeImmutable = new DateTimeImmutable();
                                            $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('g:i A');
                                            $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('g:i A');
                                            $marginTop = $mtOffsets[$classId];

                                            echo
                                            "<div class='classSlot $classDays' style='margin-top: $marginTop" . "px'>
                                                <h3>$courseAbbr $courseNum</h3>
                                                <p>$stFormatted - $etFormatted</p>
                                            </div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="friClasses">
                            <?php
                                $classes = $student->getClasses();
                                usort($classes, "stuClassSTSort");
                                if(count($classes) > 0 && $registered){
                                    foreach($classes as $stuClass){
                                        $classDays = strtolower($stuClass->getActiveDays());
                                        if($classDays === "mwf"){
                                            $classId = $stuClass->getId();
                                            $course = $stuClass->getCourse();
                                            $courseAbbr = $course->getAbbreviation();
                                            $courseNum = $course->getCourseNumber();
                                            $stTimestamp = $stuClass->getStartTime();
                                            $etTimestamp = $stuClass->getEndTime();
                                            $dateTimeImmutable = new DateTimeImmutable();
                                            $stFormatted = $dateTimeImmutable->setTimestamp($stTimestamp)->format('g:i A');
                                            $etFormatted = $dateTimeImmutable->setTimestamp($etTimestamp)->format('g:i A');
                                            $marginTop = $mtOffsets[$classId];

                                            echo
                                            "<div class='classSlot $classDays' style='margin-top: $marginTop" . "px'>
                                                <h3>$courseAbbr $courseNum</h3>
                                                <p>$stFormatted - $etFormatted</p>
                                            </div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

<?php
    require_once 'footer.php';
?>