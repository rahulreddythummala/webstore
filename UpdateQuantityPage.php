<html>
<?php $Search = null; 
 include 'LocalhostConnection.php';
    //include 'blitzConn.php'
        ;?>
<head>
<title>Search Products</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="page">
		<div>
			<center><h1><a href="#" id="logoLink">Product System</a></h1></center> <br><br><br>
		</div>
		<br> <br>
		<div id="nav">
			<ul>
				<li><a href="Index.php">Index</a></li>
                <li><a href="shop.php">ViewProducts</a></li>
                <li><a href="UpdateQuantityPage.php">Update Inventory</a></li>
            <!--    <li><a href="return.html">Ship Products</a></li>  -->
			</ul>	
		</div>
<div id = "content">		
<?php 
echo 'Redirected to update Quantity page';
error_reporting(0);
?>
<head>
<title>Add Products</title>
</head>
<body>
<h1>Add Products to Inventory</h1>
<?php
include 'LocalhostConnection.php';
session_start();
if($_GET['pnumber'])
{
	$productID = $_GET['pnumber'];
	$_SESSION['productID'] = $productID;
}
	echo '<form action="" method="post">';
	echo 'Enter the no.of quantity for the product :'.$productID.'s to be added: <input type = "text" name = "quantityIncrement">';
	echo '<input type = "submit"  value = "Add Products">';
	echo '</form>'; 


$Add = null;
 isset($_POST['submit']);
 if (isset($_POST['quantityIncrement']))    
{    
	$Add = $_POST['quantityIncrement'];   
} 
 if (isset($_POST['pName']))    
{    
	$pName = $_POST['pName'];   
} 
$query = 'update products set quantity_available = (quantity_available + '.$Add.') WHERE product_id = '.$_SESSION['productID'].';';
   
	$res = mysqli_query($link,$query);
	//$rowCount = mysqli_num_rows($res);	
	if($res)
	{
		echo 'Quantity updated successfully';
	}	
?>
    </div>
</body>
</html>
