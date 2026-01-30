<!DOCTYPE html>
<html lang="en">
    <title>Course Enrollment Simulator</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
    <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/home.js"></script>
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
        <nav>
            <div class="wrapper">
                <img class="appLogo" src="./img/applogo.png" alt="CES Logo" height="45" width="45"/>

                <ul class="mainLinks">
                    <?php 
                        if(isset($_SERVER["SCRIPT_NAME"])) {
                            $currentPage = $_SERVER["SCRIPT_NAME"];
                            $uri = explode('/', $_SERVER['REQUEST_URI'])[1];
                            if($currentPage === "/" . $uri . "/index.php"){
                                echo 
                                "
                                <li><a href='index.php' style='color:blue'>HOME</a></li>
                                <li><a href='signup.php'>SIGN UP</a></li>
                                <li><a href='login.php'>LOGIN</a></li>
                                ";
                            }
                            elseif($currentPage === "/" . $uri . "/signup.php"){
                                echo 
                                "
                                <li><a href='index.php'>HOME</a></li>
                                <li><a href='signup.php' style='color:blue'>SIGN UP</a></li>
                                <li><a href='login.php'>LOGIN</a></li>
                                ";
                            }
                            elseif($currentPage === "/" . $uri . "/login.php"){
                                echo 
                                "
                                <li><a href='index.php'>HOME</a></li>
                                <li><a href='signup.php'>SIGN UP</a></li>
                                <li><a href='login.php' style='color:blue'>LOGIN</a></li>
                                ";
                            }
                            else {
                                echo 
                                "
                                <li><a href='index.php'>HOME</a></li>
                                <li><a href='signup.php'>SIGN UP</a></li>
                                <li><a href='login.php'>LOGIN</a></li>
                                ";
                            }
                        }
                    ?>
                </ul>

                <button class="hamburger" type="button" aria-label="Menu" aria-controls="navigation">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>

                <ul class="mobileLinks">
                    <?php 
                        if(isset($_SERVER["SCRIPT_NAME"])) {
                            $currentPage = $_SERVER["SCRIPT_NAME"];
                            $uri = explode('/', $_SERVER['REQUEST_URI'])[1];
                            if($currentPage === "/" . $uri . "/index.php"){
                                echo 
                                "
                                <li><a href='index.php' style='color:blue'>HOME</a></li>
                                <li><a href='signup.php'>SIGN UP</a></li>
                                <li><a href='login.php'>LOGIN</a></li>
                                ";
                            }
                            elseif($currentPage === "/" . $uri . "/signup.php"){
                                echo 
                                "
                                <li><a href='index.php'>HOME</a></li>
                                <li><a href='signup.php' style='color:blue'>SIGN UP</a></li>
                                <li><a href='login.php'>LOGIN</a></li>
                                ";
                            }
                            elseif($currentPage === "/" . $uri . "/login.php"){
                                echo 
                                "
                                <li><a href='index.php'>HOME</a></li>
                                <li><a href='signup.php'>SIGN UP</a></li>
                                <li><a href='login.php' style='color:blue'>LOGIN</a></li>
                                ";
                            }
                            else {
                                echo 
                                "
                                <li><a href='index.php'>HOME</a></li>
                                <li><a href='signup.php'>SIGN UP</a></li>
                                <li><a href='login.php'>LOGIN</a></li>
                                ";
                            }
                        }
                    ?>
                </ul>
            <div>
        </nav>

        <main>
            <div class="wrapper2">