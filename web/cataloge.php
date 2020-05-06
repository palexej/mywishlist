<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
  <meta charset="utf-8">

  <?php require_once 'dependence.php' ?>

  <!-- Bootstrap DatePicker -->



  <style media="screen">
  body {
    background: url() no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }

</style>
<title>Каталог</title>
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
<br>

<div class="row">
  <div class="col-md-8 offset-md-2">

    <div class="input-bar">
      <div class="input-bar-item width100">
        <form action="cataloge" method="post" >
          <div class="input-group">
            <input class="form-control width100" value="" name="searchField"  type="text"  placeholder="Поиск по каталогу...">
            <span class="input-group-btn">
              <button type="submit"  name="searchBtn" class="btn btn-outline-dark">Найти
                <i class="fa fa-search"></i>
              </button>
            </span>
          </input>
        </div>
      </form>
    </div>
  </div>

  <br>

  <?php
  $data=$_POST;
  $i=0;


  if (isset($data['searchBtn'])) {
    if (isset($data['searchField']))
    {
      $productSearchByName=$data['searchField'];

      $products = R::find('cataloge',"product_name like :searchField", array(':searchField' => '%'.$productSearchByName.'%' ));
      $productsCount=R::find('cataloge',"product_name like :searchField", array(':searchField' => '%'.$productSearchByName.'%' ));
      //  $productsCount = R::count('cataloge',"product_name like ?",'%'.array($prodStr).'%');
      //$productsCount= R::count('cataloge',"product_name like ?",['Ноу%']);
      //  $productsCount = R::count('cataloge',"product_name=?",array($productSearchByName));
      unset($data['searchBtn']);
      unset($data['searchField']);

    }
  }
  else
  {
    $products = R::findAll('cataloge');//загрузить все данные из таблицы каталога
    $productsCount=0;
  }



  if ($productsCount==0)
  {
    echo "К сожалению, по Вашему запросу мы ничего не нашли :(";
    return;
  }
  elseif($productsCount!=0)
  {
    $modalCounter=0;

    echo '<div class="card-columns" >';

    foreach ($products as $oneProduct)
    {
      $productID=$oneProduct->id;
      $productName=$oneProduct->product_name;
      $productInfo=$oneProduct->product_info;
      $productPrice=$oneProduct->product_price;
      $productCurrencyType=$oneProduct->product_currency_type;
      $productType=$oneProduct->product_type;
      $productImgPath=$oneProduct->product_img_path;
      $productLink=$oneProduct->product_link;

      echo'

      <div class="card bg-light mb-3 text-center" style="max-width: 20rem;  display: inline-block">
      <img class="card-img-top" src="'.$productImgPath.'" alt='.$productName.'>
      <div class="card-header">'.$productName.'</div>
      <div class="card-body">
      <p class="card-text">Цена: '.$productPrice.$productCurrencyType.'</p>
      </div>
      <div class="card-footer bg-transparent ">
      <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal" data-product_ID='.$productID.' data-product_name='.$productName.' data-product_info='.$productInfo.'
      data-product_price='.$productPrice.' data-product_currency_type='.$productCurrencyType.' data-product_type='.$productType.' data-product_link='.$productLink.'

      >Подробнее</button>';

      echo '</div>';

      echo ' </div>';
      // if ($i%4==0)
      // {
      //   echo '<br>';
      // }
      $modalCounter++;

    }


  }


  if (isset($data['addWishFromCataloge']))
  {
    echo $productName;
    echo '<meta http-equiv="refresh" content="0;url= http://awishlist/authAndLogin/addWishToList "> ';
  }

  ?>


</div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="ID_prod_info"></p>
        <p id="ID_prod_type"></p>
        <p id="ID_prod_price"></p>
        <p id="ID_prod_link"></p>
      </div>
      <div class="modal-footer">

        <?php
        if ( isset ($_SESSION['logged_user']) )
        {
          echo '<button class="btn btn-success" id="addWish" type="submit" value=""  name="addWishFromCataloge">Добавить желание из каталога в список</button>';
        }
        ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>

<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var product_name_JS = button.data('product_name')
  var product_info_JS=button.data('product_info');
  var product_link_JS=button.data('product_link');
  var product_currency_type_JS=button.data('product_currency_type')
  var product_price_JS=button.data('product_price');
  var product_type_JS=button.data('product_type');

  var product_ID_JS=button.data('product_ID');

  var modal = $(this)
  modal.find('.modal-title').text(product_name_JS)
  modal.find('#ID_prod_info').html("<b>Подробная информация о товаре: </b>"+product_info_JS)
  modal.find('#ID_prod_price').html("<b>Цена: </b>"+product_price_JS+product_currency_type_JS)
  modal.find('#ID_prod_type').html("<b>Категория товара: </b>"+product_type_JS)
  modal.find('#ID_prod_link').html("<b>Ссылка на оригинал: </b> <a href="+product_link_JS+" target='_blank'>"+product_link_JS+"</a>")




});

$('button[name="addWishFromCataloge"]').click(function () {
  location.href = "http://awishlist/authAndLogin/upload";
});
</script>
<!--
<a href='.$productLink.'  target="_blank">
<img class="card-img-top" src="'.$productImgPath.'" alt='.$productName.'>
</a> -->
