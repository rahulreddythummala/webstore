<html>
<head>


	<link rel="stylesheet" href="style.css" type="text/css" />
<title> Order Products </title>
</head>

<body>
<div id="page">
		
	<div id="banner">
<img style="display: inline;" src="fast.jpg" ; align=right />
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="index.php">About Us</a></li>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="return.php">Return Shipment</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<h2><b> Parts in the Inventory : </b></h2>
<form action="DBConnecction.php" method="post">
<?php
$link = mysqli_connect('blitz.cs.niu.edu:3306','student','student','csci467');

if(!$link){
die('Could not connect:'.mysql_error());
}

$db = "csci467";
$db_selected = mysqli_select_db($link,$db);
$query = "SELECT * FROM parts";
//$query_out = mysqli_query($link,$query) or die("Search query #1 failed".mysql_error());
	if ($query != NULL)
	{		
		$res = mysqli_query($link,$query) or die("No products found");
		$rowCount = mysqli_num_rows($res);
		if($rowCount>0)
		{
			//inserting the data into a table
			echo '<table border=1 style=width:70% bgcolor = "White">';
			echo '<th> Number </th>';
			echo '<th> Product </th>';
			echo '<th> Cost </th>';
			
			while($cdata = mysqli_fetch_array($res))
			{
				echo '<tr>';
				echo '<td>'. $cdata['0']. '</td>';
				echo '<td><input type = "submit" name = "cart" value = "'. $cdata['1'].'"/></td>';
				echo '<td>'. $cdata['2']. '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		else
		{
			echo "No products found";
		}
	}
?>
<?php
if(isset($_POST['cart']))
{
	echo "successfully added to cart";
}
?>
</div>
<div id="footer">
			<p><center>
				Powered by <a href="/" target="_blank">Team 9</a></center>
			</p>
		</div>
						</div>
/form>
</body>
</html>