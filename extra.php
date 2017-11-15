<?php 
echo 'entered';
if(isset($_POST['submitCustDetails']))
{
	echo 'success';
	$custDetailsQuery = "INSERT INTO customer(orderID,customerName,addressLine,state,zipCode,email,phoneNumber) VALUES
						(".$_SESSION['orderID'].",'".$_POST['Name']."','".$_POST['Address']."','".$_POST['state']."',".$_POST['zcode']."
						,'".$_POST['Email']."',".$_POST['Phone'].");";
	$cust = mysqli_query($link,$custDetailsQuery);	
	$custRow = mysqli_fetch_array($cust);
	$getPrices = "SELECT p.price,o.quantity from products p JOIN orders o ON p.productID = o.productID 
					WHERE p.productID = ".$_SESSION['productID']." AND o.orderID = ".$_SESSION['orderID'].";";
	$price = mysqli_query($link,$getPrices);
	$priceRow = mysqli_fetch_array($price);
	$getAdditionalCharges = "SELECT * FROM taxrates WHERE abbreviation = '".$_POST['state']."';";
	$additionalCharge = mysqli_query($link,$getAdditionalCharges);
	$additionalChargeRow = mysqli_fetch_array($additionalCharge);
	$updateOrder = "UPDATE orders SET price = ((".$priceRow['0']."*".$additionalChargeRow['2']."*".$priceRow['1']."/100)+(".$priceRow['0']."*".$priceRow['1'].")+".$additionalChargeRow['3'].") 
					WHERE orderID = ".$_SESSION['orderID'].";";
	$setPrice = mysqli_query($link,$updateOrder);
	if($setPrice)
	{
		echo 'Shipping Details updated successfully';
		echo '<br>';	
	}	
	$getFinalPrice = "SELECT price FROM orders WHERE orderID = ".$_SESSION['orderID'].";";
	$FinalCharge = mysqli_query($link,$getFinalPrice);
	$Charge = mysqli_fetch_array($FinalCharge);
//	$Site = "'http://students.cs.niu.edu/~z1778592/OrderingSystem/PaymentPage.php?OrderID=".$_SESSION['orderID']."&price=".$Charge['0']."'";
//	echo '<input type="button" onclick="location.href('.$Site.');" value="Click me to go to payment page!!!">';	
    
    echo "<form action=\"PaymentPage.php?OrderID=".$orderID."&price=".$Charge['0']."\" method=\"POST\">
    <input type='submit' name=\"submit\" value=\"Click me to go to payment page!!!\"> </form>";	
}



?>