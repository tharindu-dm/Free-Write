<?php
isset($_SESSION['user_type']) ? $userType = $_SESSION['user_type'] : $userType = 'guest';

switch ($userType) {
    case 'admin':
    case 'writer':
    case 'covdes':
    case 'wricov':
    case 'reader':
        require_once "../app/views/layout/header-user.php";
        break;
    case 'pub':
        require_once "../app/views/layout/header-pub.php";
        break;
    case 'courier':
        require_once "../app/views/layout/header-courier.php";
        break;
    default:
        require_once "../app/views/layout/header.php";
}