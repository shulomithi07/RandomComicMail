<?php

require_once __DIR__.'EasycronApi.php';

// Please replace below token with your token
$easyApi = new EasycronApi('The token from the EasycronApi');

$return = $easyApi->call('timezone');

$return = $easyApi->call('enable', array('id' => 3079278));


?>