<html>
<?php $Search = null; 
 include 'LocalhostConnection.php';
   ?>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Current Charges</title>	
</head>
<body>
<div id="banner">
			<br><br><br><h1><b>Product System</b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>

			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">		
<h2><b> Current Charges <b></h2>
<form action="" method="post">
 Search a State: <input  type = "text" name = "searchText">
 
<input type  = "submit"  value = "Search State">	
</form>
    <?php
 isset($_POST['submit']);
 if (isset($_POST['searchText']))    
{    
	$Search = $_POST['searchText'];   
} 

 if($Search)
 {
    $query = "SELECT * FROM additionalCharges WHERE state_name LIKE '%".$Search."%' OR abbreviation LIKE '%".$Search."%';";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);	
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> State </th>";
		echo "<th> Current Tax </th>";
		echo "<th> Current Shipping Charges</th>";
         	echo "<th> Current Handling Charges</th>";
		echo "<th> Change </th>";
		while($cRow = mysqli_fetch_array($res))
		{
            
			echo "<tr>";
            		echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";
			echo "<td>". $cRow['3']."</td>";
            		echo '<td><a href = "UpdateCharges.php?stateab='.$cRow['0'].'"> Modify Charges </a></td>';		
			//echo '<td><a href = "http://students.cs.niu.edu/~z1778592/OrderingSystem/ReduceProducts.php?pnumber='.$cRow['0'].'">Reduce</a></td>';					
			//echo '<td><input type="submit" name = "quantity" value = "Update Quantity"/></td>';			
			echo "</tr>";
		}
		echo "</table>";
	}	
 }
    
else
 { 
	$query = "SELECT * FROM additionalCharges;";
	$res = mysqli_query($link,$query);
	$rowCount = mysqli_num_rows($res);
    
	if($rowCount > 0)
	{
		echo "<table border=1 style=width:50%>";
		echo "<th> State </th>";
		echo "<th> Current Tax </th>";
		echo "<th> Current Shipping Charges</th>";
        echo "<th> Current Handling Charges</th>";
		echo "<th> Change </th>";
		while($cRow = mysqli_fetch_array($res))
		{
            
			echo "<tr>";
			echo "<td>". $cRow['0']."</td>";
			echo "<td>". $cRow['1']."</td>";
			echo "<td>". $cRow['2']."</td>";	
            echo "<td>". $cRow['3']."</td>";
            echo "<td><a href = \"UpdateCharges.php?stateab=".$cRow['0']."\" >ModifyCharges </a></td>";		
			//echo '<td><a href = "UpdateCharges.php?stateab="'.$cRow['0'].'">ModifyCharges </a></td>';		
			//echo '<td><a href = "http://students.cs.niu.edu/~z1778592/OrderingSystem/ReduceProducts.php?pnumber='.$cRow['0'].'">Reduce</a></td>';					
			//echo '<td><input type="submit" name = "quantity" value = "Update Quantity"/></td>';			
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
