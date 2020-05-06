<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <form action=img.php method=post enctype=multipart/form-data>
    <div class="custom-file">
      <input type="file"  name=uploadfile class="custom-file-input">
      <label class="custom-file-label">Выберите обложку для списка желаний</label>
    </div>
    <!-- <input type=file name=uploadfile> -->
    <!-- <input type=submit name="uploadMyFile" value=Загрузить></form> -->
    <button class="btn btn-success  btn-block" type="submit" name="createWishList">Создать список желаний</button>

  </body>
  </html>
  <?php
  require_once('dependence.php');

  if (isset($_POST['createWishList']))
  {
    $uploaddir = 'images/';
    $uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
    echo "<br>";
    echo $uploadfile;
    echo "<br>";
    $fileNameRandom = mt_rand(0, 100000).$_FILES['uploadfile']['name'];
    $filePath= $uploaddir.$fileNameRandom;

    // Копируем файл из каталога для временного хранения файлов:
    if (!copy($_FILES['uploadfile']['tmp_name'], $fileNameRandom))
    {
      echo 'Не удалось загрузить файл на сервер';
    }
    else
    {
      //   $fileNameRandom = mt_rand(0, 100000).$_FILES['uploadfile']['name'];
      //   $filePath= $uploaddir.$fileNameRandom;

      echo $filePath;
      $wishlist = R::dispense('newwishlists');//автоматическое создание таблицы пользователей
      //автоинкремент автоматически создается

      $wishlist->wishlist_img_path=$filePath;
      R::store($wishlist);
      echo "<br>загрузили в БД";
      unset($_POST['uploadMyFile']);

    }
  }
  // Каталог, в который мы будем принимать файл:

  ?>


  <script type="text/javascript">

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
  </script>
