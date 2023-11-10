<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/studentclass.php';

session_start();

if(isset($_GET["delete"])){
    // Get the id of the class that the user want to remove from the shopping cart
    $id = $_GET["classid"];

    // Remove the class from the student's array of classes
    $_SESSION["studentProfile"]->deleteClass($id);

    // Remove the student to class link in the database
    deleteClassFromCart($conn, $id);

    header("location: ../profile/planner.php?success=removedclassfromcart");
    exit();
}
else{
    header("location: ../profile/planner.php");
    exit();
}