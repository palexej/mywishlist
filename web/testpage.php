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
R::freeze(false);
if (isset($_POST['click'])) {

  $user = R::dispense('users');//автоматическое создание таблицы пользователей
  $user->surname =666;
  $user->name = 666;
  $user->middlename = 666;
  $user->login = 666;
  $user->email = 666;
  $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
  R::store($user);
}




?>
