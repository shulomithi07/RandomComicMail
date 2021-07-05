<?php

    session_start();

    require_once __DIR__.'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNSUBSCRIBE</title>
    <style>

        body{
            background-color:rgba(33,97,237,0.53);
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .container{
            
            margin:auto;
            margin-top:2vw;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            background-color:#c8d7de;
            width:80vw;
            height:40vh;
            border-radius:10px;
        }

        input[type=submit]{
            background-color:#77aec7;
            border-radius:10px;
            padding:1vw;
            font-size:1.2vw;
        }

        input[type=submit]:hover{
            background-color:#3e4447;
            color:#fff;
        }

        #btn{
            background-color:#000;
            border-radius:2px;
            padding:0.5vw;
            font-size:1.2vw;
            text-decoration:none;
            color:white;
        }

        #btn:hover{
            background-color:#3e4447;
            color:#fff;
        }

        a{
            text-decoration:none;
        }


        </style>
</head>
<body>
        <div class='container'>
            
            <h4>Click below to deactivate your recurring mails</h4><br>
            
            <form method='post'>
                <input type='submit' name='submit' value='deactivate'>
            </form>
            
<?php



// Gets the token from the url which was sent from the signup page at the time of signup
if(isset($_GET['token'])){

    $email = $_GET['token'];

}

if(isset($_POST['submit'])){

    $stmt = $db->prepare('update users set subscribed = ? where token = ?');
    $stmt->bind_param('ss','no',$token);
    $dbquery = $stmt->execute();


    // If the query executed 
    if($dbquery){
        ?>
            <script>
                
                alert('YOU OPTED NOT TO GET MAILS! :(');
                window.location.replace('login.php');
            </script>
        
        <?php
    }
    // If query didn't execute
    else{
         
         ?>
            <script>
                
                alert('Something happened please try again after sometime!');
                window.location.replace('login.php');
            </script>
        
        <?php
         
        }
    
}

?>

        </div>
    </body>
</html>
