<?php
session_start();

if (empty($_SESSION['name'])) {
    http_response_code(403);
    echo '<h1>Ошибка 403!!!!<br>Пройдите сначало авторизацию!!!</h1>';
    echo '<a href=\'index.php\'><h2>авторизоваться</h2></a>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>admin</title>
</head>
<body>
    <nav>
        <a href="list.php">LIST</a>
    </nav>

  <form action="" method="post" enctype="multipart/form-data">
    Select json test to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload json" name="submit">
  </form>

  <?php
  // Check if json file is a actual json or fake json
  if(!empty($_POST["submit"])) {
      $target_dir = "test/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if($fileType === "json") {
          echo '<p>File is an json</p>';
          $uploadOk = 1;
      } else {
          echo '<p>File is not an json.</p>';
          $uploadOk = 0;
      }

      // Check if file already exists
      if (file_exists($target_file)) {
          echo '<p>Sorry, file already exists.</p>';
          $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo '<p>Sorry, your file was not uploaded.</p>';
          // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

//              делаю редирект на список тестов, нижний текст не сработает
              header('Location: list.php');

              echo '<p>The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.</p>';
          } else {
              echo '<p>Sorry, there was an error uploading your file.</p>';
          }
      }
  }

  ?>

</body>
</html>

