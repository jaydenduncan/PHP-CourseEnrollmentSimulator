<?php 
    include_once 'header.php' 
?>

                <section class="loginForm">
                    <div class="loginFormDiv">
                        <form action="./includes/login.inc.php" method="post">
                            <input type="text" id="studentsUid" name="studentsUid" placeholder="Student Email or Student Number"/>
                            <input type="password" id="studentsPwd" name="studentsPwd" placeholder="Password"/>
                            <div class="loginFormSub1">
                                <a href="resetpwd.php">Forgot Password?</a>
                            </div>
                            <button type="submit" name="submit">Login</button>
                            <div class="loginFormSub2">
                                <p>Don't have an account?</p> 
                                <a href="signup.php">Sign Up</a>
                            </div>
                        </form>
                    </div>
                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "emptyinput"){
                                echo "<script>alert('Fill in all fields!');</script>";
                            }
                            else if($_GET["error"] == "wronglogin"){
                                echo "<script>alert('Incorrect login information!');</script>";
                            }
                        }
                    ?>
                </section>

</div>
</main>
</body>
</html>