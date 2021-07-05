<?php

    //Import PHPMailer classes into the global namespace
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
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" crossorigin="anonymous" />
    
    <style>
    
        /* image and its placement */
        body{
            
            background-image: url("https://lh3.googleusercontent.com/WCgoyQrUvBVX2bhtxKydoeaQC3bldLD_K6B2zK1yu2B3aklyUoeu7NTAw6ur0-agMoS5kux1axIC5_-FOKJTqc4O-yFYjBkHV4-czSJXGIQcYb8VQ0qU25W4Zh-OTyN-vTX6kk5ocnE=w2400");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            
            
        }

        /* The main div */
        .main{
            display:flex;
            flex-direction:row-reverse;
            justify-content:center;
            

        }


        .home{
            padding-top:3vh;
            margin-right:69vw;
            
        }

        /* The transparent container for form */
        .feedback{
            
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
            flex-direction:column;  
            color:white;
            
        }

        /* The form div */
        .form{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            width:40vw;
            height:60vh;
        }

        /* The form tag for proper alignment */
        form{
            display:flex;
            justify-content:center;
            align-content:center;
            flex-direction:column;
        }

        /* The name and the subject input tags */
        input{
            background: rgba( 255, 255, 255, 0.80 );
            box-shadow: 0 4px 2px 0 rgba( 231, 238, 235, 0.5 );
            backdrop-filter: blur( 5px );
            -webkit-backdrop-filter: blur( 0.5px );
            border-radius: 7px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
            width:30vw;
            height:3vh;
        }

        /* When the input tags are clicked */
        input:focus{
            color:white;
            background: rgba( 80, 227, 194, 0.60 );
            box-shadow: 0 4px 2px 0 rgba( 231, 238, 235, 0.37 );
            backdrop-filter: blur( 0.5px );
            -webkit-backdrop-filter: blur( 0.5px );
            border-radius: 10px;
            border: 3px solid rgba( 255, 255, 255, 0.18 );
            outline:none;
        }

        /* Input onclick placeholder */
        input:focus::placeholder{
            color:white;
        }

        /* TExt area with 40 words apporx styling */
        textarea{
            color:white;
            background: rgba( 180, 227, 254, 0.30 );
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 0.5px );
            -webkit-backdrop-filter: blur( 0.5px );
            border-radius: 10px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
            width:30vw;
            height: 20vh;
            outline:none;
        }

        /* TextArea placeholder */
        textarea::placeholder{
            color:white;
            
        }

        /* TextArea on click */
        textarea:focus{
            color:white;
            box-shadow: 2px 4px 2px 2px rgba( 231, 238, 235, 0.37 );
            backdrop-filter: blur( 5px );
            -webkit-backdrop-filter: blur( 5px );
            
        }


        /* Send button */
        input[type=submit]{
                width:10vw;
                height:5vh;
                font-size:2.5vh;
                color:white;
                background: rgba( 40, 27, 114, 0.60 );
                box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                backdrop-filter: blur( 0.5px );
                -webkit-backdrop-filter: blur( 0.5px );
                border-radius: 10px;
                border: 1px solid rgba( 255, 255, 255, 0.18 );
            }

        
        /* The button div */
        .btn{
            display:flex;
            justify-self:center;
            align-self:center;
        }

        /* The anchor tag */
        a{
            color:white;
        }

        a:active{
            color:white;
        }

        a:visited{
            color:white;
        }


        
        /* To adjust width of form for may be tablets I guess */
        @media only screen and (max-width: 1000px) {
            form{
                width:70vw;
                display:flex;
                align-items:center;
            }

            input{
                width:40vw;
            }

            textarea{
                width:40vw;
            }

            input[type=submit]{
                width:50vw;
            }
        }


        /* To adjust width of form for mobile devices */
        @media only screen and (max-width: 600px) {
            form{
                width:60vw;
            }

            input{
                width:60vw;
            }
            textarea{
                width:60vw;
            }

            input[type=submit]{
                width:50vw;
            }

        }

    </style>
    <title>FEEDBACK</title>
</head>
<body>
    
    <div class="main">
        <div class="home">
            <a href="homepage.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
        </div>
            <!-- Form holding container -->
        <div class="feedback">
            <h4>YOUR FEEDBACK CAN IMPACT!</h4>
            <div class="form">
                <form  method="post">

                    <div class="text"><input type="text" name="name" id="name" placeholder="name" required></div><br>
                    <div class="text"><input type="text" name="subject" id="subject" placeholder="subject" required></div><br>
                    <div><textarea name="message" id="" cols="30" rows="10" placeholder="Your feedback" maxlenght="300" required></textarea></div><br><br>
                    <div class="btn"><input type="submit" name="submit" value="send"></div>
                </form>
            </div>
            
        </div>
    </div>

    <?php


            // If submit is clicked
            if(isset($_POST['submit'])){

                if(isset($_POST['name'])){
                    $name = $_POST['name'];
                }
                if(isset($_POST['subject'])){
                    $subject = $_POST['subject'];
                }
                if(isset($_POST['message'])){
                    $mailBody = $_POST['message'];
                }
                if(isset($_POST['contact'])){
                    $contact = $_POST['contact'];
                }
                $mail = new PHPMailer(true);
                // Mail is sent to the user to the specified mail address with the token generated above
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'SenderEmail';                     //SMTP username
                    $mail->Password   = 'SendPassword';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                    //Recipients
                    $mail->setFrom('SenderEmail', 'SenderName');
                    $mail->addAddress('MyEmail', $name);     //Add a recipient
                    
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'FEEDBACK Email: '.$subject;
                    $mail->Body    = $mailBody.'<br>Contact: '.$contact;
                    
                    $mailsent = $mail->send();

                    // If mail sent then Then the alert and the location is redirected to homepage
                    if($mailsent){

                        ?>
                        <script>

                            alert("email sent! :)")                            

                            location.replace("homepage.php");
                            
                        </script>

                        <?php
                        
                    }
                } catch (Exception $e) {
                    
                    ?>
                    <script>
                        alert("There might be an issue with the mail server try again some time later");
                    </script>

                    <?php
                }

            }

    ?>

    </body>
</html>





