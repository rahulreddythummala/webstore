<html>
<?php 
error_reporting(0);
?>
<head>
<title>Product System</title>

	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="page">
		
	<div id="banner">

			<br><br><br><h1><b>Product System </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                             <!--   <li><a href="return.php">Return Shipment</a></li -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
<div id="content">
<h2><b>Your Cart :</b></h2>
<form action="" method="POST">
<?php
include 'LocalhostConnection.php';
//session_start();

//echo $_SESSION['productID'];
/*if($_POST['pnumber'])
//if(isset($_SESSION['pnumber']))
{
	$productID = $cRow['0'];
	//echo $productID;
	$_SESSION['productID'] = $productID;
}*/
  
/*if($_GET['pnumber'])
{
    
	$productID = $_GET['pnumber'];	
	$_SESSION['productID'] = $productID;
}*/
    
	echo '<form id = "cart" action="" method="POST">';
	echo 'Number of units required <input type = "text" name = "productQuantity" required>';
    echo "<button type='submit' name ='Cart'>Add to Cart</button>" ;
	
	 echo '</form>'; 
    $productID = $_GET['pnumber'];
   
   // $_SESSION['productID'] = $productID;


     $btnClick=$_POST['Cart'];
if(isset($btnClick))
{
   
    
	 $CheckQuantity = 0;
	// isset($_POST['submit']);
	 if (isset($_POST['productQuantity']))    
	{    
      $CheckQuantity = $_POST['productQuantity'];  
    } 

	//$query = 'SELECT quantity FROM products WHERE productID = '.$_SESSION['productID'];
	$query= "SELECT quantity_available FROM products WHERE product_id='$productID'" ;
	$query2 = 'SELECT * FROM orderDetails;';
	$res=mysqli_query($link,$query);
	
    $res2 =$link->query('SELECT * FROM orderDetails;');
	$rowCount = mysqli_num_rows($res2);
	$orderNumber = $rowCount+1;
	
   /* $cRow=array($res);*/
$cRow=mysqli_fetch_array($res);	
   // while ($row = mysqli_fetch_array ($res, MYSQL_BOTH)) {
    //$cRow = mysqli_fetch_array ($res,MYSQLI _ASSOC);

   // $cRow['productID'] = $row;
	//echo '.$cRow[0].';
	//echo 'entered loop';
	//}
	//$cRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    
	//echo '.$cRow[0].';
	//$row = $res->fetch_array(MYSQLI_NUM);
	
    if($cRow['0'] >= $CheckQuantity && $CheckQuantity>0)
	{
	
		$updateQuery = 'update products set blocked = '.$CheckQuantity.' WHERE product_id = '.$productID.';';
       /* $updateQuery1 = 'update products set quantity_blocked = quantity_blocked+'$CheckQuantity' WHERE product_id = '$productID';';*/
        $sql1="UPDATE products SET quantity_available=(quantity_available-blocked);";
            
		$insertQuery = 'INSERT INTO orderDetails(order_id,product_id,quantity,status) values 
						('.$orderNumber.','.$productID.','.$CheckQuantity.',"placed");';
		$updateResult = mysqli_query($link,$updateQuery);
        $updateResult1 = mysqli_query($link,$updateQuery1);
        $updateResult2=mysqli_query($link,$sql1);
		$insertResult = mysqli_query($link,$insertQuery);	
        
		if($updateResult && $insertResult)
		{
			echo 'Products added to cart successfully';	
			echo '<br> <br>';		
		}
		//$Site = "'http://students.cs.niu.edu/~z1778592/OrderingSystem/OrderPage.php
       // Quantity=".$CheckQuantity."&ProductID=".$_SESSION['productID']."&OrderID=".$orderNumber."'";
        //$Site = "'http://localhost/OrderPage.php?Quantity=".$CheckQuantity."&ProductID=".$_SESSION['productID']."&OrderID=".$orderNumber."'";
		
       // echo "<form action=\"OrderPage.php?Quantity='$CheckQuantity'&ProductID='$productID'&OrderID='$orderNumber'"\ method=\"POST\">
echo "<form action=\"OrderPage.php?Quantity=".$CheckQuantity."&ProductID=".$productID."&OrderID=".$orderNumber."\" method=\"POST\">        
<input type='submit' name='submit' value='Click me to place your order!!!'></form>";	
       
      
	}
	else
	{
		echo 'We don\'t have the no of items you requested. Please check back tomorrow. Sorry for any inconvenience!!!!!'; 
		echo '<br>';
		echo ' <a href = "AddProducts.php"> Go back shopping!!!</a> ';
	}	
    
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
