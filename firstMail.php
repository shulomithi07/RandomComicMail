<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>firstMail</title>
</head>
<body>
        
    <?php

        // Session Start
        session_start();

        //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
 require_once __DIR__.'lib/vendor/autoload.php';


        // Setting URL
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
        

        $url=$isSecure.'://c.xkcd.com/random/comic/';


        // fetching contents of xkcd url
        $site_html=  file_get_contents($url);
        $matches=null;
        // Matching the meta tags of the page to get the required contents
        preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i',     $site_html,$matches);

        // Storing it in an array
        $ogtags=array();
        $matchCount = count($matches[1]);
        for($i=0; $i< $matchCount; $i++)
        {
            $ogtags[$matches[1][$i]]=$matches[2][$i];
        }

        // The url of the random comic sanitizing to remove illegal characters
        $urlNumber = filter_var($ogtags['og:url'],FILTER_SANITIZE_NUMBER_INT);

        // The opengrah meta tag of comic in the current page
        $imgURL = $ogtags['og:img'];

        // The json url

        $json = $isSecure.'://xkcd.com/'.$urlNumber.'/info.0.json';


        // Collecting the json content
        $output = file_get_contents($json);

        // Decoding json content
        $jsonData = json_decode($output);

        // Geting the image url from the json data
        $img = $jsonData->img;

        // Sanitizing imageURL to remove extra spaces
        $imgFile = filter_var ( $img, FILTER_SANITIZE_STRING);
        // Storing the image in a varibale
        $imgLink = file_get_contents($imgFile);

        // Getting the title of the image from json data
        $fetchname = $jsonData->title;

        // Sanitizing name
        $namee = filter_var ( $fetchname, FILTER_SANITIZE_STRING); 
        $name = $namee.'.png';

        // Initializing the mail object
        $mail = new PHPMailer(true);

        if(isset($_GET['email'])){
            $email = $_GET['email'];
        }

        // Mail body
        $mailBody = "<img src=\"$img\"/>".'<br>Can\'t see the image?'."<a href=\"$img\">click here</a>".'<br><br>';
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'userEmail';                     //SMTP username
            $mail->Password   = 'Userpassword';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('SenderEmail', 'Mailer');
            $mail->addAddress($email, 'XKCD USER');     //Add a recipient

            //Attachments
            $mail->addStringAttachment($imgLink, $name);    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Welcome To XKCD COMICS WORLD';
            $mail->Body    = $mailBody;
            $mail->AltBody = "Click on this link to view your random comic image $imgURL";


            if($mail->send()){
                $_SESSION['mailSent'] = 'Hurray! Activated';
                ?>
                    <script>
                        alert("HURRAY! ACTIVATED");
                        location.replace('homepage.php');

                    </script>
                <?php
            }
        } catch (Exception $e) {
            $_SESSION['mailSent'] = "Mailer Error: {$mail->ErrorInfo}";
            ?>

                <script>
                    location.replace('homepage.php');
                </script>
            <?php
        }

    ?>

</body>
</html>