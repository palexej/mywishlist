<html>
<head>
  <title>reCAPTCHA demo: Simple page</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://www.google.com/recaptcha/api.js?render=__YOUR_SITE_KEY__"></script>
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


<?php
 if(isset($_POST) && isset($_POST["btnSubmit"]))
{
  $secretKey 	= '6LdM2_QUAAAAAAMioaLtkyiYP-BoHxD9NYNE1rUf';
  $token 		= $_POST["g-token"];
  $ip			= $_SERVER['REMOTE_ADDR'];

  $url = "https://www.google.com/recaptcha/api/siteverify";
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
?> ?>
