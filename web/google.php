<!-- <html>
<head>
<title>reCAPTCHA demo: Simple page</title>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LdM2_QUAAAAAHx20W11zR-vufi6wucxiu_Q1THH"></script>
</head>
<body>
<form action="google.php" method="POST">
<div class="g-recaptcha" data-sitekey="6LdM2_QUAAAAAHx20W11zR-vufi6wucxiu_Q1THH"></div>
<br/>
<button type="submit" name="btnSubmit">ok</button>
</form>
</body>
</html>
<script>
grecaptcha.ready(function() {
grecaptcha.execute('6LdM2_QUAAAAAHx20W11zR-vufi6wucxiu_Q1THH', {action: 'homepage'}).then(function(token) {
console.log(token);
document.getElementById("g-token").value = token;
});
});
</script>
-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <script src="https://www.google.com/recaptcha/api.js"></script>

  <form method="post" action="google.php">
    <input type="email">
    <div class="g-recaptcha" data-sitekey="6LdM2_QUAAAAAHx20W11zR-vufi6wucxiu_Q1THH"></div>
    <button type="submit">Отправить</button>
  </form>

</body>
</html>

<?php
$error = true;
$secret = '6LdM2_QUAAAAAAMioaLtkyiYP-BoHxD9NYNE1rUf';

if (!empty($_POST['g-recaptcha-response'])) {
  $out = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
  $out = json_decode($out);
  if ($out->success == true) {
    $error = false;
  }
}

if ($error) {
  echo 'Ошибка заполнения капчи.';
}
?>
