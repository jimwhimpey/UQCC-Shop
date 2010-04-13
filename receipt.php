<?php

	// Include ADOdb and connect to the DB
	require("./server/adodb5/adodb.inc.php");
	$DB = NewADOConnection('mysql');
	$DB->Connect("localhost", "root", "", "uqshop");
	// $DB->Connect("db.segpub.net", "valhall_us1", "iloveyou182", "valhall_db4");
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$result 		= $DB->Execute("SELECT * FROM orders WHERE id = '" . $_GET['order'] . "'") or die($DB->ErrorMsg());
	$orderRecord	= $result->fields;
	$order			= stripslashes(stripslashes($result->fields['order']));
	$order			= preg_replace('/^\"|\"$/i', "", $order);
	$order			= preg_replace('/Men\'s/i', "Men's", $order);
	$order			= preg_replace('/Women\'s/i', "Women's", $order);
	$order			= json_decode($order);
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		
		<title>UQ Cycle Club Kit Ordering Form</title>
	
		<meta name="robots" content="noindex" />
		
		<link rel="stylesheet" type="text/css" media="screen, projection, print" href="style.css" />
	
		<script src="./scripts/jquery.min.js"></script>
		
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" media="screen, projection" href="ie.css" />
			<script src="./scripts/ddbelated.js"></script>
			<script>
			  /* EXAMPLE */
			  DD_belatedPNG.fix('#header a, .option');
			</script>
		<![endif]-->
	
	</head>

	<body>
		
		<div id="header">
			<a href="http://uqcycle.com" id="logo">UQ Cycle Club</a>
			<p><a href="./">Kit Ordering Form</a></p>
		</div>
		
		<div id="content" class="receipt">

			<p>	Use your order number and your surname as the reference in a bank transfer to the club's 
				back account (Account number 1234567, BSB 123-456, Bank of Qld). Someone will email 
				you when your order is ready to be picked up.</p>
			
			
			<table id="order-meta">
				<tr>
					<td class="label">Order Number</td>
					<td><?php echo $orderRecord['id']; ?></td>
				</tr>
				<tr>
					<td class="label">Order Date</td>
					<td><?php echo date("jS \of F, Y", $orderRecord['date']); ?></td>
				</tr>
				<tr>
					<td class="label">Name</td>
					<td><?php echo $orderRecord['name']; ?></td>
				</tr>
			</table>
			
			
			<table id="order-items">
				
				<tr>
					<th class='item'>Item</th>
					<th class='quantity'>Quantity</th>
					<th class='total'>Total</th>
				</tr>
				
				<?php
					// Hold the current total
					$total = 0;
				
					// Loop through the order spitting out rows
					foreach ($order as $item) {
						
						echo "<tr>";
						
							echo "<td class='item'>" . $item->{'name'} . " ";
							echo "<span>" . $item->{'size'} . " " . $item->{'zipper'} . "</span></td>";
							echo "<td class='quantity'>" . $item->{'quantity'} . "</td>";
							echo "<td class='total'>" . $item->{'quantity'} * $item->{'price'} . "</td>";
						
						echo "</tr>";
						
						$total = $total + ($item->{'quantity'} * $item->{'price'});
						
					}
					
					echo "<tr id='total-price'><td colspan='2' class='total'>Grand Total</td><td class='total'>" . $total . "</td></tr>";
				?>
				
			</table>
			
		</div>
		
	</body>
	
</html>