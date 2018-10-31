<?php
session_start();

if (isset($_POST['test']) == false) {
    http_response_code(404);
    echo "Выберите сначала соответствующие тесты!!!!";
    echo '<a href=\'list.php\'><h2>Выбреть тест</h2></a>';
    exit;
}

if (!empty($_SESSION['name'])) {
    $name = $_SESSION['name'];
} elseif (!empty($_SESSION['guest'])) {
    $name = $_SESSION['guest'];
} else {
    $name = 'not found';
}

$file = $_POST['test'];
$json = file_get_contents(__DIR__ . '/' . $file);
$data = json_decode($json, true);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST</title>
</head>
<body>
    <nav>
        <a href="list.php">LIST</a>
    </nav>

    <h2>Дайте ответы на вопроссы</h2>
    <form action="test.php" method="post">
        <input type="hidden" name="test" value="<?php echo $file ?>"><br>

        <?php for ($i = 0; $i < count($data); $i++): ?>
            <p><?php echo $data[$i]['number'] . ') ' . $data[$i]['question'] ?></p>

            <?php foreach ($data[$i]['variants'] as $k => $v) : ?>
                <input type="radio" name="<?php echo $data[$i]['number'] ?>" value="<?php echo $v ?>">
                <?php echo $v ?><br>
            <?php endforeach; ?>
            <br>
        <?php endfor; ?>

        <button type="submit" name="check">Проверить</button>
    </form>

    <?php
        if(isset($_POST['check'])) {
            $v = 1;
            $mark = 0;

            echo '<h2>';
            echo $name;
            echo '</h2><p>';
            for ($i = 0; $i < count($data); $i++) {
                $num_answer = $data[$i]['number'];
                $answer = $data[$i]['answer'];
                if (isset($_POST[$v]) == null) {
                    echo "$num_answer) ОТВЕТ НЕ ВЫБРАН!!!!<br>";
                } else if ($_POST[$v] == $answer) {
                    echo "$num_answer) Правильно, ответ = $answer <br>";
                    $mark++;
                } else {
                    echo "$num_answer) Не правильно!<br>";
                }
                $v++;
            }
            echo "</p><p>Оценка: $mark</p>";


            $conclusion = strval($name . "! Your mark is: " . $mark);

            echo "
            <form action='certificate.php' method='post'>
                <input type='text' name='conclusion' value='$conclusion' hidden>
                <input type='submit' name='submit' value='Получить сертификат'>
            </form>
            ";
        };
    ?>

</body>
</html>
