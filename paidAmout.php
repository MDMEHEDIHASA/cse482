<?php 

require('config/config.php');

$userPaymentUpdate = $_SESSION['name'];

$token =$_POST['stripeToken'];
$amount =  200*10;
$charge = \Stripe\Charge::Create([
    'amount'=>$amount,
    'description'=>'For comment you have to pay price.',
    'currency'=>'usd',
    'source'=>$token,
]);
if($charge){
    $paymentComplete = mysqli_query($con, "UPDATE users SET paid='yes' WHERE name='$userPaymentUpdate'");
    header("Location:index.php?amount=$amount");
}
?>