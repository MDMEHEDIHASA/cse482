<?php
ob_start();//turn on output buffering
session_start();
$timezone = date_default_timezone_set("Asia/Dhaka");


require_once "stripe-php-master/init.php";

$city_name='Dhaka,BD';
$api_key='6ffb6bf3b8f6dac4808253608fe47bf7';
$api_url='http://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&appid='.$api_key;
$jokes_api_url = "https://v2.jokeapi.dev/joke/Any";


$itemPrice = 25; 
$currency = "USD"; 

$stripeDetails = array(
	'PUBLIC_KEY' => 'pk_test_51HhGcuIcgvz2PzTpXenxpxxL2UqPn8ankYA7Mt8KS3WXfy0GFd22DeegXdSyPtXWQFokHPktRzYHd1PKc2OoSvVZ00Ugct5EgT',
	'SECRET_KEY' => 'sk_test_51HhGcuIcgvz2PzTpdrjL2UTP8JBGIMdU929wrwYFukFdoGbofGqWnVo4QZgpWstbaCzxRED8jZPkGCk7CNfVMI5M00uKUJrf5o'
);
\Stripe\Stripe::setApiKey($stripeDetails['SECRET_KEY']);

$con = mysqli_connect("localhost", "root", "", "cse482"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>