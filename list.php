<?php

session_start();
if (empty($_SESSION)) {
    http_response_code(403);
    echo '<h1>Ошибка 403!!!!<br>Пройдите сначало авторизацию или зайдите как гость!!!</h1>';
    echo '<a href=\'index.php\'><h2>авторизоваться</h2></a>';
    exit();
}
$file_list = glob('test/*.json');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List</title>
</head>
<body>
    <nav>
<?php
    if (!empty($_SESSION['name'])) {
        echo '<a href="admin.php">ADMIN</a> |';
    }
?>
        <a href="logout.php">LOGOUT</a>
    </nav>

    <form method="post" action="test.php">
        <h3>Выберите теста для прохождения:</h3>
        <?php
        $c = 1;
        foreach ($file_list as $key => $file) : ?>
            <label>
                <input type="radio" name="test" value="<?php echo $file; ?>" required>Test <?php echo $c ?>
            </label>
            <?php
                if (!empty($_SESSION['name'])) {
                    echo "<a onclick='if(!confirm(\"Вы действительно хотите удалить?\")) {return false}' href='delete.php?file=$file'>Delete</a>";
                }
            ?>
            <br>
            <?php $c++; ?>
        <?php endforeach; ?>
        <input type="submit" value="Пройти тест">
    </form>
</body>
</html>