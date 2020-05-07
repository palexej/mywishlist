



<?php

require 'libs/rb.php';


require_once('dependence.php');
try{
  $db = new PDO('mysql:host=us-cdbr-east-06.cleardb.net;dbname=heroku_8577067324d828a','be0fd66079ab9f','ed9d44bd');
  echo "всё ок";
} catch(PDOException $e){
  echo $e->getmessage();
}
?>
