<?php

    // To destroy session first a session should be there.
    session_start();

    // Destroying session of the user
    session_destroy();

    // redirecting to login page
    ?>
        <script>

            location.replace('login.php');

        </script>