<?php require_once '../classes/student.php';
session_start();

require_once 'dbh.inc.php'; require_once 'functions.inc.php';

if(isset($_POST["submit"])) {
    
    $currentPwd = $_POST["currentPwd"];
    $newPwd = $_POST["newPwd"];
    $newPwdRepeat = $_POST["newPwdRepeat"];

    // Refresh page if no text fields are changed
    if(empty($currentPwd) && empty($newPwd) && empty($newPwdRepeat)) {

            header("location: ../profile/settings.php");
            exit();

    }
    else {

        if(updatePwdInputIsEmpty($currentPwd, $newPwd, $newPwdRepeat) !== false) {
            header("location: ../profile/settings.php?error=emptyinput");
            exit();
        }
        if(currentPwdNotMatch($currentPwd) !== false) {
            header("location: ../profile/settings.php?error=currentpwddoesnotmatch");
            exit();
        }
        if(pwdNotMatch($newPwd, $newPwdRepeat) !== false) {
            header("location: ../profile/settings.php?error=pwddoesnotmatchpwdrepeat");
            exit();
        }

        updatePassword($conn, $newPwd);

    }

}
else {
    header("location: ../profile/settings.php");
    exit();
}