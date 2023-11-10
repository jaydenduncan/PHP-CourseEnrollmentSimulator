<?php 
require_once '../classes/student.php';
require_once '../classes/course.php';
require_once '../classes/studentclass.php';

function signupInputIsEmpty($firstName, $lastName, $stuNum, $email, $pwd, $pwdRepeat) {
    $result;

    if(empty($firstName) || empty($lastName) || empty($stuNum) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidFirstName($firstName) {
    $result;

    if(!preg_match("/^[a-zA-Z]*$/", $firstName)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidLastName($lastName) {
    $result;

    if(!preg_match("/^[a-zA-Z]*$/", $lastName)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidStuNum($stuNum) {
    $result;

    if(!preg_match("/\b\d{9}\b/", $stuNum)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    $result;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;
}

function invalidUsername($username) {
    $result;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function pwdNotMatch($pwd, $pwdRepeat) {
    $result;

    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function findStudent($conn, $stuNum, $email) {
    try{
        $query = "SELECT * FROM students WHERE studentsStuNum = ? OR studentsEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $stuNum, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function createStudent($conn, $student) {
    try{
        $firstName = $student->getFirstName();
        $lastName = $student->getLastName();
        $email = $student->getEmail();
        $stuNum = $student->getStudentNum();
        $username = $student->getUsername();
        $password = $student->getPassword();
        $registered = $student->getRegistered();

        $query = "INSERT INTO students (studentsFirstName, studentsLastName, studentsEmail, 
                    studentsStuNum, studentsUid, studentsPwd, studentsRegistered) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssssssi", $firstName, $lastName, $email, $stuNum, $username, $hashedPwd, $registered);
        mysqli_stmt_execute($stmt);
        header("location: ../signup.php?error=none");
        exit();
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function loginInputIsEmpty($uid, $pwd) {
    $result;

    if(empty($uid) || empty($pwd)){
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function loginStudent($conn, $uid, $pwd) {
    $uidExists = findStudent($conn, $uid, $uid);

    if($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["studentsPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif($checkPwd === true) {
        session_start();

        $id = $uidExists["studentsId"];
        $firstName = $uidExists["studentsFirstName"];
        $lastName = $uidExists["studentsLastName"];
        $email = $uidExists["studentsEmail"];
        $stuNum = $uidExists["studentsStuNum"];
        $username = $uidExists["studentsUid"];
        $password = $uidExists["studentsPwd"];
        $pfp = $uidExists["studentsPfp"];
        $registered = $uidExists["studentsRegistered"];

        $student = new Student($id, $firstName, $lastName, $email, $stuNum, $username, $password, $pfp, $registered);

        $_SESSION["studentProfile"] = $student;

        // Add current classes from student's cart to student session instance
        $stuClassesRows = getClassesFromCart($conn, $id);
        if(count($stuClassesRows) > 0) {
            foreach($stuClassesRows as $row) {
                $courseRow = findCourseById($conn, $row["classesCourseId"]);
                $courseId = $courseRow["coursesId"];
                $courseAbbr = $courseRow["coursesAbbr"];
                $courseNum = $courseRow["coursesCourseNum"];
                $courseTitle = $courseRow["coursesTitle"];
                $courseDesc = $courseRow["coursesDesc"];
                $courseCreditHrs = $courseRow["coursesCreditHrs"];
                $course = new Course($courseId, $courseAbbr, $courseNum, $courseTitle, $courseDesc, 
                            $courseCreditHrs);

                $stuClass = new StudentClass($row["classesId"], $course, $row["classesSection"],
                            $row["classesInstructor"], $row["classesStartTime"], 
                            $row["classesEndTime"], $row["classesActiveDays"], $row["classesType"]);

                $_SESSION["studentProfile"]->addClass($stuClass);
            }
        }

        // Send user to their profile page
        header("location: ../profile/planner.php");
        exit();
    }
}

// Update Information (Settings Page) functions

function findUsername($conn, $username) {
    try{
        $query = "SELECT * FROM students WHERE studentsUid = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function findStuNum($conn, $stuNum) {
    try{
        $query = "SELECT * FROM students WHERE studentsStuNum = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $stuNum);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function findEmail($conn, $email) {
    try{
        $query = "SELECT * FROM students WHERE studentsEmail = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function updateStudent($conn, $student) {
    try{
        session_start();

        $newFirstName = $student->getFirstName();
        $newLastName = $student->getLastName();
        $newStuNum = $student->getStudentNum();
        $newEmail = $student->getEmail();
        $newUsername = $student->getUsername();

        $studentId = ($_SESSION["studentProfile"]->getId());

        $query = "UPDATE students SET studentsFirstName = ?, studentsLastName = ?, studentsEmail = ?, 
                    studentsStuNum = ?, studentsUid = ? WHERE studentsId = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/settings.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssi", $newFirstName, $newLastName, $newEmail, $newStuNum, $newUsername, $studentId);
        mysqli_stmt_execute($stmt);

        $_SESSION["studentProfile"]->setFirstName($newFirstName);
        $_SESSION["studentProfile"]->setLastName($newLastName);
        $_SESSION["studentProfile"]->setStudentNum($newStuNum);
        $_SESSION["studentProfile"]->setEmail($newEmail);
        $_SESSION["studentProfile"]->setUsername($newUsername);

        header("location: ../profile/settings.php?error=none");
        exit();
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function updatePwdInputIsEmpty($currentPwd, $newPwd, $newPwdRepeat) {
    $result;

    if(empty($currentPwd) || empty($newPwd) || empty($newPwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function currentPwdNotMatch($currentPwdInput) {
    session_start();

    $result;

    $origPwd = $_SESSION["studentProfile"]->getPassword();
    $checkPwd = password_verify($currentPwdInput, $origPwd);

    if($checkPwd === false) {
        $result = true;
    }
    elseif($checkPwd === true) {
        $result = false;
    }

    return $result;
}

function updatePassword($conn, $newPwd) {
    try{
        session_start();

        $studentId = ($_SESSION["studentProfile"]->getId());

        $query = "UPDATE students SET studentsPwd = ? WHERE studentsId = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/settings.php?error=stmtfailed");
            exit();
        }

        $newPwdHash = password_hash($newPwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "si", $newPwdHash, $studentId);
        mysqli_stmt_execute($stmt);

        $_SESSION["studentProfile"]->setPassword($newPwdHash);

        header("location: ../profile/settings.php?error=none");
        exit();
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

// Planner2 Page Functions

function findSubjects($conn) {
    try{
        $query = "SELECT DISTINCT coursesAbbr from courses";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $rows = array();
        while($row = mysqli_fetch_assoc($resultData)) {
            array_push($rows, $row);
        }

        return $rows;
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

// Planner3 Page Functions

function findCourses($conn, $subject) {
    try{
        $query = "SELECT * FROM courses WHERE coursesAbbr = ?;";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner2.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $subject);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $rows = array();
        while($row = mysqli_fetch_assoc($resultData)) {
            array_push($rows, $row);
        }
        
        return $rows;
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

// Planner4 Page Functions

function findCourse($conn, $courseAbbr, $courseNum) {
    try{
        $query = "SELECT * FROM courses WHERE coursesAbbr = ? AND coursesCourseNum = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner2.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $courseAbbr, $courseNum);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function findCourseById($conn, $courseId) {
    try{
        $query = "SELECT * FROM courses WHERE coursesId = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner2.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $courseId);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function findClasses($conn, $courseInput) {
    try{
        $courseValues = explode(":", $courseInput);
        $course = explode(" ", $courseValues[0]);
        $courseAbbr = $course[0];
        $courseNum = $course[1];

        // find the course matching course abbreviation and course number
        $courseExists = findCourse($conn, $courseAbbr, $courseNum);
        
        if($courseExists === false) {
            header("location: ../profile/planner2.php?error=coursedoesnotexist");
            exit();
        }

        $courseId = $courseExists["coursesId"];

        // find all classes with the existing course
        $query = "SELECT * FROM classes WHERE classesCourseId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner2.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $courseId);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $rows = array();
        while($row = mysqli_fetch_assoc($resultData)) {
            array_push($rows, $row);
        }

        return $rows;
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function findClassById($conn, $classId) {
    try{
        $query = "SELECT * FROM classes WHERE classesId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner2.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $classId);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

// Classes cart persistency functions

function addClassToCart($conn, $studentId, $classId) {
    try{
        // Link student id to class id in join table
        $query = "INSERT INTO student_to_class (studentId, classId) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner4.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "ii", $studentId, $classId);
        mysqli_stmt_execute($stmt);
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function deleteClassFromCart($conn, $classId) {
    try{
        session_start();

        $query = "DELETE FROM student_to_class WHERE studentId = ? AND classId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner.php?error=failedtoremoveclass");
            exit();
        }

        $studentId = $_SESSION["studentProfile"]->getId();

        mysqli_stmt_bind_param($stmt, "ii", $studentId, $classId);
        mysqli_stmt_execute($stmt);
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}

function getClassesFromCart($conn, $studentId) {
    try{
        // Find class ids linked to student id
        $query = "SELECT classId FROM student_to_class WHERE studentId = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $query)) {
            header("location: ../profile/planner.php?error=cartfailedtoload");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $studentId);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $classIds = array();
        while($row = mysqli_fetch_assoc($resultData)) {
            array_push($classIds, $row);
        }

        // Find classes that match the class ids
        $rows = array();
        foreach($classIds as $classIdRow){
            $row = findClassById($conn, $classIdRow["classId"]);
            array_push($rows, $row);
        }

        return $rows;
    }
    catch(Throwable $e){
        $e->getMessage();
    }
    finally{
        mysqli_stmt_close($stmt);
    }
}