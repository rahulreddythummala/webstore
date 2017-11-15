<!DOCTYPE html>
<html>
<head>
        <title>Product System</title>

	<link rel="stylesheet" href="style.css" type="text/css" />
	<?php $Search = null; 
 
 include 'blitzConn.php';
 ?>
<style>

</style>
	
</head>
<body>

	<div id="page">
		
	<div id="banner">
			<h1><b>Product System</b></h1>

		</div>
		
		<div id="nav">
			<ul>
				<li><a href="Index.php">Home</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
		<div id="content">
			<h2><b>Products :</b></h2>
			<br><br>
			<!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
		
		
		<?php
		$conn =new mysqli('p:blitz.cs.niu.edu','student','student','csci467');
		if(!$conn){
echo 'ERROR:Could not connect to the legacy database ' .getMessage();

}

		$res = $conn->query("select * from parts;");
	
	$rowCount=mysqli_num_rows($res);
	
	print "<table border=1>";
	if($rowCount>0)
	{
		print "<th>Product ID </th> <th>Product Name</th> <th>Price</th> <th>Weight</th> <th>Picture URL </th>";

	while($cdata = mysqli_fetch_array($res))
		{
		print "<tr>";	
	        print "<td> &nbsp &nbsp ".$cdata['0']."</td> <td> &nbsp ".$cdata['1']."</td> <td> &nbsp ".$cdata['2']." &nbsp </td> <td> &nbsp ".$cdata['3']." &nbsp </td> <td> &nbsp <a href=".$cdata['4'].">".$cdata['4']." </a> </td>";
		print "</tr>";
		}
		
	}
	else
	{
		echo "No products found";
	}
	print "</table>";
if($conn)
mysqli_close($conn);

		?>
		</div>
<div id="footer">
			<p><center>
				Created by Graduate Group 4</a></center>
			</p>
		</div>
						</div>
</body>
</html>
