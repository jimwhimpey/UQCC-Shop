<?php

	// Include ADOdb and connect to the DB
	require("../server/adodb5/adodb.inc.php");
	require("../server/db.php");
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$result 		= $DB->Execute("SELECT * FROM orders1 WHERE id = '" . $_GET['order'] . "'") or die($DB->ErrorMsg());
	
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
		<title>UQ Cycle Club Kit Ordering Form - Receipt</title>
		<?php require("../includes/head.admin.php"); ?>
		<style type="text/css" media="screen">
			#footer { width: 700px; }
		</style>
	</head>

	<body>
		
		<?php require("../includes/header.php"); ?>
		
		<div id="content" class="receipt">

			<div id="bank">
				
				<p>	Use your <strong>order number and your surname</strong> as the reference in a bank transfer to the club's 
					back account:</p>
				
				<ul>
					<li>Account Name: <strong>UNIVERSITY OF QUEENSLAND CYCLING CLUB</strong></li>
					<li>Account Number: <strong>00911144</strong></li>
					<li>BSB: <strong>064-158</strong></li>
				</ul>
				
				<p>You will be emailed when your order is ready to be picked up.</p>
					
			</div>
			
			
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
				<tr>
					<td class="label">Email</td>
					<td><?php echo $orderRecord['email']; ?></td>
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
							echo "<span>" . $item->{'size'} . "</span></td>";
							echo "<td class='quantity'>" . $item->{'quantity'} . "</td>";
							echo "<td class='total'>" . number_format($item->{'quantity'} * $item->{'price'}, 2) . "</td>";
						
						echo "</tr>";
						
						$total = number_format($total + ($item->{'quantity'} * $item->{'price'}), 2);
						
					}
					
					echo "<tr id='total-price'><td colspan='2' class='total'>Grand Total</td><td class='total'>" . $total . "</td></tr>";
				?>
				
			</table>
			
		</div>
		
		<?php require("../includes/footer.php"); ?>
		
	</body>
	
</html>