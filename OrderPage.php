<html>
<head>
<script language="javascript">
var i=0;
function func()
{
if(document.getElementById("deli").checked)
{
alert("Opted for Fast Delivery");
}
else
{
alert("Changing to Normal Delivery");	
document.getElementById("tbl").innerHTML=" ";
}
}
</script>
<?php
error_reporting(0);
?>
<title>Product System</title>

	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="page">
		
	<div id="banner">
			<br><br><br><h1><b>Product System</b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                              <!--  <li><a href="return.php">Return Shipment</a></li> -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content
<h2><b> Details Page : </b><h2>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['Quantity'])
{
	$Quantity = $_GET['Quantity'];
	$_SESSION['Quantity'] = $Quantity;
}
if($_GET['ProductID'])
{
	$productID = $_GET['ProductID'];
	$_SESSION['productID'] = $productID;
}
if($_GET['OrderID'])
{
	$orderID = $_GET['OrderID'];
	$_SESSION['orderID'] = $orderID;	
}
$query = 'SELECT * FROM additionalCharges order by state_name;';
$res =$link->query($query);
   
//***********************SHIPPING INFORMATION********************************************/
	echo '<h2> <center><b>Shipping Information </b></center></h2>';
	echo '<form id = "ShippingDetails"  method = "POST">';
	echo '<form id="myform" action="" method="POST"><table cellpadding = "10" align = "center" width = "60%">';
	echo '<tr>';
	echo '<td> Name: </td>';
	echo '<td> <input type = "text" name = "Name" placeholder = "Name" value="'.$_POST['Name'].'" required/> </td>';
	echo '</tr>';
        echo '<tr>';
	echo '<td>Contact Email Address:</td>';
	echo '<td><input type = "text" name = "Email" placeholder = "Email" value="'.$_POST['Email'].'" required/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Phone Number: </td>';
	echo '<td> <input type = "text" name = "Phone" placeholder = "Phone" value="'.$_POST['Phone'].'" required/></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Apartment and Street: </td>';
	echo '<td> <input type = "text" name = "Address" placeholder = "Apartment & Street" value="'.$_POST['Address'].'" required/> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> State: </td>';
	echo '<td> <select id="state" name = "state"><option value="">SELECT</option>';
			while($cRow = mysqli_fetch_array($res))
			{
				if($cRow['0']==$_POST['state_name'])
				echo '<option value="'.$_POST['state_name'].'"selected>'.$cRow['0'].'</option>';
				else
				echo '<option>'.$cRow['0'].'</option>';
			}
	echo '</select> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> Zip Code </td>';
	echo '<td> <input type = "text" placeholder = "zip code" name = "zcode"> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '</tr>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr/>';
	echo '<tr>';
        echo '<td> <input type = "checkbox" placeholder = "state" name = "del" id="deli" onclick="func()" />Select this for Fast Delivery<br> <p id="delivery"></p></td>';
	echo '<td> <input type="submit" name="getCharges" value="Get Fast Delivery Charges"> </form> </td>';
	echo '</tr>';
    	echo '<tr>';
	echo '<td> <input type="submit" name="submitCustDetails" value="Submit Customer Details"></form> </td>';
	echo '<td> <form action ="AddProducts.php" method="POST"><input type="submit" name="cancel" value="Cancel"> 
    </form></td>';
	echo '</tr>';
	echo '</table>';
	 echo '</form>';
//******************************************************************************************************************/

if(isset($_POST['getCharges']))
{
	//echo 'success';
	include 'LocalhostConnection.php';
	$t= $_POST['state_name'];
	$fastDelivery="select * from deliveryCharges";
	//echo $fastDelivery;
	$delivery=mysqli_query($link,$fastDelivery);
	echo '<br>';
	$fast=mysqli_fetch_array($delivery);
	$ret= " insert into orderDetails(product_id,quantity) values(".$productID.",".$Quantity.");"; 
	$rew=mysqli_query($link,$ret);
	//echo $fast['2'];
	//echo '$fast[0]';
	echo '<script language="javascript">document.getElementById("delivery").innerHTML="Your order will be fast delivered in "'.$fast['2'].'" days </td>;" </script>';
	
	$fastDeliveryCharges=true;
	//echo '<script language="javascript">document.getElementById("deli").checked=true;</script>';
	
}
//else {}
                 
  //echo 'Hello';  
	$getPrices = "SELECT p.price_per_unit,o.quantity from products p , orderDetails o where p.product_id=o.product_id and o.order_id=".$orderID.";";

	$price = $link->query($getPrices);
	$priceRow = mysqli_fetch_array($price);
	
	//$getAdditionalCharges = "SELECT * FROM taxrates WHERE abbreviation = '".$_POST['state']."';";
    $getAdditionalCharges = "SELECT * FROM additionalCharges WHERE state_name like '%'";
    
    
	$additionalCharge =$link->query($getAdditionalCharges);
	$additionalChargeRow = mysqli_fetch_array($additionalCharge);
	
	if($fastDeliveryCharges)
	{
		
	echo '<script language="javascript">document.getElementById("deli").checked=true;</script>';
	echo '<table id="tbl" cellpadding = "10" align = "center" width = "40%">';
	echo '<tr>';
	//echo '<td><center> List of all Charges </center></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Product Price in Order </center> </td>';
	$sum = $priceRow['0']*$priceRow['1'];
	echo '<td> <center> '.$priceRow['0']."*".$priceRow['1']."=".$sum.' </center> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Tax Rate </td>';
	echo '<td> <center> '.$additionalChargeRow['1'].' </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Shipping Charges </center> </td>';
	echo '<td> <center> '.$additionalChargeRow['2'].' </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Handling Charges </center> </td>';
	echo '<td> <center> '.$additionalChargeRow['3'].' </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Fast Delivery Charges </center> </td>';
	echo '<td> <center> '.$fast['1'].' </center> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Total Charges of your Order </center> </td>';
	$updateOrder = "UPDATE orderDetails SET total_price = ((".$additionalChargeRow['1'].")+(".$sum.")+(".$additionalChargeRow['2'].")+(".$additionalChargeRow['3'].")+(".$fast['1']."))WHERE order_id =".$orderID.";";
	$delCharges= "UPDATE  orderDetails SET no_of_days=".$fast['2']." WHERE order_id =".$orderID.";";
	$dc= mysqli_query($link,$delCharges);
	$setPrice = mysqli_query($link,$updateOrder);
	$getFinalPrice = "SELECT total_price FROM orderDetails WHERE order_id =".$orderID.";";
	$FinalCharge = $link->query($getFinalPrice);
    	$Charge = mysqli_fetch_array($FinalCharge);
	echo '<td> <center> '.$Charge['0'].' </center> </td>';
	echo '</tr>';
	echo '</table>';
	}
	else if(isset($_POST['getNormalCharges']))
	{
		//echo 'test1'.$fastDeliveryCharges;
		include 'LocalhostConnection.php';
	//echo '<script language="javascript">document.getElementById("deli").checked=false;</script>';
	echo '<table id="tbl" cellpadding = "10" align = "center" width = "40%">';
	//echo '<tr>';
	//echo '<td><center> List of all Charges </center></td>';
	//echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Product Price in Order </center> </td>';
	$sum = $priceRow['0']*$priceRow['1'];
	echo '<td> <center> '.$priceRow['0']."*".$priceRow['1']."=".$sum.' </center> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Tax Rate </td>';
	//echo  $additionalChargeRow['1'];
	echo '<td> <center> '.$additionalChargeRow['1'].' </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Shipping Charges </center> </td>';
	echo '<td> <center> '.$additionalChargeRow['2'].' </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Handling Charges </center> </td>';
	echo '<td> <center> '.$additionalChargeRow['3'].' </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Fast Delivery Charges </center> </td>';
	echo '<td> <center> 0 </center> </td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td> <center> Total Charges of your Order </center> </td>';
	$updateOrder = "UPDATE orderDetails SET total_price = ((".$additionalChargeRow['1'].")+(".$sum.")+(".$additionalChargeRow['2'].")+(".$additionalChargeRow['3'].")+(".$fast['1']."))WHERE order_id =".$orderID.";";
//	$updateOrder = "UPDATE orderDetails SET total_price = ((".$additionalChargeRow['1'].")+(".$sum.")+(".$additionalChargeRow['2'].")+(".$additionalChargeRow['3']."))WHERE order_id =".$orderID.";";
	//echo $updateOrder;
	$setPrice = mysqli_query($link,$updateOrder);
	$delCharges= "UPDATE  orderDetails SET no_of_days=23 WHERE orderID = ".$orderID.";";
	$dc= mysqli_query($link,$delCharges);
	$getFinalPrice = "SELECT total_price FROM orderDetails WHERE orderID = ".$orderID.";";
	$FinalCharge = $link->query($getFinalPrice);
        $Charge = mysqli_fetch_array($FinalCharge);
	//echo $Charge['0'];
	echo '<td> <center> '.$Charge['0'].'</center> </td>';
	echo '</tr>';
	echo '</table>';
		//$updateOrder = "UPDATE orders SET price = ((".$priceRow['0']."*".$additionalChargeRow['1']."*".$priceRow['1']."/100)+(".$priceRow['0']."*".$priceRow['1'].")+".$additionalChargeRow['3']."+".$fast['1'].")
			//WHERE orderID = ".$orderID.";";
	}
	
                 
      //'test'.$Charge['0'];
                 
                
                 
if(isset($_POST['submitCustDetails']))
{
	echo '<center><b>Customer Details Submitted Successfully</b> </center>';
    
$custDetailsQuery = "INSERT INTO customerDetails(customer_name,phone,address,email,order_id,state,zipCode) VALUES(".$_POST['Name'].",".$_POST['Phone'].",".$_POST['Address'].",".$_POST['Email'].",".$orderID.",".$_POST['state'].",".$_POST['zcode'].");";
   $cust = mysqli_query($link,$custDetailsQuery);
   
	$custRow = mysqli_fetch_array($cust);
	//$delCharges= "UPDATE  orders SET deliveryDays= ".$fast['2']." WHERE orderID = ".$orderID.";";
	//$dc= mysqli_query($link,$delCharges);
	/*
	$getPrices = "SELECT p.price,o.quantity from products p JOIN orders o ON p.productID = o.productID 
					WHERE p.productID = ".$productID." AND o.orderID = ".$orderID.";";
   
    //$price=mysqli_query($link,$getPrices);
	$price = $link->query($getPrices);
    //$priceRow=array($price);
	$priceRow = mysqli_fetch_array($price);
    
	//$getAdditionalCharges = "SELECT * FROM taxrates WHERE abbreviation = '".$_POST['state']."';";
    $getAdditionalCharges = "SELECT * FROM taxrates WHERE stateName = '".$_POST['state']."';";
    
    //echo 'test1'.$getAdditionalCharges;
	$additionalCharge =$link->query($getAdditionalCharges);
	$additionalChargeRow = mysqli_fetch_array($additionalCharge);
    
    $updateOrder = "UPDATE orders SET price = ((".$priceRow['0']."*".$additionalChargeRow['1']."*".$priceRow['1']."/100)+".$priceRow['0']."+(".$additionalChargeRow['2'].")+".$additionalChargeRow['3'].") 
					WHERE orderID = ".$orderID.";";
   */
  $getFinalPrice = "SELECT total_price FROM orderDetails WHERE order_id =".$orderID.";";
	$FinalCharge = $link->query($getFinalPrice);
    $Charge = mysqli_fetch_array($FinalCharge);
	
	//$setPrice = mysqli_query($link,$updateOrder);
	/*if($setPrice)
	{
        echo '<br> <br>';
		echo '<center><b> Shipping Details updated successfully </b> </center>';
		echo '<br>';	
		
	/*$getFinalPrice = "SELECT price FROM orders WHERE orderID = ".$orderID.";";
	$FinalCharge = $link->query($getFinalPrice);
    $Charge = mysqli_fetch_array($FinalCharge);
    */
	//$Site = "'http://students.cs.niu.edu/~z1778592/OrderingSystem/PaymentPage.php?OrderID=".$orderID."&price=".$Charge['0']."'";
    echo '<br> <br>';
	echo "<form action=\"Payment1.php?OrderID=".$orderID."&price=".$Charge['0']."\" method=\"POST\">
    <input type=\"submit\" name=\"submit\" value=\"Click me to go to payment page!!!\"> </form>";	
    
       
    
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
