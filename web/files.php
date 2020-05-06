
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Загрузка изображений на сервер</title>

  <?php require_once 'dependence.php' ?>

</head>
<body>
  <form method="post" action="files.php" enctype="multipart/form-data">
    <div class="custom-file">
      <input type="file"  name=file class="custom-file-input">
      <label class="custom-file-label">Выберите обложку для списка желаний</label>
    </div>
    <!-- <input type="file" name="file"> -->
    <!-- <input type="submit" value="Загрузить файл!"> -->
    <button class="btn btn-success  btn-block" type="submit" name="createWishList">Создать список желаний</button>
  </form>
  <?php
  // если была произведена отправка формы

  if(isset($_FILES['file']))
  {
    if($_FILES['file']['size']==0)
    {
      echo "string";
    }

    else
    {
      if ($_FILES['file']['size']/1024>2048)
      {
        echo 'Размер загружаемого файла больше 2  МБ';
      }
      else {
        echo "<br>ok";
      }

      $check = can_upload($_FILES['file']);
      if($check === true){
        // загружаем изображение на сервер
        make_upload($_FILES['file']);
        echo "<strong>Файл успешно загружен!</strong>";
      }
      else
      {
        // выводим сообщение об ошибке
        echo "<strong>$check</strong>";
      }
    }

  }





  ?>
</body>
</html>

<?php
function can_upload($file){
  // если имя пустое, значит файл не выбран
  /* если размер файла 0, значит его не пропустили настройки
  сервера из-за того, что он слишком большой */


  // разбиваем имя файла по точке и получаем массив
  $getMime = explode('.', $file['name']);
  // нас интересует последний элемент массива - расширение
  $mime = strtolower(end($getMime));
  // объявим массив допустимых расширений
  $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

  // если расширение не входит в список допустимых - return
  if(!in_array($mime, $types))
  return 'Недопустимый тип файла.';

  return true;
}

function make_upload($file){

  // $fileNameRandom = mt_rand(0, 100000).$_FILES['uploadfile']['name'];
  // $filePath= $uploaddir.$fileNameRandom;
  // формируем уникальное имя картинки: случайное число и name
  $name = mt_rand(0, 10000) . $file['name'];
  $myFile='images/' .$name;
  copy($file['tmp_name'], $myFile);

  $wish_id=39;
  $wish = R::load('wishs',$wish_id);//автоматическое создание таблицы пользователей
  //автоинкремент автоматически создается

  $wish->wish_img_path=$myFile;
  R::store($wish);
  echo "<br>поменяли в БД";
  unset($_POST['uploadMyFile']);
}
?>

<script type="text/javascript">

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
