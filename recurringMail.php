<?php

    require_once __DIR__.'config.php';
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require_once __DIR__.'lib/vendor/autoload.php';

    $query = "SELECT email FROM users WHERE subscribed='yes' ";

    $execute = mysqli_query($conn,$query);

    $resultSet = mysqli_num_rows($execute);

    $stmt = $db->prepare('SELECT email FROM users WHERE subscribed = ?');
    $stmt->bind_param('s','yes');
    $resultSet = $stmt->execute();

    if($resultSet){

        $emailArray = array();
        foreach($resultSet as $row){
            
            $email = $row['email'];
            
            array_push($emailArray,$email);
        }
    }

    // Setting the URL
    $url='https://c.xkcd.com/random/comic/';
    
    // Collevcting all the sites content
    $site_html=  file_get_contents($url);
    $matches=null;

    // Collecting all the sites metadata with opengraphs
    preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i',     $site_html,$matches);
    $ogtags=array();
    $matchesCount = count($matches[1]);

    // Looping them and storing them in a array
    for($i=0; $i<$matchesCount; $i++)
    {
        $ogtags[$matches[1][$i]]=$matches[2][$i];
    }

    // THe urlcollected from the metatags and sanitizing it to get number.
    $urlNumber = filter_var($ogtags['og:url'],FILTER_SANITIZE_NUMBER_INT);

    // THe imageURL from metatags
    $imgURL = $ogtags['og:img'];

    // The  url of json file of that particular url number.
    $json = 'https://xkcd.com/'.$urlNumber.'/info.0.json';

    
    // Collecting json data
    $output = file_get_contents($json);

    // decoding jsons data
    $jsonData = json_decode($output);

    // image url from json data
    $img = $jsonData->img;

    // The alternative text message of the image which is going to be displayed in mail
    $alt= $jsonData->alt;
    // THe img url is sanitized to remove spaces
    $imgFile = filter_var ( $img, FILTER_SANITIZE_STRING);

    // Storing the image data
    $imgLink = file_get_contents($imgFile);

    // Title of the image is fetched
    $fetchname = $jsonData->title;
    // Sanatizing it to remove spaces
    $namee = filter_var ( $fetchname, FILTER_SANITIZE_STRING); 
      
    $name = $namee.'png';

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

    
    // Initializing mail object 
    $mail = new PHPMailer(true);

    $mailBody = '<!DOCTYPE html>
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
                #img{
                    width:30vw;
                    height:20vh;
                }
    
                .btn{
    
                    width:20vw;
                    height:6vh;
                    background-color: rgb(138, 163, 209);
                    color:white;
                    display:flex;
                    justify-content: center;
                    align-items: center;
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
                background-color:#f06760;
                color:black;
                width:25vw;
                height:4vh;
                border-radius:40px;
                font-size:0.5vw;
    
            }
    
    
        </style>
    </head>
    <body>
        
        <div class="container">'.
            "<p>$alt</p>".
            '<hr>'.
            "<img src=\"$img\"/><br>Can't see the image?"."<a href=\"$img\">click here</a><br><br>;
            
        </div>";
    
    // Users in the database
    $countEmail = count($emailArray);

    $fetchDataContents = file_get_contents('fetchData.txt');
    date_default_timezone_set("Asia/kolkata");
    $currentTime = strftime("%X", time());
    $dateTimeObject1 = date_create($currentTime); 
    $dateTimeObject2 = date_create($fetchDataContents); 
    
    $difference = date_diff($dateTimeObject1, $dateTimeObject2); 
    
    $minutes = $difference->days * 24 * 60;
    $minutes += $difference->h * 60;
    $minutes += $difference->i;
    
    if($minutes>5){

        for ($i=0; $i < $countEmail ; $i++) { 
            
            $recepient = $emailArray[$i];

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'UserName';                     //SMTP username
                $mail->Password   = 'Password';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('SenderName', 'XKCD Email');
                $mail->addAddress($recepient, 'XKCD USER');     //Add a recipient

                //Attachments
                $mail->addStringAttachment($imgLink, $name);    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Welcome To XKCD COMICS WORLD';
                $mail->Body    = $mailBody;
                $mail->Body   .= "If you feel annoyed with our mails you are free to <a id='unsubscribe' href='$isSecure://$httpHost/unsubscribe.php?email=$recepient'>unsubcribe</a>"
                .' </body>
                </html>';
                $mail->AltBody = "Click on this link to view your random comic image $imgURL";

                $SentMail = $mail->send();

                if($SentMail){
                    $_SESSION['mailSent'] = 'Hurray! Activated';
                    $afterExecution = strftime("%X", time());
                    file_put_contents('fetchData.txt',$afterExecution);
                }

            } catch (Exception $e) {
                echo 'error to send mail';
            }
        }
    }
    else{
        echo 'Access Denied!';
    }
?>