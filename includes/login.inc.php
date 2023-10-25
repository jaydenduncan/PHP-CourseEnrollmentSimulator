<?php
if(isset($_POST["submit"])) {

    $uid = $_POST["studentsUid"];
    $password = $_POST["studentsPwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(loginInputIsEmpty($uid, $password)) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginStudent($conn, $uid, $password);

}
else {
    header("location: ../login.php");
    exit();
}