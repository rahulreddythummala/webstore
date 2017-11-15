
<html>
<?php 
error_reporting(0);
?>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Product System</title>
</head>
<body>
<div id="page">
		
	<div id="banner">
<img style="display: inline;" src="fast.jpg" ; align=right />
			<br><br><br><h1><b>Auto Parts </b></h1><br><br>

		</div>
		
		<div id="nav">
			<ul>

			</ul>	
		</div>
<div>
<br>
</div>
		<div id="content">
<h2><b>Add Products to Inventory :</b></h2>
<?php
include 'LocalhostConnection.php';
//session_start();
if($_GET['stateab'])
{
	$stateab = $_GET['stateab'];
	//$_SESSION['stateab'] = $stateab;
}
	echo '<form action="" method="post">';
	echo 'Modify Shipping Charges:&nbsp; <input type = "text" name = "shippingCharges">';
	echo '<br>';
	echo '<br>';
    	echo 'Modify Handling Charges:&nbsp; <input type = "text" name = "handlingCharges">';
	echo '<br>';
	echo '<br>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type = "submit"  name="change" value = "Modify">';
	echo '</form>';
//$existing = 'SELECT taxRate,shippingCharges FROM taxrates WHERE stateName = "'.$_SESSION['stateab'].'";';
  
            $existing ="SELECT shipping_charge,handling_charge FROM additionalCharges WHERE state_name='.$stateab.';";
            //echo $existing;
$data = mysqli_query($link,$existing);
$cRow = $data->fetch_array(MYSQLI_NUM);	

//$tax = $cRow['0'];
$ship = $cRow['1'];
$handling=$cRow['2'];           

$shipC=$_POST['shipping_charge'];
//$taxC=$_POST['taxRate'];
$handlingC=$_POST['handling_charge'];
            
isset($_POST['submit']);
            
/* if (isset($_POST['taxRate']))    
{    
     if($taxC!=""){
	$tax = $_POST['taxRate'];   
     }
     else
     {
       $tax = $cRow['0'];  
     }
}*/
if (isset($_POST['shipping_charge']))    
{   
    if($shipC!="")
    { 
	$ship = $_POST['shipping_charge'];  }
    else{
       $ship = $cRow['1'];  
    }
}
            
if (isset($_POST['handling_charge']))    
{   
    if($handlingC!=""){
	$handling = $_POST['handling_charge'];   }
    else{
      $handling=$cRow['2'];   
    }
}
 
if (isset($_POST['change']))
{
$query = "update additionalCharges set shipping_charge = '.$ship.',handling_charge = '.$handling.' WHERE state_name = '.$stateab.';";
          //  echo $query;
	$res = mysqli_query($link,$query);
	//$rowCount = mysqli_num_rows($res);	
	if($res)
	{
		echo 'Charges updated successfully';
	}	
         else
		echo "Try again";
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
