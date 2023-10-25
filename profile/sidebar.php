<?php 
    require_once '../classes/student.php';
    require_once '../classes/course.php';
    require_once '../classes/studentclass.php';
    
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <title>
        Account - <?php
            if(isset($_SESSION["studentProfile"])) {
                $student = $_SESSION["studentProfile"];
                $id = $student->getId();
                $firstName = $student->getFirstName();
                $lastName = $student->getLastName();
                $email = $student->getEmail();
                $studentNumber = $student->getStudentNum();
                $username = $student->getUsername();
                $password = $student->getPassword();
                try {
                    $pfp = $student->getPfp();
                }
                catch(Throwable $e) {
                    $pfp = null;
                }
                $registered = $student->getRegistered();
            }

            echo $firstName . " " . $lastName; 
        ?>
    </title>
    <meta chartset="UTF-8"/>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="https://kit.fontawesome.com/bfb4213bb3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles2.css">
    <!--[if lt IE 9]>
    <script>
        document.createElement("article");
        document.createElement("aside");
        document.createElement("footer");
        document.createElement("header");
        document.createElement("main");
        document.createElement("nav");
        document.createElement("section");
    </script>
    <![end if]-->

    <body>

        <div class="wrapper">
            <div class="sidebar">
                <div class="profileImg">
                    <a href="#">
                        <i class="far fa-user"></i>
                    </a>
                </div>
                <p>
                    <?php echo $firstName . " " .$lastName; ?>
                </p>

                <a id="logoutLink" href="../includes/logout.inc.php">Log Out</a>

                <ul>
                    <?php

                        $homeLink = "/CourseEnrollmentSimulator/profile/home.php";
                        $plannerLink = "/CourseEnrollmentSimulator/profile/planner.php";
                        $planner2Link = "/CourseEnrollmentSimulator/profile/planner2.php";
                        $planner3Link = "/CourseEnrollmentSimulator/profile/planner3.php";
                        $planner4Link = "/CourseEnrollmentSimulator/profile/planner4.php";
                        $scheduleLink = "/CourseEnrollmentSimulator/profile/schedule.php";
                        $settingsLink = "/CourseEnrollmentSimulator/profile/settings.php";
                        $helpLink = "/CourseEnrollmentSimulator/profile/help.php";
                        if(isset($_SERVER["SCRIPT_NAME"])) {
                            $currentPage = $_SERVER["SCRIPT_NAME"];

                            if($currentPage === $homeLink) {
                                echo 
                                "
                                <li class='selected'><a href='home.php'><i class='fas fa-home'></i>Home</a></li>
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif(($currentPage === $plannerLink) || ($currentPage === $planner2Link) || ($currentPage === $planner3Link) || ($currentPage === $planner4Link)) {
                                echo 
                                "
                                <li><a href='home.php'><i class='fas fa-home'></i>Home</a></li>
                                <li class='selected'><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif($currentPage === $scheduleLink) {
                                echo 
                                "
                                <li><a href='home.php'><i class='fas fa-home'></i>Home</a></li>
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li class='selected'><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif($currentPage === $settingsLink) {
                                echo 
                                "
                                <li><a href='home.php'><i class='fas fa-home'></i>Home</a></li>
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li class='selected'><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif($currentPage === $helpLink) {
                                echo 
                                "
                                <li><a href='home.php'><i class='fas fa-home'></i>Home</a></li>
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li class='selected'><a href='help.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                        }
                    ?>
                </ul>
            </div>
            
            <main>