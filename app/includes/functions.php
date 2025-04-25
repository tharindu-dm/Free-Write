<?php
//contains common functions 

//testing
function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function splitURL()
{
    $URL = $_GET['url'] ?? 'Home';
    $URL = explode('/', $URL);
    return $URL;
}

function splitCamelCase($text)
{
    return preg_split('/(?=[A-Z])/', $text);
}


function getUnreadNotifications($uid)
{
    $notification_user = new UserNotification();
    $unread = $notification_user->getUnreadUserNotifications($uid);

    return $unread;
}