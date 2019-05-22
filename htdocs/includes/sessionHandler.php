<?php
//Handles the Timeout of the Shoppingcart
$session_timeout = 300;

if(!isset($_SESSION['last_visit']))
{
  $_SESSION['last_visit'] = time();
}

if(time()-$_SESSION['last_visit'] > $session_timeout)
{
  unset($_SESSION['shoppingcart']);
}

$_SESSION['last_visit'] = time();
?>