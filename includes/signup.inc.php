<?php require_once 'dbh.inc.php'; require_once 'functions.inc.php';
if(isset($_POST["submit"])){

    $firstName = $_POST["studentsFirstName"];
    $lastName = $_POST["studentsLastName"];
    $email = $_POST["studentsEmail"];
    $stuNum = $_POST["studentsStuNum"];
    $password = $_POST["studentsPwd"];
    $pwdRepeat = $_POST["studentsPwdRepeat"];

    if(signupInputIsEmpty($firstName, $lastName, $stuNum, $email, $password, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidFirstName($firstName) !== false) {
        header("location: ../signup.php?error=invalidfirstname");
        exit();
    }
    if(invalidLastName($lastName) !== false) {
        header("location: ../signup.php?error=invalidlastname");
        exit();
    }
    if(invalidStuNum($stuNum) !== false) {
        header("location: ../signup.php?error=invalidstunum");
        exit();
    }
    if(invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdNotMatch($password, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(findStudent($conn, $stuNum, $email) !== false) {
        header("location: ../signup.php?error=uidtaken");
        exit();
    }

    $username = explode("@", $email)[0];

    $student = new Student(null, $firstName, $lastName, $email, $stuNum, $username, $password, null, 0);

    createStudent($conn, $student);

}
else {
    header("location: ../signup.php");
    exit();
}