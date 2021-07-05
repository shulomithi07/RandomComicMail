<?php

session_start();

// including the connection and login css
require_once __DIR__.'config.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>LOGIN</title>

</head>
<body>
    
    <!-- total container -->
    <div class="signup">

        <!-- image holding div -->
        <div class='left'>
            <img id='image' src='https://lh3.googleusercontent.com/zUA4tIqNUytRqRrXN38Xf5E2t-LsCeOKoVcqoWgWbAE7PTEnAeigHo2cmq1KJLWeaubG3z1KzDlKDtO0tYoA7CTwcDK8rPhuhcKxjVZCnxgmbL_Cm169R-0LEreHOKPGfhf38QygiQM=w2400' alt='welcome image'><br class='hide'>
            <h5 class='text'>DON'T HAVE AN ACCOUNT?</h5><br class="hide">
            <h3><a class='redirect' href='index.php'>SIGNUP</a></h3>
        </div>
        
        <!-- The form and the session messages container -->
        <div class="right">
                <!-- Including session message if session message is set else login is printed -->
                <div class="msg">
                    <?php    
                    if(isset($_SESSION['msg'])){
                            echo $_SESSION['msg'];
                        }
                        else{
                            $_SESSION['msg'] = 'Enter your Details below!';

                            echo $_SESSION['msg'];
                        }
                    
                    ?>
                </div><br>
        
            <!-- form holding div -->
            <div class='center'>
                        <!-- form -->
                <form method='post'>
                    <div class='first'>
                        
                        <!-- input fields email and password -->
                        <input type='email' name='email' id='email' placeholder='email' required><br class='hide'><br class='hide'>
                        <input type='password' name='password' id='password' placeholder='password' required><br class='hide'>
                    </div><br class='loginBr'>

            
                        <input class='top btn' type='submit' name='submit' value='LOGIN'>
                        <!-- link to forgot password -->
                        <a class='forgot' href='#' onclick='redirect();'>Forgot Password? </a> 
            </div>
        </div>
                </form>
                        <script>

                            function redirect(){
                                window.location.replace('passwordForgot.php');
                            }
                        </script>
                

    </div>


    <?php
        // if submit button is clicked this is triggered
        if(isset($_POST['submit'])){
    
            // taking email and password from user submitted form
            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }
            
            if(isset($_POST['password'])){
                $CheckPassword = $_POST['password'];
            }


            // Checking if user inputs are empty or not
            if($email == '' || $CheckPassword == ''){
                ?>
                <script>
                    alert('Enter the requried fields');
                </script>
                <?php
            }
            else{

                // if user already have an active account is checked with the database with the below query
                $stmt = $conn->prepare('SELECT * FROM users WHERE email = ? where status = ?');
                $stmt->bind_param('ss',$email,'inactive');
                $ifUserExists = $stmt->execute();

                // If the status is inactive it means that the mail is sent already to activate.
                if($ifUserExists){
                    $_SESSION['msg'] = 'Email already Sent! Please check your mail.';
                    ?>

                        <script>
                            location.replace('login.php');
                        </script>
                    <?php
                }
                else{
                    // if not empty checked with the database with the below query
                    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ? where status = ?');
                    // binding params 
                    $stmt->bind_param('ss',$email,'active');
                    // Executing statements
                    $resultSet = $stmt->execute();

                    // If the result set retured more than 0 rows
                    if ($resultSet) {
            
                        // Fetching details from the database
                        $loginDetails = mysqli_fetch_assoc($querycheck);

                        // password email nickname fething from database
                        $userLoginPassword = $loginDetails['password'];
                        $_SESSION['email'] = $loginDetails['email'];
                        $_SESSION['nickname'] = $loginDetails['nickname'];
            
                        // As the password is hashed verifying password with password_verify
                        $passwordCheck = password_verify($CheckPassword,$userLoginPassword);
            
                        // If password verified redirected to homepage
                        if($passwordCheck){
                            ?>
            
                                <script>
            
                                    location.replace('homepage.php');
            
                                </script>
            
                            <?php
                        }
                        // else alerts as incorrect password
                        else{
                            
                            ?>
            
                            <script>
                            
                                    alert ('Incorrect Password');
                            </script>
            
                            <?php
                        }
                    }
                    // If email doesn't exists in the database alerts email doesn't exist
                    else{
                        ?>
            
                            <script>
            
                                alert('Email doesn\'t exists, try tO Sign Up');
                            </script>
            
                        <?php
                    }
                }
            }
        
        }
        
    ?>
    

</body>
</html>
