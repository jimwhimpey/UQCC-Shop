<?php

	// Include ADOdb and connect to the DB
	require("../server/adodb5/adodb.inc.php");
	require("../server/db.php");
	
	ini_set("error_reporting", E_WARNING);
	
	// Change payment status
	if ($_GET['paid'] != "") {
		$DB->Execute("UPDATE " . $table . " SET paid = 'true' WHERE id = '" . $_GET['paid'] . "'");
	} else if ($_GET['unpaid'] != "") {
		$DB->Execute("UPDATE " . $table . " SET paid = 'false' WHERE id = '" . $_GET['unpaid'] . "'");
	}
	
	// Changed collected status
	if ($_GET['collect'] != "") {
		$DB->Execute("UPDATE " . $table . " SET collected = 'true' WHERE id = '" . $_GET['collect'] . "'");
	}
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$orders = $DB->GetAll("SELECT * FROM " . $table) or die($DB->ErrorMsg());
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");
	
	

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<title>UQ Cycle Club Kit Orders</title>
		<?php require("../includes/head.admin.php"); ?>
	</head>

	<body>
		
		<?php require("../includes/header.php"); ?>
		
		<div id="content" class="orders">	
			
			<h2>All Orders</h2>
			
			<table border="0" cellspacing="5" cellpadding="5">
				<tr>
					<th class='orderid'>Order ID</th>
					<th class='orderdate'>Date</th>
					<th class='ordername'>Name</th>
					<th class='orderpayment'>Payment Status</th>
				</tr>
				
				<?php
				
					// Loop through the order spitting out rows
					foreach ($orders as $order) {
						if ($order['collected'] == NULL) {
							echo "<tr>";
						} else {
							echo "<tr class='collected'>";
						}
							echo "<td class='orderid'><a href='../receipt.php?order=" . $order['id'] . "'>" . $order['id'] . "</a></td>";
							echo "<td class='orderdate'>" . date("d/m/y", $order['date']) . "</td>";
							echo "<td class='ordername'><a href='mailto:" . $order['email'] . "'>" . $order['name'] . "</a></td>";
							if ($order['paid'] == "false") {
								echo "<td class='orderpayment unpaid'><a href='./orders.php?paid=" . $order['id'] . "'>Unpaid</a></td>";
							} else {
								echo "<td class='orderpayment paid'><a href='./orders.php?unpaid=" . $order['id'] . "'>Paid</a></td>";
							}
						echo "</tr>";
					}
						
				?>
				
			</table>
			
		</div>
		
		<?php require("../includes/footer.php"); ?>
		
	</body>
	
</html>