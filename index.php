<?php
session_start();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if (!empty($_SESSION)) {
    echo '
        <nav>
            <a href="list.php">LIST</a> |
            <a href="logout.php">LOGOUT</a>
        </nav>
    ';
}
?>

<h2>Авторизоваться</h2>
<form action="" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="password" placeholder="Password">
    <input type="submit" name="submit" value="подтвердить">
</form>

<h2>Войти как гость</h2>
<form action="" method="post">
    <input type="text" name="guest" placeholder="Name">
    <input type="submit" name="submit" value="подтвердить">
</form>

</body>
</html>

<?php

if(!empty($_POST['name']) && !empty($_POST['password'])) {

    $json = file_get_contents(__DIR__ . '/users.json');
    $users = json_decode($json, true);

    foreach($users as $user) {
        if($user['name'] === $_POST['name'] && $user['password'] === $_POST['password']) {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['password'] = $_POST['password'];
            header('Location: list.php');
        }
    }
} elseif (!empty($_POST['guest'])) {
    $_SESSION['guest'] = $_POST['guest'];
    header('Location: list.php');
}

?>