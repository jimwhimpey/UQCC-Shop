<?php

	// Include ADOdb and connect to the DB
	require("./server/adodb5/adodb.inc.php");
	require("./server/db.php");
	
	// Change payment status
	if ($_GET['paid'] != "") {
		$DB->Execute("UPDATE " . $table . " SET paid = 'true' WHERE id = '" . $_GET['paid'] . "'");
	} else if ($_GET['unpaid'] != "") {
		$DB->Execute("UPDATE " . $table . " SET paid = 'false' WHERE id = '" . $_GET['unpaid'] . "'");
	}
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$orders = $DB->GetAll("SELECT * FROM orders1") or die($DB->ErrorMsg());
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");
	
	

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<title>UQ Cycle Club Kit Orders</title>
		<?php require("./includes/head.php"); ?>
	</head>

	<body>
		
		<?php require("./includes/header.php"); ?>
		
		<div id="content" class="orders">			
			
			<h2>All Orders</h2>
			
			<table border="0" cellspacing="5" cellpadding="5">
				<tr>
					<th>Order ID</th>
					<th>Date</th>
					<th>Name</th>
					<th>Payment Status</th>
				</tr>
				
				<?php
				
					// Loop through the order spitting out rows
					foreach ($orders as $order) {
						echo "<tr>";
							echo "<td><a href='receipt.php?order=" . $order['id'] . "'>" . $order['id'] . "</a></td>";
							echo "<td>" . date("d/m/y", $order['date']) . "</td>";
							echo "<td><a href='mailto:" . $order['email'] . "'>" . $order['name'] . "</a></td>";
							if ($order['paid'] == "false") {
								echo "<td class='unpaid'><a href='./orders.php?paid=" . $order['id'] . "'>Unpaid</a></td>";
							} else {
								echo "<td class='paid'><a href='./orders.php?unpaid=" . $order['id'] . "'>Paid</a></td>";
							}
						echo "</tr>";
					}
						
				?>
				
			</table>
			
		</div>
		
		<?php require("./includes/footer.php"); ?>
		
	</body>
	
</html>