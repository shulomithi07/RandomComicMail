<?php

session_start();

require_once __DIR__.'config.php';


// Gets the token from the url which was sent from the signup page at the time of signup
if(isset($_GET['token'])){

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
    

    $token = $_GET['token'];

    $stmt = $db->prepare('select * from users where subscribed = ? where token = ?');
    $stmt->bind_param('ss','yes',$token);
    $row = $stmt->execute();

    if($row){

        $_SESSION['mailSent'] = 'You are already subscribed!';
        ?>
            <script>
                location.replace('homepage.php');
            </script>
        <?php
    }
    else{


        $stmt = $db->prepare('update users set subscribed = ? where token = ?');
        $stmt->bind_param('ss','yes',$token);
        $dbquery = $stmt->execute();

        // If the query executed 
        if($dbquery){
            
            ?>
            
                <script>
                window.location.replace('<?php echo $isSecure; ?>://<?php echo $httpHost; ?>/firstMail.php?email=<?php echo $email; ?>');
                
                </script>
            <?php
        }
        // If query didn't execute
        else{
            $_SESSION['mailSent'] = 'Something happened please try again!';

            ?>
            <script>
             location.replace('homepage.php');
             </script>
            <?php
        }
    }
    
}

?>