<?php

    session_start();
    // Including connection.php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require_once __DIR__.'lib/vendor/autoload.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgotPassword</title>
    <style>
    
    /* The background and its alignment */
    body{
        background-image: url('https://lh3.googleusercontent.com/DCF_ZQ5LaTLxEnGQjgyUFO7vvkVnHQnYEXnbIdk0BFWrHatH8-S85SmIF2oGuCX1xru136WEgbKO1nbFMq24m7kLE_wudvEaMbEuAB7F0nBhS1roN0gBeVEc2BZK-5B6s20VOO34igQ=w2400');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;

        color:antiquewhite;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    /* The transparent container */
    .container{
        
        position:relative;
        top:10%;
        background: rgba( 0, 0, 0, 0.25 );
        backdrop-filter: blur( 0.0px );
        -webkit-backdrop-filter: blur( 0.0px );
        border-radius: 10px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
        width:80vw;
        height:80vh;
        display:flex;
        flex-direction:row;
        justify-content:space-around;
        align-items:center;
    }

    /* THe image div */
    .image{
        width:30vw;
        height:50vh;
    }

    /* THe form holding div */
    .right{
        background: rgba( 2, 22, 41, 0.30 );
        backdrop-filter: blur( 0.0px );
        -webkit-backdrop-filter: blur( 0.0px );
        border-radius: 10px;
        width:40vw;
        height:60vh;
        display:flex;
        justify-content:center;
        align-items: center;
        flex-direction:column;
        text-shadow: 0px 0px 0.5px #fff, 
               0px 0px 0.5px #fff;

    }

    /* The form tag */
    form{
        display:flex;
        justify-content:center;
        align-items: center;
        flex-direction:column;
        gap:2rem;
    }

    /* The input tag and its styling */
    input{
        
        background-color:#000;
        width:30vw;
        height:5vh;
        border-radius:2vw;
        outline:none;
        color:white;
        font-size:2vh;
    }

    /* THe anchor tag for know your password */
    a{
        color:#fff;
        text-decoration:none;
    }

    /* THe input placeholder */
    ::placeholder{
        color:#fff;
        font-size:2vh;
    }

    /* The submit button */
    input[type=submit]{
        color:#fff;
        width:10vw;
        font-size:2.5vh;
    }

    /* The know your password anchor tag */
    .know:hover{
        text-shadow: 0px 0px 0.5px #fff, 
               0px 0px  5px #fff;

    }

    /* THe know your password anchor tag for mobile devices */
    .hide{
        display:none;
    }

    
    /* For smaller devices */
    @media only screen and (max-width: 1000px) {
        
        
        /* The transparent container */
        .container{
            position:fixed;
            top:10%;
            background: rgba( 155, 155, 155, 0.15 );
            box-shadow: 0 8px 32px 0 rgba( 0, 0, 0, 0.7 );
            backdrop-filter: blur( 2px );
            -webkit-backdrop-filter: blur( 1px );
            border-radius: 10px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
            width:80vw;
            height:70vh;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column-reverse;  
            color:white;
        }

        /* The image container */
        .left{
            display:flex;
            justify-content:center;
            flex-direction:column;
            align-items:center;
        }

        /* The image tags class */
        .image{
            width:60vw;
            height:30vh;
        }

        /* The know your password link for responsive divs its hidden here */
        .know{
            display:none;
        }

        /* The know your password for mobile devices it is shown here */
        .hide{
            display:block;
        }

        /* The know your password on hover */
        .hide:hover{
            text-shadow: 0px 0px 0.5px #fff, 
               0px 0px  5px #fff;
        }

        /* The form tags div */
        .right{
            width:70vw;
            height:50vh;
        }

        /* THe form tag and its alignment */
        form{
        gap:1rem;
        }

        /* The input tag and its background  */
        input{
        
            background-color:#000;
            width:60vw;
            height:4vh;
            border-radius:2vw;
            outline:none;
            color:white;
            font-size:2vh;
        }

        /* The submit button */
        input[type=submit]{
        color:#fff;
        width:40vw;
        font-size:2.5vh;
    }



    }   

    
    </style>
</head>
<body>

    <?php
    
        if(isset($_SERVER['HTTP_HOST'])){
            $httpHost = $_SERVER['HTTP_HOST'];
        }
        $isSecure = '';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $isSecure = 'https';
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
            $isSecure = 'https';
        }else{
            $isSecure = 'http';
        }
        
        
    ?>

        <!-- The main container  -->
    <div class='container'>
    
        <!-- The image container -->
        <div class='left'>
        
            <img class='image' src='https://lh3.googleusercontent.com/n1nfX1bGWbiciaoPIr6NHlCyyYC-T1-3TFq3RKmpFQOeWEnLvR-gLP1WfJ5uTcDTGC8nIBHiXLFCfv-n_B7I_DC6GpRTFTHvhGjJ-q2cYxatL3mYceM0vg2H2xJqp8DBzd_ugf14ylM=w2400' alt='forgot-password'>
            
            <!-- Hidden for mobile devices -->
            <a class='hide' href='<?php echo $isSecure; ?>://<?php echo $httpHost; ?>/login.php'>Know your Password ?</a>
        </div>

        <!-- The form container -->
        <div class='right'>

        <?php

            // If submit button is clicked
            if(isset($_POST['submit'])){

                if(isset($_POST['email'])){
                    $email = $_POST['email'];
                }
                // Checking query
                $stmt = $conn->prepare('SELECT * FROM users WHERE email = ? where status = ?');
                // Binding parametes
                $stmt->bind_param('ss',$email,'inactive');
                // Executing query
                $result = $stmt->execute();

                // If the resultant set has rows greater than 0
                if($result){

                    $loginDetails = mysqli_fetch_assoc($check);

                    // tokem from the database is taken
                    $token =  $loginDetails['token'];

                    $nickname = $loginDetails['nickname'];

                    $name = $loginDetails['name'];
                    // Mailing details are sent with token from the database
                    $mail = new PHPMailer(true);
                    // Mail is sent to the user to the specified mail address with the token generated above
                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'userName';                     //SMTP username
                        $mail->Password   = 'userPassword';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                
                        //Recipients
                        $mail->setFrom('SENDERMAIL', 'sener name');
                        $mail->addAddress('RECEPIENT', 'xkcd user');     //Add a recipient
                        
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'PASSWORD RESET LINK';
                        $mail->Body    = "Hello  {$nickname} Click here to reset your password
                        $isSecure://$httpHost/resetPassword.php?token=".$token; 
                        
                        $mail->AltBody = 'Copy paste the following link in browser to reset your password'."$isSecure://$httpHost/resetPassword.php?token=".$token;
                
                        if($mail->send()){
                            $_SESSION['msg'] = 'Click the link in your email to reset your password'.$email;
                        
                        }
                        // If data is not inserted
                        else{
                            $_SESSION['msg'] = 'Sorry there is something wrong with the mail';
                        
                        }
                    } catch (Exception $e) {
                        ?>
                        <script>

                            alert('Mail not sent! Try once again!');
                            
                        </script>

                        <?php
                        
                    }
                    
                }


            }

        ?>

            <!-- Form tag -->
            <div class='heading'>
            <?php
               
               if(isset($_SESSION['msg'])){
                   echo $_SESSION['msg']."<br>";
               }
               else{
                   echo '<h3>ENTER YOUR EMAIL ID</h3>';
               }
            
            ?>
            </div>

          <br>
            <form method='post'>
            
                <input type='email' name='email' id='email' placeholder='Enter Your Email' required>
                <input type='submit' value='submit' name='submit'>
            
            </form><br>
            <!-- REsponsive login anchor tag -->
            <a class='know' href='login.php'>Know your Password ?</a>
        </div>

        
    </div>
</body>
</html>




