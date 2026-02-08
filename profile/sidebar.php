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
    <script src="../js/ces.js"></script>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../css/planner.css">
    <link rel="stylesheet" type="text/css" href="../css/planner2.css">
    <link rel="stylesheet" type="text/css" href="../css/schedule.css">
    <link rel="stylesheet" type="text/css" href="../css/settings.css">
    <link rel="stylesheet" type="text/css" href="../css/help.css">
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
                <div id="profileImg" class="profileImg">
                    <a href="#">
                        <i class="far fa-user"></i>
                    </a>
                </div>
                <p id="profileName" class="profileName">
                    <?php echo $firstName . " " .$lastName; ?>
                </p>

                <a id="logoutLink" class="logoutLink" href="../includes/logout.inc.php">Log Out</a>

                <ul id="profileLinks" class="profileLinks">
                    <?php
                        function debug_to_console($data) {
                            $output = $data;
                            if (is_array($output))
                                $output = implode(',', $output);

                            echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
                        }

                        $uri = explode('/', $_SERVER['REQUEST_URI'])[1];
                        $plannerLink = "/" . $uri . "/profile/planner.php";
                        $planner2Link = "/" . $uri . "/profile/planner2.php";
                        $planner3Link = "/" . $uri . "/profile/planner3.php";
                        $planner4Link = "/" . $uri . "/profile/planner4.php";
                        $scheduleLink = "/" . $uri . "/profile/schedule.php";
                        $settingsLink = "/" . $uri . "/profile/settings.php";
                        $helpLink1 = "/" . $uri . "/profile/help_main.php";
                        $helpLink2 = "/" . $uri . "/profile/help_planner.php";
                        $helpLink3 = "/" . $uri . "/profile/help_schedule.php";
                        $helpLink4 = "/" . $uri . "/profile/help_settings.php";

                        if(isset($_SERVER["SCRIPT_NAME"])) {
                            $currentPage = $_SERVER["SCRIPT_NAME"];

                            if(($currentPage === $plannerLink) || ($currentPage === $planner2Link) || ($currentPage === $planner3Link) || ($currentPage === $planner4Link)) {
                                echo 
                                "
                                <li class='selected'><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help_main.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif($currentPage === $scheduleLink) {
                                echo 
                                "
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li class='selected'><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help_main.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif($currentPage === $settingsLink) {
                                echo 
                                "
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li class='selected'><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li><a href='help_main.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                            elseif($currentPage === $helpLink1 || $currentPage === $helpLink2 || $currentPage === $helpLink3 || $currentPage === $helpLink4 ) {
                                echo 
                                "
                                <li><a href='planner.php'><i class='fas fa-clipboard-list'></i>Planner</a></li>
                                <li><a href='schedule.php'><i class='fas fa-calendar-alt'></i>Schedule</a></li>
                                <li><a href='settings.php'><i class='fas fa-cog'></i>Settings</a></li>
                                <li class='selected'><a href='help_main.php'><i class='fas fa-question'></i>Help</a></li>
                                ";
                            }
                        }
                    ?>
                </ul>
            </div>
            
            <main>