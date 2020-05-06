<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>

<?php
require_once('dependence.php');

$editWishListId=185;

//автоинкремент автоматически создается
$editOnewishlist = R::load('wishs', $editWishListId);

$myImg=$editOnewishlist->wishlist_img_path;

echo '
<div class="card border-dark text-center" style="  display: inline-block">

<img class="card-img-top  w-50 h-50 p-3" src='.$myImg .' alt= >

<div class="card-header"><b>Название желания:</b> </div>

<ul class="list-group list-group-flush">
<li class="list-group-item"><b>Информация:</b></li>
<li class="list-group-item"><b>Цена:</b></li>
<li class="list-group-item"><b>Ссылка:</b> <a href= target="_blank"></a></li>
</ul>


<div class="card-footer bg-transparent ">
<button class="btn btn-outline-primary btn-block" data-toggle="tooltip" data-placement="right" title="Редактировать желание:  type="submit" name="editMyWish" value=  ><i class="fa fa-fw fa-list-ol"></i><i class="fa fa-fw fa-edit"></i></button>
<button class="btn btn-outline-danger btn-block" type="submit" data-toggle="tooltip" data-placement="right" title="Удалить желание:  name="deleteMyWish" value= ><i class="fa fa-fw fa-list-ol"></i><i class="fa fa-fw fa-trash-alt"></i></button>
</div>
</div>
<br>

<br>
</ul>
</div>
';


?>
