<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

if(isset($_GET["edit"])){
    $id = $_GET["classid"];

    echo "<script>alert('Editing student class with id " . $id . "...');</script>";
}
else{
    header("location: ../profile/planner.php");
    exit();
}