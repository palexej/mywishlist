
текст
<?php

require_once('dependence.php')

$upload_image=$_FILES[" myimage "]["name"];

$folder="../img/";

move_uploaded_file($_FILES[" myimage "][" tmp_name "],"$folder".$_FILES[" myimage "][" name "]);

$wishlist = R::load('newwishlists');//автоматическое создание таблицы пользователей
//автоинкремент автоматически создается

$wishlist->wishlist_img_path = $upload_image['wishlistsImgPath'];
//	$_SESSION['logged_user'] = $user_login;
// TODO:5345

//сделать генерацию ссылку на картинку
// обеспечить генерацию ссылки
R::store($wishlist);
?>
