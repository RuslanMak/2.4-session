<?php
if (isset($_POST['conclusion']) !== false) {
    header("Content-Type: image/png");
    $text = $_POST['conclusion'];
    $im = imagecreate(200, 30);
    $background_color = imagecolorallocate($im, 0, 0, 0);
    $text_color = imagecolorallocate($im, 255, 255, 255);
    imagestring($im, 2, 5, 5,  $text, $text_color);
    imagepng($im);
    imagedestroy($im);
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '<h1>Ошибка 404!!!!<br>Пройдите сначало тесты!!!</h1>';
    echo '<a href=\'list.php\'><h2>Go to list of tests</h2></a>';
}