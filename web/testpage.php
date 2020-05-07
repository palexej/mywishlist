<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  grffvygbhnjmk nkm
</body>
</html>
<?php require_once('dependence.php')
$user = R::dispense('users');//автоматическое создание таблицы пользователей
//автоинкремент автоматически создается
$user->surname = "alexeyyyy";
R::store($user);



?>
