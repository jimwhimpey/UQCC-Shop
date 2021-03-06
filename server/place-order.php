<?php
	
	// Include ADOdb and number generator
	require("./adodb5/adodb.inc.php");
	require("./order-number-generator.php");
	require("./db.php");
	
	// If there's no username, email or order don't do anything
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['order-field']) || empty($_POST['address']) || empty($_POST['suburb']) || empty($_POST['postcode'])) {
		die("Order error: Missing order details, go back and do it again.");
	}
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");
	
	// Grab all the vars we'll insert into the DB
	$record['id']				= generateOrderNumber();
	$record['date']			= time();
	$record['name']			= mysql_real_escape_string($_POST['name']);
	$record['email']		= mysql_real_escape_string($_POST['email']);
	$record['order']		= mysql_real_escape_string(json_encode($_POST['order-field']));
	$record['paid']			= "false";
	$record['address']	= mysql_real_escape_string($_POST['address']);
	$record['suburb']		= mysql_real_escape_string($_POST['suburb']);
	$record['postcode']	= mysql_real_escape_string($_POST['postcode']);
	$record['state']		= mysql_real_escape_string($_POST['state']);

	// Insert them all into the DB
	$SQL = "INSERT INTO orders2 VALUES ('" . $record['id'] . "', " . $record['date'] . ", '" . $record['name'] . "', '" . $record['email'] . "', '" . $record['order'] . "', 'false', '" . $record['address'] . "', '" . $record['suburb'] . "', '" . $record['postcode'] . "', '" . $record['state'] . "')";
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
	// Add shipping to the total
	$total = $total + 8;
	$orderOutput .= "==================================================\n\n";
	$orderOutput .= "Shipping: $8\n\n"; 
	$orderOutput .= "Order total: $" . $total . "\n\n"; 
	$orderOutput .= "==================================================\n\n";
	
	// Prepare shipping details
	$shippingContent = "Shipping to:\n\n";
	$shippingContent .= $record['name'] . "\n";
	$shippingContent .= $record['address'] . "\n";
	$shippingContent .= $record['suburb'] . "\n";
	$shippingContent .= $record['state'] . ", " . $record['postcode']  . "\n\n";
	
	// Compose and send an email to the buyer
	$buyerContent = "Thanks for placing an order for UQ Cycle Club kit.\n\n";
	$buyerContent .= "Your order is as follows: \n\n";
	$buyerContent .= $orderOutput;
	$buyerContent .= $shippingContent;
	$buyerContent .= "Please pay for your order with a bank transfer to the club's account:\n\n";
	$buyerContent .= "Account Name: UNIVERSITY OF QUEENSLAND CYCLING CLUB\n";
	$buyerContent .= "Account Number: 00911144\n";
	$buyerContent .= "BSB: 064-158\n";
	$buyerContent .= "Reference: " . $record['id'] . " and your surname\n\n";
	$buyerContent .= "We'll ship your order to you when it's ready.\n\n";
	$buyerContent .= "UQ Cycle Club";
	
	// Compose and send an email to the exec
	$execContent = "An order has been placed via the kit order form.\n\n";
	$execContent .= "Name: " . $record['name'] . "\n";
	$execContent .= "Email: " . $record['email'] . "\n";
	$execContent .= "Date: " . date("g:ia d/m/y") . "\n\n";
	$execContent .= "Order details: \n\n";
	$execContent .= $orderOutput;
	$execContent .= $shippingContent;
	$execContent .= "Thanks,\n\n";
	$execContent .= "The Kit Order Robot";
	
	// Actually mail this stuff out the the peeps
	mail($record['email'], "Kit Order " . $record['id'], $buyerContent, "From:UQCC Shop<tech@uqcycle.com>");
	mail("tech@uqcycle.com", "Kit Order " . $record['id'], $execContent, "From:UQCC Shop<tech@uqcycle.com>");
	// mail("scott.dobeli@bigpond.com.au", "Kit Order " . $record['id'], $execContent, "From:UQCC Shop<tech@uqcycle.com>");
	
	// Redirect them to a confirmation page with their order ID
	header("Location: ../receipt.php?order=" . $record['id']);
	
?>