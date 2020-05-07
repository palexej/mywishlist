<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
	<meta charset="utf-8">

	<?php require_once 'dependence.php' ?>
	<title>Войти</title>
</head>


<style>
body {
	background: url(images-background/loginImg.jpg) no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
.loginForm {
	background: #ffb6c1; /* Цвет фона */
	color: #fff; /* Цвет текста */
	padding: 10px; /* Поля вокруг текста */
	border-radius: 5px; /* Уголки */
}
</style>
<body >
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#">awishlist</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="cataloge ">Каталог</a>
				</li>
			</ul>
			<ul class="navbar-nav ">
				<li class="nav-item">
					<a class="nav-link" href="https://awishlist.herokuapp.com/signup.php">
						<i class="fa fa-fw fa-user-plus"></i>
						Регистрация
					</a>
				</li>
			</ul>
			<ul class="navbar-nav ">
				<li class="nav-item">
					<a class="nav-link" href="https://awishlist.herokuapp.com/login.php">
						<i class="fa fa-fw fa-sign-in-alt"></i>
						Авторизация
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<?php
$data = $_POST;
if ( isset($data['do_login']) )
{
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ($user)
	{
		//логин существует
		if ( password_verify($data['password'], $user->password) )//обратная дешифровка
		{
			$_SESSION['logged_user'] = $user;//если пароль совпадает, то нужно авторизовать пользователя
			header('Location: https://awishlist.herokuapp.com/upload.php ');
		}
		else
		{
			$errors[] = 'Неверно введен пароль!';
		}

	}else
	{
		$errors[] = 'Пользователь с таким логином не найден!';
	}

	if (!empty($errors))
	{
		//выводим ошибки авторизации
		echo '
		<div class="alert alert-danger col-md-6 offset-md-3 alert-dismissible fade show" role="alert" text-center id="errors ">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4 class="alert-heading">Ошибка авторизации!</h4>
		<p>'.array_shift($errors).'</p>
		</div>
		';
	}
}

?>

<br>
<div class="row">
	<div class="col-md-4 offset-md-4 text-center  text-center loginForm">
		<h2>Вход</h2>
		<form action="https://awishlist.herokuapp.com/login.php" method="POST">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text bg-white"><i class="fa fa-user"></i></span>
				</div>
				<input type="text" name="login" class="form-control" placeholder="Введите логин" value="<?php echo @$data['login']; ?>"><br/>
			</div>
			<br>
			<div class="input-group rounded ">
				<div class="input-group-prepend">
					<span class="input-group-text bg-white"><i class="fa fa-key"></i></span>
				</div>
				<input type="password" name="password" class="form-control" placeholder="Введите пароль" value="<?php echo @$data['password']; ?>"><br/>
			</div>
			<br>
			<button class="btn btn-warning btn-block" type="submit" name="do_login">Войти</button>
		</form>
	</div>

</div>

</form>
</body>
</html>
