<?php require_once '../classes/student.php';
session_start();

// Get original data from session
$origFirstName = $_SESSION["studentProfile"]->getFirstName();
$origLastName = $_SESSION["studentProfile"]->getLastName();
$origUsername = $_SESSION["studentProfile"]->getUsername();
$origStuNum = $_SESSION["studentProfile"]->getStudentNum();
$origEmail = $_SESSION["studentProfile"]->getEmail();

require_once 'dbh.inc.php'; require_once 'functions.inc.php';

if(isset($_POST["submit"])) {

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $stuNum = $_POST["stuNum"];
    $email = $_POST["email"];
    $username = $_POST["username"];

    // Autofill empty text fields with original data
    if(empty($firstName)) {
        $firstName = $origFirstName;
    }
    if(empty($lastName)) {
        $lastName = $origLastName;
    }
    if(empty($stuNum)) {
        $stuNum = $origStuNum;
    }
    if(empty($email)) {
        $email = $origEmail;
    }
    if(empty($username)) {
        $username = $origUsername;
    }

    // Refresh page with original data if no text fields are changed
    if(($firstName===$origFirstName) && ($lastName===$origLastName) && ($stuNum===$origStuNum)
        && ($email===$origEmail) && ($username===$origUsername)) {

            header("location: ../profile/settings.php");
            exit();

    }
    else {
        // Fill student object with data
        $student = new Student(null, $firstName, $lastName, $email, $stuNum, $username, null, null, null);

        // Check for errors and send error message back to settings.php
        if(invalidFirstName($firstName) !== false) {
            header("location: ../profile/settings.php?error=invalidfirstname");
            exit();
        }
        if(invalidLastName($lastName) !== false) {
            header("location: ../profile/settings.php?error=invalidlastname");
            exit();
        }
        if(invalidStuNum($stuNum) !== false) {
            header("location: ../profile/settings.php?error=invalidstunum");
            exit();
        }
        if(invalidEmail($email) !== false) {
            header("location: ../profile/settings.php?error=invalidemail");
            exit();
        }
        if(invalidUsername($username) !== false) {
            header("location: ../profile/settings.php?error=invalidusername");
            exit();
        }
        if($username !== $origUsername){
            if(findUsername($conn, $username) !== false) {
                header("location: ../profile/settings.php?error=usernametaken");
                exit();
            }
        }
        if($stuNum !== $origStuNum){
            if(findStuNum($conn, $stuNum) !== false) {
                header("location: ../profile/settings.php?error=studentnumbertaken");
                exit();
            }
        }
        if($email !== $origEmail){
            if(findEmail($conn, $email) !== false) {
                header("location: ../profile/settings.php?error=emailtaken");
                exit();
            }
        }

        // Update student with new data if no errors are caught
        updateStudent($conn, $student);
    }

}
else {
    header("location: ../profile/settings.php");
    exit();
}