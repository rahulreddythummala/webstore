<html>
<head>
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
				<li><a href="Index.php">About Us</a></li>
                                <li><a href="shop.php">ViewProducts</a></li>
                               <!-- <li><a href="return.php">Return Shipment</a></li> -->
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<p> This is a customer homepage for product system.</p>
<p> Customer can order new products or view products.</p>
<p> Please use appropriate links below to go to respective pages </p>
<form action="AddProducts.php" method="POST">
<?php

$Site = "AddProducts.php";
//$Site2 = "'http://localhost/ReturnPage.php'";
//http://students.cs.niu.edu/~z1778592/OrderingSystem/
//echo ' <input type="submit" onclick="location.href='.$Site.';" value="Click here to order new products"> ';
echo " <input type='submit' value='Click here to order new products'> ";
if(isset($_POST['submit'])){
	header("Location:AddProducts.php");
}

//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="location.href('.$Site2.');" value="Click here to return products">';
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
