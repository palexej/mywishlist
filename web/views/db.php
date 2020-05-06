<?php
require 'libs/rb.php';
R::setup( 'mysql:host=localhost; dbname=webdb','root', '1234' );

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

session_start();
