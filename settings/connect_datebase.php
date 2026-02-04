<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'security');

function getClientIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]);
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
$user_ip = getClientIP();

// удаляем старые куки
setcookie("user_id", "", time() - 3600); 

// сохраняем в куки
setcookie("IP", $user_ip, [
    'expires' => time()+3600,
    'path'=>'/',
    'secure'=> true,
    'httponly'=>true
]);

setcookie("Datetime", date("Y-m-d H:i:s"), [
    'expires' => time()+3600,
    'path'=>'/',
    'secure'=> true,
    'httponly'=>true
]);

function checkUser() {
    if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != "" && $_COOKIE['user_id'] != "-1") {
        return $_COOKIE['user_id'];
    }
    return false;
}
?>