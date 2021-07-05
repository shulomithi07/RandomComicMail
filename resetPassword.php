<?php


    session_start();
    // Including connection and validation script password validation
    require_once __DIR__.'config.php';
    require_once __DIR__.'scripts\validation.php';
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resetPassword</title>
    <style>
    
    /* image and its alignment */
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

    /* The whole container */
    .container{
        
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

    /* The image width  */
    .image{
        width:30vw;
        height:50vh;
    }

    /* The password div */
    .right{
        background: rgba( 102, 252, 241, 0.30 );
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

    /* Password input tags */
    input{
        
        background-color:#000;
        width:30vw;
        height:5vh;
        border-radius:2vw;
        outline:none;
        color:white;
        font-size:2vh;
    }

    /* The know your password link */
    a{
        color:#fff;
        text-decoration:none;
    }

    /* Input password placeholder */
    ::placeholder{
        color:#fff;
        font-size:2vh;
    }

    /* Submit button */
    input[type=submit]{
        color:#fff;
        width:10vw;
        font-size:2.5vh;
    }

    /* Know your password link */
    .know{
        font-size:1.2vw;
    }

    /* Know your password link on hover */
    .know:hover{
        text-shadow: 0px 0px 0.5px #fff, 
               0px 0px  5px #fff;

    }

    /* responsive know your password link for required areas */
    .hide{
        display:none;
    }

    /* For smaller devices */
    @media only screen and (max-width: 1000px) {
        
        /* THe tranparent box  */
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
            flex-direction:column;  
            color:white;

        }
        /* The image */
        .left{
            display:flex;
            justify-content:center;
            flex-direction:column;
            align-items:center;
        }

        /* The image class */
        .image{
            width:60vw;
            height:30vh;
        }


        /* Know your password link */
        .know{
            display:none;
        }

        /* The know your password for responsive pages */
        .hide{
            display:block;
        }

        /* Know your password on hover for mobile or tablets */
        .hide:hover{
            text-shadow: 0px 0px 0.5px #fff, 
               0px 0px  5px #fff;
        }

        /* The form div */
        .right{
            width:70vw;
            height:40vh;
            
        }


        /* The heading font size */
        .title{
            font-size:1.5vw;
        }


        /* The form tag for proper alignment */
        form{
            display:flex;
            justify-content:center;
            gap:1rem;
        }

        /* THe design of the input tags */
        input{
        
            background-color:#000;
            width:60vw;
            height:4vh;
            border-radius:2vw;
            outline:none;
            color:white;
            font-size:2vh;
        }

        /* The submit button design */
        input[type=submit]{
        color:#fff;
        width:60vw;
        font-size:2.5vh;
        }



    }   


    
    </style>
</head>
<body>
    
    <!-- The main container -->
    <div class="container">
        <!-- The image container -->
        <div class="left">
        
        <img class="image" src="https://lh3.googleusercontent.com/2Bvtx7N4oK9nM9jnlCfDqQktuvs0dRr3pP30g0M4sFStX2NNNShx5GjhaA4AAPW4ttwm9dD-Q5ZLSwSsSTxhpl5n7O8S2JpVOKoZ9yTXijyBmnAftnMtJqnALlNmG-PiVlGNZtTuunc=w2400" alt="Toy car image">
        <a class="hide" href="https://xkcd-mail.herokuapp.com/login.php">Know your password?</a>
        </div>

        <!-- The form container -->
        <div class="right">
            <h3 id='title'>Make Sure you remenber know :)</h3>
            <form  method="post">
            
            <input class="textfield" type="password" name="password" id="password" onkeyup='check();' placeholder="create new password" required>
            <input  class="textfield" type="password" name="confirm_password" id="confirm_password" placeholder="confirm password" onkeyup='check();' required>
            <span id='message'></span>
            <input type="submit" name="submit" value="submit">
            
            </form>
            <a class="know" href="https://xkcd-mail.herokuapp.com/login.php">Know your password?</a>
        </div>
    </div>
    <script>


</script>

</body>
</html>

<?php

    // Taking the token from the URL
    if(isset($_GET['token'])){

        $token = $_GET['token'];

    }

    // If the submit button is clicked
    if(isset($_POST['submit'])){

        if(isset($_POST['password'])){
            $password = $_POST['password'];
        }
        // Encrypting the password
        $password_encrypt = password_hash($password,PASSWORD_BCRYPT);

        // The query to update the database

        $stmt = $db->prepare('update users set password = ? where token = ?');
        $stmt->bind_param('ss',$password_encrypt,$token);
        $dbquery = $stmt->execute();


        // If query executed it'l redirect to login page with session message as below
        if($dbquery){

            if(isset($_SESSION['msg'])){
                $_SESSION['msg'] = 'Your password is reset Please login!';
                ?>

                    <script>
                    
                        location.replace('login.php');
                    
                    </script>

                <?php
            }
            // If session message is not set the session message will be this
            else{
                $_SESSION['msg'] = 'You\'re logged out!';
                ?>

                    <script>
                    
                        location.replace('login.php');
                    
                    </script>

                <?php
            }
        // If query didn't execute this message will be shown in the reset password page
        }
        else{
            $_SESSION['msg'] = 'Something happened please try again!';
            ?>

                <meta http-equiv="refresh" content="1">

            <?php
        }


    }

?>
