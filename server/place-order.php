<?php
	
	// Include ADOdb and number generator
	require("./adodb5/adodb.inc.php");
	require("./order-number-generator.php");
	require("./db.php");
	
	// If there's no username, email or order don't do anything
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['order-field'])) {
		die("Order error: Either no name, email or order. How did you get here?!");
	}
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");
	
	// Grab all the vars we'll insert into the DB
	$record['id']		= generateOrderNumber();
	$record['date']		= time();
	$record['name']		= mysql_real_escape_string($_POST['name']);
	$record['email']	= mysql_real_escape_string($_POST['email']);
	$record['order']	= mysql_real_escape_string(json_encode($_POST['order-field']));

	// Insert them all into the DB
	$SQL = "INSERT INTO orders1 VALUES ('" . $record['id'] . "', " . $record['date'] . ", '" . $record['name'] . "', '" . $record['email'] . "', '" . $record['order'] . "', 'false')";
	$DB->Execute($SQL) or die($DB->ErrorMsg());
	
	// Create the order output
	$order	 = stripslashes(stripslashes(stripslashes($record['order'])));
	$order	 = preg_replace('/^\"|\"$/i', "", $order);
	$order	 = preg_replace('/Men\'s/i', "Men's", $order);
	$order	 = preg_replace('/Women\'s/i', "Women's", $order);
	$order	 = json_decode($order);

	// Hold the current total and the order
	$total			= 0;
	$orderOutput	= "==================================================\n\n";
	// Loop through the order spitting out rows
	foreach ($order as $item) {
		$orderOutput .= "Item: " . $item->{'name'} . " - " . $item->{'size'} . " \n";
		$orderOutput .= "Quantity: " . $item->{'quantity'} . "\n";
		$orderOutput .= "Total: $" . $item->{'quantity'} * $item->{'price'} . "\n\n";
		$total = $total + ($item->{'quantity'} * $item->{'price'});	
	}
	$orderOutput .= "==================================================\n\n";
	$orderOutput .= "Order total: $" . $total . "\n\n"; 
	$orderOutput .= "==================================================\n\n";
	
	// Compose and send an email to the buyer
	$buyerContent = "Thanks for placing an order for UQ Cycle Club kit.\n\n";
	$buyerContent .= "Your order is as follows: \n\n";
	$buyerContent .= $orderOutput;
	$buyerContent .= "Please pay for your order with a bank transfer to the club's account:\n\n";
	$buyerContent .= "Account Name: UNIVERSITY OF QUEENSLAND CYCLING CLUB\n";
	$buyerContent .= "Account Number: 00911144\n";
	$buyerContent .= "BSB: 064-158\n";
	$buyerContent .= "Reference: " . $record['id'] . " and your surname\n\n";
	$buyerContent .= "We'll be in touch when your order is ready to be picked up.\n\n";
	$buyerContent .= "UQ Cycle Club";
	
	// Compose and send an email to the exec
	$execContent = "An order has been placed via the kit order form.\n\n";
	$execContent .= "Name: " . $record['name'] . "\n";
	$execContent .= "Email: " . $record['email'] . "\n";
	$execContent .= "Date: " . date("g:ia d/m/y") . "\n\n";
	$execContent .= "Order details: \n\n";
	$execContent .= $orderOutput;
	$execContent .= "Thanks,\n\n";
	$execContent .= "The Kit Order Robot";
	
	// Actually mail this stuff out the the peeps
	mail($record['email'], "Kit Order " . $record['id'], $buyerContent, "From:UQCC Shop<tech@uqcycle.com>");
	mail("jimwhimpey@me.com", "Kit Order " . $record['id'], $execContent, "From:UQCC Shop<tech@uqcycle.com>");
	
	// Redirect them to a confirmation page with their order ID
	header("Location: ../receipt.php?order=" . $record['id']);
	
?>