<html>
<?php $Search = null; 
 include 'LocalhostConnection.php';
    include 'blitzConn.php';?>
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
                <li><a href="UpdateQuantityPage.php">Update Inventory</a></li>
            <!--    <li><a href="return.html">Ship Products</a></li>  -->
			</ul>	
		</div>
<div id = "content">		
<h2>Search Products</h2>
<form action="SearchProducts.php" method="post">
 Enter a search item: <input  type = "text" name = "searchText">
<input type  = "submit"  value = "Search Products">
</form>
<?php
 isset($_POST['submit']);
 if (isset($_POST['searchText']))    
{    
	$Search = $_POST['searchText'];   
} 

if($Search == NULL)
 { 
	$query = "SELECT product_id,product_name FROM products ORDER BY product_id+0;";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Update </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0'];
			echo "<td>". $cRow['1'];
			echo '<td><a href = "UpdateQuantityPage.php?pnumber='.$cRow['0'].'">Add</a></td>';			
			//echo '<td><input type="submit" name = "quantity" value = "Update Quantity"/></td>';			
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
 else
 {
	$query = "SELECT productID,productName FROM products WHERE productName LIKE '%".$Search."%';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> Product ID </th>";
		echo "<th> Product Name </th>";
		echo "<th> Update </th>";
		while($cRow = mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>". $cRow['0'];
			echo "<td>". $cRow['1'];
			echo '<td><a href = "http://students.cs.niu.edu/~z1778592/OrderingSystem/UpdateQuantityPage.php?pnumber='.$cRow['0'].'">Add</a></td>';			
			echo "</tr>";
		}
		echo "</table>";
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
