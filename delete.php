<?php
session_start();

if (empty($_SESSION['name'])) {
    http_response_code(403);
    echo '<h1>Ошибка 403!!!!<br>Пройдите сначало авторизацию!!!</h1>';
    echo '<a href=\'index.php\'><h2>авторизоваться</h2></a>';
    exit();
}

if(!empty($_GET['file'])) {
    $file = $_GET['file'];
    unlink($file);
    header('Location: list.php');
}
