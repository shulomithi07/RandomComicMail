<?php

session_start();

require_once __DIR__.'config.php';


// Gets the token from the url which was sent from the signup page at the time of signup
if(isset($_GET['token'])){

    $token = $_GET['token'];

    // Preparing query to bind parameters
    $stmt = $conn->prepare('update users set status = ? where token = ?');
    // Binding Parameters
    $stmt->bind_param('ss','active',$token);
    // Performing the query in the database
    $dbquery = $stmt->execute();

    // If the query executed 
    if($dbquery){
        // Session message is set if account is acctivated
            $_SESSION['msg'] = 'Your account is activated Login Here !';
            ?>
                <script>
                    location.replace('login.php');
                </script>
            <?php
        
    }
    // If query didn't execute
    else{
        $_SESSION['msg'] = 'Something happened please try again!';
        ?>
                <script>
                    location.replace('login.php');
                </script>
            <?php
    }
}

?>