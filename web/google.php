<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>

  <script src="https://www.google.com/recaptcha/api.js?render=6LdH0_QUAAAAAEd5ihDpdwdJTcKh-LRGP2t07u6X"></script>

</head>
<body>
  <form method="post" action="google.php">
    <input type="hidden" id="g-token" name="g-token" />
    <input type="text" name="name" value="">имяяяя</input>
    <button type="submit" name="subBtn">текст</button>

  </form>

  ssss
</body>
</html>


<?php
if (isset($_POST['subBtn']))
{
  $secretKey='6LdH0_QUAAAAAC2Te54Q_xUz3tM0Czs7kOUsEwv9';
  $token = $_POST["g-token"];
  $ip = $_SERVER['REMOTE_ADDR'];
  $url="https://www.google.com/recaptcha/api/siteverify".$secretKey;
  $data = array('secret' => $secretKey, 'response' => $token, 'remoteip'=> $ip);

  // use key 'http' even if you send the request to https://...
  $options = array('http' => array(
    'method'  => 'POST',
    'content' => http_build_query($data)
  ));
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result);
  if($response->success)
  {
    echo '<center><h1>Validation Success!</h1></center>';
  }
  else
  {
    echo '<center><h1>Captcha Validation Failed..!</h1></center>';
  }


}
?>


<script>
grecaptcha.ready(function() {
  grecaptcha.execute('6LdH0_QUAAAAAEd5ihDpdwdJTcKh-LRGP2t07u6X', {action: 'homepage'}).then(function(token) {
    document.getElementById("g-token").value = token;
  });
});
</script>
