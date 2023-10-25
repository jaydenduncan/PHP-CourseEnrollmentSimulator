<?php 
    include_once 'header.php' 
?>

            <section class="signupForm">
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo "<script>alert('Fill in all fields!');</script>";
                        }
                        elseif($_GET["error"] == "invalidfirstname") {
                            echo "<script>alert('Enter a proper first name!');</script>";
                        }
                        elseif($_GET["error"] == "invalidlastname") {
                            echo "<script>alert('Enter a proper last name');</script>";
                        }
                        elseif($_GET["error"] == "invalidstunum"){
                            echo "<script>alert('Enter a proper 9-digit student number!');</script>";
                        }
                        elseif($_GET["error"] == "invalidemail"){
                            echo "<script>alert('Enter a proper email!');</script>";
                        }
                        elseif($_GET["error"] == "passwordsdontmatch"){
                            echo "<script>alert('Passwords don\'t match!');</script>";
                        }
                        elseif($_GET["error"] == "stmtfailed"){
                            echo "<script>alert('Something went wrong. Try again!');</script>";
                        }
                        elseif($_GET["error"] == "uidtaken"){
                            echo "<script>alert('User account already set up!');</script>";
                        }
                        elseif($_GET["error"] == "none"){
                            echo "<script>alert('You have successfully signed up!');</script>";
                        }
                    }
                ?>
                <div class="signupFormDiv">
                    <form action="./includes/signup.inc.php" method="post">
                        <input type="text" id="studentsFirstName" name="studentsFirstName" placeholder="First Name"/>
                        <input type="text" id="studentsLastName" name="studentsLastName" placeholder="Last Name"/>
                        <input type="text" id="studentsStuNum" name="studentsStuNum" placeholder="9-digit Student Number"/>
                        <input type="email" id="studentsEmail" name="studentsEmail" placeholder="Student Email"/>
                        <input type="password" id="studentsPwd" name="studentsPwd" placeholder="Password"/>
                        <input type="password" id="studentsPwdRepeat" name="studentsPwdRepeat" placeholder="Re-enter Password"/>
                        <button type="submit" name="submit">Register</button>
                        <div class="signupFormSub">
                            <p>Already have an account?</p> <a href="login.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </section>
</div>
</main>
</body>
</html>