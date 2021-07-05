<?php

    // session starting
    session_start();
    //Import PHPMailer classes into the global namespace
    
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require_once __DIR__.'config.php';
    require_once __DIR__.'lib/vendor/autoload.php';
    require_once __DIR__.'scripts/validation.js';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>XKCD COMICS</title>
    <link rel='stylesheet' href='css/signup.css'>

</head>
<body>
    
    <!-- The main container -->
    <div class='signup'>
    
        <!-- The left container for image and login link -->
        <div class='left'>
            
            
            <img id='image' src='https://lh3.googleusercontent.com/t8xJki-fyjrL4EZ_6GLewLmNyfuqMR873GyARBYa5otilg5acxDU0Ssi9jkag4hnK_1s8cv3vHMqEu8GhOfJ5pUqw9KyKn7xjY7NTWD4eSXDzQhUsG4FhibIXFmhz-8jDD8TwVtd4Xo=w2400' alt='welcome image'><br><br class='hide'>
            <h5>HAVE AN ACCOUNT?</h5><br class='hide'><br class='hide'>
            <h3><a class='redirect' href='login.php'>LOGIN</a></h3><br>
            
        </div>

    <!-- The right container for form and the text messages -->
        
            <div class='right'>
            <div class='msg'>Ready to get your XKCD comics?</div>
            <!-- The form tag -->
            <div class='center'>
                
                <form  id='myForm' method='post'>
                    <!-- The div for name and nickname -->
                    <div class='first'>
                        <input class='textfield' type='text' name='name' id='name' placeholder='Enter your Name' required>
                    </div>

                    <div class='first'>
                            <input  class='textfield' type='text' name='nickname' id='nickname' placeholder= 'Cute name to call?'>
                    </div>
                    
                    <!-- The div for mobile and email -->
                    <div class='first'>
                        <input class='textfield' type='tel' name='mobile' id='phone' placeholder='Phone Number' pattern='[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}' required>
                    </div>
                    
                    <div class='first'>
                            <input  class='textfield' type='email' name='email-id' id='email' placeholder='Email Id'>
                    </div>
                    <!-- THe div for password and confirm password -->
                    <div class='first'>
                        <input class='textfield' type='password' name='password' id='password' onkeyup='check();' placeholder='createpassword' required>
                    </div>
                    
                    <div class='first'>
                        <input  class="textfield" type='password' name='confirm_password' id='confirm_password' placeholder='confirm password' onkeyup='check();'>
                    </div>

                    <!-- THe span tag for password matching -->
                    <div class='first'>
                    <span id='message'></span>
                    </div>
            </div><br class='hide'>
                <!--The submit button-->
                <div class='first'>
                <input class='bottom' type='submit' name='submit' value='Register' >                           
                </div>
            </form><br>
                
        </div>    
        
        </div>

    </div>
    </div>


    <?php

        // if submit button is clicked it is redirected here
        if(isset($_POST['submit'])){

            // All the input fields from the user are 
            if(isset($_POST['name'])){
                $name = mysqli_real_escape_string($conn,$_POST['name']);
            }
            if(isset($_POST['nickname'])){
                $nickname = mysqli_real_escape_string($conn,$_POST['nickname']);
            }
            if(isset($_POST['mobile'])){
                $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
            }
            if(isset($_POST['email-id'])){
                $email = mysqli_real_escape_string($conn,$_POST['email-id']);
            }
            if(isset($_POST['password'])){
                $password = mysqli_real_escape_string($conn,$_POST['password']);
            }
            if(isset($_POST['confirm_password'])){
                $cpassword = mysqli_real_escape_string($conn,$_POST['confirm_password']);     
            }

            // Checking if the inputs are empty
            if($name== '' ||$nickname== '' || $mobile == '' || $email == '' || $password == '' || $cpassword == ''){
                ?>
                <script>
                    alert('Enter the requried fields!');
                </script>
                <?php
            }
            else{

                $password_encrypt = password_hash($password,PASSWORD_BCRYPT);

                // Storing everything in session messages
                $_SESSION['nickname'] = $nickname;

                $_SESSION['email'] = $email;

                $_SESSION['username'] = $name;

                // Generating token to send to the user to for activation
                $token = bin2hex(random_bytes(12));

                // If the status is inactive which means the activation link is sent and not verified
                $stmt = $conn->prepare('select * users where email = ? and status = ?');
                // Binding parameters
                $stmt->bind_param('ss',$email,'inactive');
                // Executing the query
                $result = $stmt->execute();

                
                // If the resultant set is not empty with atleast 1 row resulted
                if ($result) {

                    // SEssion message is set as below and redirected to login page
                    $_SESSION['msg'] = 'Seems that Activation link is sent already. Try activating account.';
                    ?>
                    <script>

                        location.replace('login.php');

                    </script>
                    <?php                
                }

                // The query to check if the user already have account and verified his account.
                $stmt = $conn->prepare('select * users where email = ? and status = ?');
                
                // binding parameters
                $stmt->bind_param('ss',$email,'active');
                
                // To check the query in the database
                $dbquery = $stmt->execute();

                // If the resultant set is not empty and has atleast 1 row in it
                if ( $dbquery > 0) {
                
                        // SEssion message is set to the below and redirected to login page
                        $_SESSION['msg'] = 'Seems that you have an account. Try logging in! :)';
                    ?>
                        <script>

                            location.replace('login.php');

                        </script>
                    <?php
    
                }
                // If the above query didn't result anything then user doesn't have account
                else{
                    
                    $mailbody= '
        
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Document</title>
                        <style>
                            .container{
                                background-color:#fcfcfc;
                            }
                            
                            a{
                                text-decoration:none;
                            }
                            
                            @media only screen and (max-width: 1000px) {
                                #img{
                                    width:60vw;
                                    height:20vh;
                                }
                    
                                .btn{
                    
                                    width:20vw;
                                    height:6vh;
                                    background-color: rgb(138, 163, 209);
                                    color:white;
                                    border-radius:10px;
                                    padding:5px;
                                }
                                
                            }
                            @media only screen and (max-width: 1200px) and (min-width: 1001px)  {
                                #img{
                                    width:40vw;
                                    height:20vh;
                                }
                            }
                    
                            @media only screen and (min-width: 1201px) { 

                                .container{
                                    padding:4vw;
                                }
                                #img{
                                    width:30vw;
                                    height:20vh;
                                }
                    
                                .btn{
                    
                                    width:10vw;
                                    height:6vh;
                                    background-color: rgb(138, 163, 209);
                                    color:white;
                                    text-decoration: none;
                                    border-radius: 60px;
                                    font-size: 1.5vw;
                                }
                            }
                    
                            footer{
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }
                    
                            #unsubscribe{
                                display: flex;
                                justify-content: center;
                                width:10vw;
                            }

                            a{
                                text-decoration:none;
                            }
                    
                    
                        </style>
                    </head>
                    <body>
                        
                        <div class="container">
                            <p>Hey There This is kinda boring I know but safety is our first priority.<br> Hope you are doing well.<br>Click on the link below to access your account it\'s just a click far and then VOILA! you can access your account.</p>
                            <hr>
                            <img id=img" src="https://lh3.googleusercontent.com/qt8PjHbWai7CYeuYQXIqyL1oNwH_TkypK2agPXR-ISjqAYZaoT3hjZmApt9zIJMGa3g8QDG6sMF9RtaUS7cphBkg2FdQkXiHhGsTYy10RSH4CmiO8YOdZjJyJVO0o2l5__4zxrD-yyU=w2400" alt="a gif of hand"><br>
                            
                        </div>
                    
                    ';
                    
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
                    $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';
                    
                    $mail = new PHPMailer(true);
                    // Mail is sent to the user to the specified mail address with the token generated above
                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'userEMAIL';                     //SMTP username
                        $mail->Password   = 'userPASSWORD';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                
                        //Recipients
                        $mail->setFrom('userEMAIL', 'XKCD COMIC');
                        $mail->addAddress($email, $name);     //Add a recipient
                        
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Activation Email';
                        $mail->Body    = $mailbody;
                        $mail->Body   .="<a  href='$isSecure://$httpHost/activation.php?token=$token' ><table width='100%' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                            <td align='left'>
                                <span class= 'btn'>activate</span>
                            </td>
                        </tr>
                        </table> </a>"
                        ."<footer>
                        <p>If you feel annoyed with our mails feel free to<br> <a id=\"unsubscribe\" href=\"$isSecure://$httpHost/unsubscribe.php?token=$token\">unsubscribe</a> </p>
                        </footer>".
                        
                        '</body>
                        </html>';
                            
                        $mail->AltBody = 'Copy paste the link in browser to activate your account ->'. $isSecure."://$httpHost/activation.php?token=".$token;
                
                        $mail->send();
                
                        $_SESSION['msg'] = 'Check your email for activation '.$email;

                        
                        // So this query to insert data is used
                        $query = "INSERT INTO users (name, nickname, phone, email, password, token, status) 
                        VALUES ('$name','$nickname','$mobile','$email','$password_encrypt','$token','inactive')";


                        $stmt = $conn->prepare("INSERT INTO users (name, nickname, phone, email, password, token, status) VALUES (:name, :nickname, :phone, :email, :password, :token, :status)");
                        $res = $stmt->execute(array('name' => $name, 'nickname' => $nickname, 'mobile' => $mobile, 'email' => $email, 'password' => $password, 'token' => $token, 'status' => 'inactive'));

                        // If insertion is true
                        if($res){
                            
                        ?>
                        <script>

                                location.replace('login.php');
                            
                            </script>

                            <?php
                        }   
                        // If data is not inserted
                        else{
                            ?>
                            <script>
                                alert('Data Not Inserted');
                            </script>

                            <?php
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
                
        }
    ?>