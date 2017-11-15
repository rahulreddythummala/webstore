<html>
<head>
<?php $Search = null; 
 include 'LocalhostConnection.php';
  
 ?>

<!--	<link rel="stylesheet" href="style.css" type="text/css" />
<title>Ordering System</title>
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
                              
				<li><a href="contact.php">Contact</a></li>
			</ul>	
		</div>
<div>
<br>
</div>
<div id="content">
<h2><b> Parts in the Inventory :</b></h2> 
    -->
<?php

$dataLink =new mysqli('p:blitz.cs.niu.edu','student','student','csci467');
//$conn = new PDO("mysql:$host;dbname=$db",$user,$pwd);
//$dataLink = new mysqli('p:blitz.cs.niu.edu','db5user','db5password','dbgradfive');
//new PDO("mysql:blitz.cs.niu.edu;dbname=dbgradfive",'db5user','db5password');

//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$dataLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
if(!$link){
echo 'ERROR:Could not connect to the legacy database ' .getMessage();
//die('Could not connect to the legacy database'.mysql_error());

}
*/

if(!$dataLink){
echo 'ERROR:Could not connect to the system database' .getMessage();
//die('Could not connect to the system database'.mysql_error());
}


//$query='select * from parts';

$res = $dataLink->query("select * from parts;");
	//echo 'success';
	
	//$res->setFetchMode(PDO::FETCH_ASSOC);
	//mysqli_query($link,"select * from parts") or die("Cannot run query on legacy database".mysql_error());
	//echo 'success 2';
	//$rowCount = $res->rowCount();
	//echo 'row values are' .$rowCount;
	
	$rowCount=mysqli_num_rows($res);
	if($rowCount>0)
	{
		//echo 'entered';
		// while ($cdata = $res->fetch())
		while($cdata = mysqli_fetch_array($res))
		{
			//echo 'entered while';
			$insertQuery = "INSERT INTO products(productID,productName,price) values(".$cdata['0'].",'".$cdata['1']."',".$cdata['2'].") 
							ON DUPLICATE KEY UPDATE productName = values(productName),price = values(price);";
			
			$link->query($insertQuery);
			//mysqli_query($dataLink,$insertQuery);
		}
	}
	else
	{
		echo "No products found";
	}
/*
if($link)
mysqli_close($link);
*/
if($dataLink)
mysqli_close($dataLink);
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
