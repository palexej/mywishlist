<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  новый текст уже тут11111
  <form  action="https://awishlist.herokuapp.com/testpage.php" method="post">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text bg-white"><i class="fa fa-info"></i></span>
      </div>
      <input type="text" name="password" class="form-control" placeholder="Введите password" value="<?php echo @$data['password']; ?>"><br/>
    </div>
    <button type="submit" name="click">click</button>
  </form>
</body>
</html>
<?php
require_once('dependence.php');
R::freeze(true);
if (isset($_POST['click'])) {

  $user = R::load('users',5);//автоматическое создание таблицы пользователей

}




?>
