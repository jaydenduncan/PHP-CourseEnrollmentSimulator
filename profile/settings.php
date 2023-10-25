<?php 
    require_once 'sidebar.php'
?>

                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "invalidfirstname") {
                            echo "<script>alert('Enter a proper first name!');</script>";
                        }
                        elseif($_GET["error"] == "invalidlastname") {
                            echo "<script>alert('Enter a proper last name!');</script>";
                        }
                        elseif($_GET["error"] == "invalidstunum"){
                            echo "<script>alert('Enter a proper 9-digit student number!');</script>";
                        }
                        elseif($_GET["error"] == "invalidemail"){
                            echo "<script>alert('Enter a proper email!');</script>";
                        }
                        elseif($_GET["error"] == "stmtfailed"){
                            echo "<script>alert('Something went wrong. Try again!');</script>";
                        }
                        elseif($_GET["error"] == "invalidusername"){
                            echo "<script>alert('Enter a proper username!');</script>";
                        }
                        elseif($_GET["error"] == "usernametaken"){
                            echo "<script>alert('Username is taken!');</script>";
                        }
                        elseif($_GET["error"] == "studentnumbertaken"){
                            echo "<script>alert('Student number is taken!');</script>";
                        }
                        elseif($_GET["error"] == "emailtaken"){
                            echo "<script>alert('Email is taken!');</script>";
                        }
                        elseif($_GET["error"] == "emptyinput"){
                            echo "<script>alert('Fill in all fields!');</script>";
                        }
                        elseif($_GET["error"] == "currentpwddoesnotmatch"){
                            echo "<script>alert('Current password does not match!');</script>";
                        }
                        elseif($_GET["error"] == "pwddoesnotmatchpwdrepeat"){
                            echo "<script>alert('New password does not match the re-entered password!');</script>";
                        }
                        elseif($_GET["error"] == "none"){
                            echo "<script>alert('Profile information successfully updated!');</script>";
                        }
                    }
                ?>
                <div id="updateInfoDiv" class="accountUpdateInfo">
                    <h2>Account Information</h2>
                    <form action="../includes/updateInfo.inc.php" method="post">
                        <label id="firstNameLabel" for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>"/>

                        <label id="lastNameLabel" for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>"/>

                        <label id="stuNumLabel" for="stuNum">Student Number</label>
                        <input type="text" id="stuNum" name="stuNum" value="<?php echo $studentNumber ?>"/>

                        <label id="emailLabel" for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $email ?>"/>

                        <label id="usernameLabel" for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $username ?>"/>

                        <button type="submit" id="button1" name="submit">Update Information</button>
                    </form>
                </div>

                <div id="changePwdDiv" class="accountUpdateInfo">
                    <h2>Change Password</h2>
                    <form action="../includes/updatePwd.inc.php" method="post">
                        <label id="currentPwdLabel" for="currentPwd">Current Password</label>
                        <input type="password" id="currentPwd" name="currentPwd"/>

                        <label id="newPwdLabel" for="newPwd">New Password</label>
                        <input type="password" id="newPwd" name="newPwd"/>

                        <label id="newPwdRepeatLabel" for="newPwdRepeat">Re-enter Password</label>
                        <input type="password" id="newPwdRepeat" name="newPwdRepeat"/>

                        <button type="submit" id="button2" name="submit">Update Password</button>
                    </form>
                </div>

<?php
    require_once 'footer.php';
?>