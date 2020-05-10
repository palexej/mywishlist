<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>

  <?php require_once('dependence.php'); ?>

  <style>
  body {
    background: url(images-background/infowishlist.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }
  .WishList {
    background: #87CEFA; /* Цвет фона */
    color: #fff; /* Цвет текста */
    padding: 10px; /* Поля вокруг текста */
    border-radius: 5px; /* Уголки */
  }

  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
      <?php if ( isset ($_SESSION['logged_user']) ) :
        ?>
        <ul class="navbar-nav  mx-md-n20">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <?php echo "Добро пожаловать, ". $_SESSION['logged_user']->login; ?>
              <i class="fa fa-fw fa-user"></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="upload ">
                <i class="fa fa-fw fa-list-alt"></i>
                Мои списки желаний
              </a>
              <a class="dropdown-item" href="userProfile ">
                <i class="fa fa-fw fa-address-card"></i>
                Настройки профиля
              </a>
              <a class="dropdown-item" href="logout ">
                <i class="fa fa-fw fa-sign-out-alt"></i>
                Выйти
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  <?php else :?>
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" href="signup ">
          <i class="fa fa-fw fa-user-plus"></i>
          Регистрация
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" href="login ">
          <i class="fa fa-fw fa-sign-in-alt"></i>
          Авторизация
        </a>
      </li>
    </ul>
  </div>
</nav>
<?php endif; ?>
<br>
<br>
<div class="row ">
  <div class="col-md-6 offset-md-3 ">

    <?php
    if (isset($_GET['ID']))
    {
      $wishlistID= $_GET['ID'];
      $wishlists = R::load('newwishlists',$wishlistID);
      $wishlistsCount=R::count('newwishlists','id=?',array($wishlistID));

      if ($wishlistsCount<=0)
      {
        echo '<meta http-equiv="refresh" content="0;url= http://awishlist/authAndLogin/404 "> ';
      }
      else
      {

        $i=0;
        $wishlistID=$wishlists->id;
        $showInfo= $wishlists->wishlist_info;
        $showData=  $wishlists->wishlist_data;
        $showAddress = $wishlists->address;

        $user_login_id=$wishlists->user_login_id;
        $users = R::load('users',$user_login_id);

        $userName=$users->login;
        echo '
        <br>
        <h2 style="text-align:center">Список желаний пользователя '.$userName.' </h2>
        <br>

        ';

        echo '
        <div class="card border-dark">
        <div class="card-header" style="text-align:center">
        <h5>'.$wishlists->wishlist_name.'</h5>
        <div class="text-right">

        </div>
        </div>
        <div class="card-body">
        <div class="panel-group">
        <div class="panel panel-default">


        <ul class="list-group">
        <li class="list-group-item"><b>Информация о мероприятии:</b> '.$showInfo.'</li>
        <li class="list-group-item"><b>Дата проведения мероприятия:</b> '.$showData.'</li>
        <li class="list-group-item"><b>Адрес проведения мероприятия:</b> '.$showAddress.'</li>

        </ul>
        ';
        $wishs = R::find('wishs',"wish_wishlist_id=?",array($wishlistID));
        $wishsCount = R::count('wishs',"wish_wishlist_id=?",array($wishlistID));

        if ($wishsCount==0) {
          echo '
          <br>
          <div>
          <ul class="list-group">
          <li class="list-group-item">В списке желаний пользователя '.$userName.' ещё нет желаний</li>
          </ul>
          </div>
          ';
        }
        else {
          // echo '<div class="card-desk">';
          foreach ($wishs as $oneWish){
            $oneWishId=$oneWish->id;
            $oneWishName=$oneWish->wish_name;
            $oneWishInfo=$oneWish ->wish_info;
            $oneWishPrice=$oneWish->wish_price;
            $oneWishLink=$oneWish->wish_link;
            $oneWishImg=$oneWish->wish_img_path;
            $oneWishCurrency =$oneWish->wish_currency_type;

            // <ul class="list-group">
            //<img class="card-img-top  w-50 h-50 p-3" src="cataloge-images/notebook.png" alt='.$i.' >
            echo '
            <div class="card border-dark text-left" style="  display: inline-block">';
            if ($oneWishImg!='') {

              echo '
              <div class="text-center">
              <img class="card-img-top w-50 h-50 p-2 img-thumbnail" src="'.$oneWishImg.'">
              </div>
              ';
            }
            echo'

            <div class="card-header"><b>Название желания:</b> '.$oneWishName.'</div>

            <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Информация:</b> '.$oneWishInfo.'</li>
            <li class="list-group-item"><b>Цена:</b> '.$oneWishPrice.''.$oneWishCurrency.'</li>
            <li class="list-group-item"><b>Ссылка:</b> <a href='.$oneWishLink.' target="_blank">'.$oneWishLink.'</a></li>
            </ul>
            </div>
            <br>
            <br>
            </ul>
            </div>
            ';

          }
        }
        echo '

        </div>
        </div>
        </div>
        ';
        $i++;

      }

    }
    ?>
  </body>
  </html>
