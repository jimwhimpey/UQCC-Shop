<?php

	// Include ADOdb and connect to the DB
	require("../server/adodb5/adodb.inc.php");
	require("../server/db.php");
	
	ini_set("error_reporting", E_WARNING);
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$orders = $DB->GetAll("SELECT * FROM orders2") or die($DB->ErrorMsg());
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		<title>UQ Cycle Club Kit Orders Printable</title>
		<style type="text/css" media="all">
			
			body {
				font-family: Helvetica, Arial, sans-serif;
				font-weight: bold;
				font-size: 20px;
				width: 1000px;
				margin: 30px;
				}
			
			.row { 
				clear: both;
				width: 100%;
				overflow: hidden;
				border-bottom: 1px solid #999;	
				page-break-inside: avoid;
				}
			
			.label {
				width: 439px;
				float: left;
				padding: 30px;
				border-right: 1px solid #999;
				page-break-inside: avoid;
				}
				
			.even { 
				float: right;
				border-right: none;	
				}
				
			.orderid {
				font-size: 18px;
				font-weight: normal;
				margin: 0 0 3px 0;
				color: #666;
				}
			
			.ordername {
				font-size: 34px;
				}
				
			ul li {
				margin: 0 0 4px 0;
				}
				
			.unpaid { color: #B91921; }
		
			.paid { color: #569340; }
			
		</style>
	</head>

	<body>
		
		<?php
		
			$oddeven = "odd";
		
			// Loop through the order spitting out rows
			foreach ($orders as $order) {
				if ($oddeven == "odd") { echo "<div class='row'>"; }
				echo "<div class='label " . $oddeven . "'>";
					echo "<div class='orderid'>" . $order['id'] . "</div>";
					echo "<div class='ordername'>" . $order['name'] . "</div>";
					
					$items = stripslashes(stripslashes($order['order']));
					$items = preg_replace('/^\"|\"$/i', "", $items);
					$items = preg_replace('/Men\'s/i', "Men's", $items);
					$items = preg_replace('/Women\'s/i', "Women's", $items);
					$items = json_decode($items);
					
					echo "<ul>";
					foreach ($items as $item) {
						echo "<li>" . $item->{'quantity'} . " x " . $item->{'name'} . " (" . $item->{'size'} . ")</li>";						
					}
					echo "</ul>";
					
					if ($order['paid'] == "false") {
						echo "<div class='orderpayment unpaid'>Unpaid</div>";
					} else {
						echo "<div class='orderpayment paid'>Paid</div>";
					}
					
				echo "</div>";
				if ($oddeven == "even") { echo "</div>"; }
				
				if ($oddeven == "odd") { $oddeven = "even"; } else { $oddeven = "odd"; }
				
			}
			
		?>
		
	</body>
	
</html>