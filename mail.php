<?php

$msg = "Your order has been shipped.";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("shreyas.zidane@gmail.com","My subject",$msg);
echo "Mail Sent";
?>
