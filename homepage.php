<?php

    // Starting Session.
    session_start();
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XKCD COMICS</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/dropdown.css">

    
    <?php

        // If the nickname is not set which means when there is an issue finding the nickname 
        // User is redirected to login page

        if(!isset($_SESSION['nickname'])){
            
             ?>
                    <script>

                        location.replace('login.php');

                    </script>
            <?php
            
        }

        // If Error happens with the email if it is not stored in $_SESSION['email] it will redirect to login page.
        if (!isset($_SESSION['email']) || $_SESSION['email'] == ''){
            ?>

                <script>

                    location.replace('login.php');
                
                </script>

            <?php
        }
        else{
            $email = $_SESSION['email'];
        }

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
    <script>
        
        // This function is for responsive menu button only opens when a certain viewport is hit
        function openNav() {
        document.getElementById('myNav').style.width = '50%';
        }

        // Close the opened menu bar
        function closeNav() {
        document.getElementById('myNav').style.width = '0%';
        }


    </script>
</head>
<body>

    <nav>
    
        <!-- Nav bar for higher viewports like from 1200px -->
            <a href='#home'>HOME</a>
            <a href='#activate'>ACTIVATE</a>
            <a href='#images'>IMAGES</a>
            <a href='feedback.php'>FEEDBACK</a>
            <a href='logout.php' >LOGOUT</a>
    </nav>

        <!-- The menu bar for lower viewports below 800px -->
    <span style='font-size:30px;cursor:pointer' class='openbtn' onclick='openNav();'>&#9776; </span>
    <div class='navv'>
        <div id='myNav' class='overlay'>
            <a href='javascript:void(0)' class='closebtn' onclick='closeNav();'>&times;</a>
            <div class="overlay-content">
                <a onclick='closeNav();' href='#home'>HOME</a>
                <a onclick='closeNav();' href='#activate'>ACTIVATE</a>
                <a onclick='closeNav();' href='#images'>IMAGES</a>
                <a onclick='closeNav();' href='feedback.php'>FEEDBACK</a>
                <a onclick='closeNav();' href='logout.php'>LOGOUT</a>
            </div>
        </div>
    </div>

    <!-- The first block where user name and an image is shown -->
    <div class='intro' id= 'home'>
        <div class='greeting' >
        <h3 >hey</h3><h3><?php echo $_SESSION['nickname']; ?>!</h3>
        </div>
        <img class ='image' src='https://lh3.googleusercontent.com/nPtsQyYPHayiy1WeuheaGDz_ewIMwBMDnePxJsyR2xUEQ4Vz8lQJe9_WzD-iI2V_FYoTck1vwWc0Xm5povRklfO5U3Ib80vHYRp7wYwIJ9HwkCAEfucE8fMjylTTKF3sj8SuMljMKs8=w2400' alt='A waving square'>
    </div><br>

    
    <!-- The 2nd block where user can subscribe to the mailing list -->
    <h2 class='heading' id='activate'>ACTIVATION</h2><br>
    <div class='uploadd'>
        <?php

            
            $href = $isSecure.'://'.$httpHost.'/subscribe.php?token='.$token; 

        ?>
    
        <p class='activate'>Do you want ot receive mails from us? <br>
            <a class='anchor' href=<?php echo $href; ?>>activate</a>
            <span id='mailSent'>
                <?php

                    if(isset($_SESSION['mailSent'])){
                        echo $_SESSION['mailSent'];
                    }
                    
                ?>
            </span>
        </p>
        <img class='imgClass' src='https://lh3.googleusercontent.com/OQa9ZCe6CA6xlf2ljmVc9ugoUihVGjwpvioXb9UyzzSHlXlw72sAL76Jt0-y1d5Ij9Q0d0oUKmN-qp7CIWxeEa6M3vnzPomBSU2DK6UdUW9XppexKYi_tAcu6cBV8K8qqDo5fqeKA68=w2400' alt='minion image'>
    </div>

    
    <!-- The Sample images of  XKCD COMICS such that user can see them and if he likes them he'll subscribe-->
    <div class='container'>
        <h2 class= 'heading second' id='images'>IMAGES</h2>

            <?php
            
                // if There exists images with the email matching that are stored in $emailcount. if >0 images are fetched and displayed

                    ?>
                    <div class='videoo' id='images'>
                           <img class='image2' src='https://lh3.googleusercontent.com/elsO--qPkOhkxV31sSgcyBknd_eGK6__QA4XOKAWHB5mvCQTyxMfXuYXH_YU8L8SPsf6VY-gUSKGVjpnYwe_HU_Y9XkKV4RDQ4ntX65Et1tmOn_0S30-xV3be3IPxz-2Z5RYbHLTWTE=w2400' alt='delicious'>
                           <img class='image2' src='https://lh3.googleusercontent.com/vG5xmgq7wDiudKbkWjAj76ym6FjH-s0lEch12nHTvxkRSTE5Q3NuaDRlOdxNudCgIE3RpsLQm7okQ-PPM5WEqZiBhTsQCdCz5YbXY3dfWNZXqjE9mJ8Lv-rqPbukCEyGrAYoKsTOKKc=w2400' alt='knights'>
                           <img class='image2' src='https://lh3.googleusercontent.com/6VrMDAgZSeMvjAy8r0Uub5qmwxkfhJJuXQ3uojYgLTN4_egzIkAi3inKUPVMOV2os36IjeWvsvMmlXXhQ5pQ6-ImIzXvA7LxblB5aQvb7ZWcMeukWG_toSEdWb-nKMI3hK1Q7gCz1lc=w2400' alt='indirect_detention'>
                           <img class='image2' src='https://lh3.googleusercontent.com/UzoPgvNsZp1UHuuSVL9NvHORoy9Ek5pbS6HffCrSPIozXcI0jCGHsW_WKrJPYjLOHuNFFlaD-oNkqOFpvQ55HL4qw70MdnamTxFgnvIAVAyfXHZkK67yA3w9t4pFpPb_l4-QlNkzZgA=w2400' alt='reset'>
                           <img class='image2' src='https://lh3.googleusercontent.com/fngPbK3irz8CDR0-LxxmEwgT4Y19kvUpAD4dXYju5zQcB6wRSkSPD6jVXGWQD3WUx5i9UtTnj0o8salueIq9kc1F6x1OXIQE0upS_1Lax5ugI_RIpQT0mAORjhRC3Uf54f0K1JINbNs=w2400' alt='fixing_problems'>
                           <img class='image2' src='https://lh3.googleusercontent.com/P__3oali7vjfQa-ryqf2c7hmsOL8cnjT682yEThnjXewzpxbAC1zgud4pf3gdrJrkMScJkxqm_BrRvAGVGN74Voq1x6QmHGpbfVfSzb-c5--XfEAujzPK3AKlCZQRBTetN8aovMtUo0=w2400' alt='string_theory'>
                           <img class='image2' src='https://lh3.googleusercontent.com/bTN0mUcePTRPPw2fauQ1r4QbmKQ8pGogZ6S4gaGHgiOsCVtcp_VyVyDTPlrrdPLc1njNA_2MEWCf6i5-j8iu3IjDw1ErImOQHgyz2bAlFqHfqKhF0gdHEAdb5aHe7b2_GWBmAmuNeiA=w2400' alt='floor'>
                           <img class='image2' src='https://lh3.googleusercontent.com/pI_y9pNnC5TOLwIJtOUXv5zPLVIrk-x-dYiCRZIX2ljCvQcsAyd5PV1tUfNAv7ICvByw-3c0rq2mjhHv02479G6MxSUefbDGTrf2ngpXSs86x0GE3_c1MsFPOWMQmc72k44fFkvaavM=w2400' alt='perspective'>
                    </div>
    
    </div>

    <!-- The fourth feedback section where user is redirected to their mail inbox with my mail-id as to addresss.  -->

    <div class='top' id='feedback'>
    <p><a href='mailto:shulomithi07@gmail.com'>FEEDBACK</a></p>
    </div>
</body>
</html>