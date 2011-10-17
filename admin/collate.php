<?php

	// Include ADOdb and connect to the DB
	require("../server/adodb5/adodb.inc.php");
	require("../server/db.php");
	
	ini_set("error_reporting", E_WARNING);
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	// $orders = $DB->GetAll("SELECT * FROM " . $table . " WHERE paid = 'true'");
	$orders = $DB->GetAll("SELECT * FROM " . $table);
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");

	// Make sure there's orders
	if (count($orders) > 0) {

		// Var to hold the collated items
		$collated_items = array();

		// Loop through the orders inserting them into 3D arrays as items are found
		foreach ($orders as $order) {
	
			// Process the order
			$order = stripslashes(stripslashes($order['order']));
			$order = preg_replace('/^\"|\"$/i', "", $order);
			$order = preg_replace('/Men\'s/i', "Men's", $order);
			$order = preg_replace('/Women\'s/i', "Women's", $order);
			$order = json_decode($order);
		
			// Loop through the order
			foreach ($order as $item) {
				$collated_items[$item->name][$item->size] = $collated_items[$item->name][$item->size] + $item->quantity;
			}
		
		}
		
	}

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<title>UQ Cycle Club Kit Collated Orders</title>
		<?php require("../includes/head.admin.php"); ?>
	</head>

	<body>
		
		<?php require("../includes/header.php"); ?>
		
		<div id="content" class="collation">			
			
			<h2>Collated Orders</h2>

			<?php
				
				// Loop through the types
				foreach ($collated_items as $item => $value) {
					
					echo "<h3>" . $item . "</h3>";
					
					echo "<ul>";
					// Loop through the sizes
					foreach ($value as $size => $size_value) {
						echo "<li>" . $size . " - " . $size_value . "</li>";
					}					
					echo "</ul>";
					
				}
					
			?>
			
		</div>
		
		<?php require("../includes/footer.php"); ?>
		
	</body>
	
</html>