<?php
isset($_SESSION['user_type']) ? $userType = $_SESSION['user_type'] : $userType = 'guest';

switch ($userType) {
    case 'admin':
    case 'mod':
    case 'writer':
    case 'covdes':
    case 'wricov':
    case 'reader':
        require_once "../app/views/layout/header-user.php";
        break;
    case "inst":
        require_once "../app/views/layout/header-inst.php";
        break;
    case 'pub':
        require_once "../app/views/layout/header-pub.php";
        break;
    default:
        require_once "../app/views/layout/header.php";
}