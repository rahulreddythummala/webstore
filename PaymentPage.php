<html>
<?php 
error_reporting(0);
?>
<head>


<link rel="stylesheet" href="style.css" type="text/css" />
<title>Product System</title>
</head>
<body>
<div id="page">
		
	<div id="banner">
<img style="display: inline;" src="fast.jpg" ; align=right />
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="Index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                        <!--        <li><a href="return.php">Return Shipment</a></li> -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<?php
include 'LocalhostConnection.php';
session_start();

if($_GET['OrderID'])
{
	$orderID = $_GET['OrderID'];
	$_SESSION['orderID'] = $orderID;	
}
if($_GET['price'])
{
	$price = $_GET['price'];
	$_SESSION['price'] = $price;
}

//echo 'Order Number is :'.$orderID;
//echo 'Price:'.$price;
//***********************PAYMENT FORM********************************************/
	echo '<h2> <center><b> Card Details </b></center></h2>';
	echo '<form id = "cardDetails" method = "POST">';
	echo '<form action="" method="POST"><table cellpadding = "10" align = "center" width = "40%">';
	echo '<tr>';
	echo '<td> Name on Card: </td>';
	echo '<td> <input type = "text" name = "Name" placeholder = "Name on Card" size = "30" required/> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Card Number:</td>';
	echo '<td><input type = "text" name = "cardNumber" placeholder = "Card Number" size = "30" required/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Expiry Date: </td>';
	echo '<td> <input type = "text" name = "expiry" placeholder = "Ex. 12/2016" size = "15" required/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Total Amount <br> (Inclusive of taxes and shipping charges): </td>';
	echo '<td> <input type = "text" name = "amount" value = "$'.$_SESSION['price'].'" size = "15" disabled/> </td>';
	echo '</tr>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';	
	echo '<tr>';
	echo '<td colspan = "2" align = "center"><button type = "submit" name = "submitCardDetails" align = "center">Validate Payment</button></td>';
   /* echo '<td> <form action ="AddProducts.php" method="POST"><input type="submit" name="cancel" value="Cancel"> 
    </form></td>';*/
	echo '</tr>';
	echo '</table>';
	echo '</form>';
//******************************************************************************************************************/
if(isset($_POST['submitCardDetails']))
{
/*
$fp = fsockopen( "udp://blitz.cs.niu.edu", 4445, $errno, $errstr );
if (!$fp) die("$errstr ($errno)<br>");
$message = "6011 1234 4321 1234:12/2016:543.21:John Doe";
echo "Sending: $message<br>";
fwrite( $fp, $message ) or die("write failed<br>");
$response = fread($fp, 1024);
echo "Received: $response<br>";
fclose($fp);
*/  
	//*********************************Card Authorization***********************************************************/
	/*$fp = fsockopen( "udp://blitz.cs.niu.edu/CreditCard", 4445, $errno, $errstr );
	if (!$fp) die("$errstr ($errno)<br>");*/
	$url='http://blitz.cs.niu.edu/CreditCard/';   
	$message = ''.$_POST['cardNumber'].':'.$_POST['expiry'].':'.$_SESSION['price'].':'.$_POST['Name'].'';
 	$options=http_build_query($message);
	$context = stream_context_create($options);
	$result=file_get_contents($url, false, $context);
	echo($result);   
/*echo "Sending: $message<br>";
	fwrite( $fp, $message ) or die("write failed<br>");
	$response = fread($fp, 1024);*/
//echo 'test1'.$response;

	//*********************************Database Update***********************************************************
/*	$messageValidation = 'INSERT INTO cardCheck(message) values("'.$response.'");';
  //  echo 'test1'.$messageValidation;
	$insertMessage = mysqli_query($link,$messageValidation);
   // echo 'test2'.$insertMessage['0'];
    //echo '<br>';
	$checkMessage = "SELECT message FROM cardCheck WHERE message LIKE '% is valid: authorization code:%';";
	$verify = mysqli_query($link,$checkMessage);
	$rowCount = mysqli_num_rows($verify);*/
	if($result!=NULL)
	{
	/*	$cardDetailsInsert = "INSERT INTO cardDetails(orderID,cardNumber,expiryDate,amount) VALUES
							('".$_SESSION['orderID']."','".$_POST['cardNumber']."','".$_POST['expiry']."','".$_SESSION['price']."');";
		echo $cardDetailsInsert;
        $card = mysqli_query($link,$cardDetailsInsert);	
		echo "".$response."<br>";
		echo '<br>';*/
		echo "Your Order is placed. Please remember the Authorization Code above and the order number in case of future communications!!!!";
		echo '<br>';
		echo 'Thanks!!!!!!!!!!!!';
	/*	$truncateCardCheck = "TRUNCATE cardCheck;";
		$exec = mysqli_query($link,$truncateCardCheck); */
        
        $sql1="UPDATE products SET blocked=0;";
        mysqli_query($link,$sql1);
        
	}
	else
	{
		echo "".$response."<br>";
		echo "Card not Authorized. Please verify the details entered!!!!!";
		$truncateCardCheck = "TRUNCATE cardCheck;";
		$exec = mysqli_query($link,$truncateCardCheck);		
	}
	fclose($fp);	
}
?>
</div>
<div id="footer">
			<p><center>
				Powered by <a href="/" target="_blank">Graduate Group 4</a></center>
			</p>
		</div>
						</div>
</body>
</html>

