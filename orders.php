<?php

	// Include ADOdb and connect to the DB
	require("./server/adodb5/adodb.inc.php");
	require("./server/db.php");
	
	// Get this order's record
	$DB->SetFetchMode(ADODB_FETCH_ASSOC);
	$orders = $DB->GetAll("SELECT * FROM orders") or die($DB->ErrorMsg());
	
	// I get a warning otherwise
	date_default_timezone_set("Australia/Brisbane");

?>

<!DOCTYPE html>

<html lang="en">

	<head>
		
		<title>UQ Cycle Club Kit Orders</title>
	
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
			<p><a href="./">Orders</a></p>
		</div>
		
		<div id="content" class="orders">			
			
			<table border="0" cellspacing="5" cellpadding="5">
				<tr>
					<th>Order ID</th>
					<th>Date</th>
					<th>Name</th>
				</tr>
				
				<?php
				
					// Loop through the order spitting out rows
					foreach ($orders as $order) {
						echo "<tr>";
							echo "<td><a href='receipt.php?order=" . $order['id'] . "'>" . $order['id'] . "</a></td>";
							echo "<td>" . date("d/m/y", $order['date']) . "</td>";
							echo "<td>" . $order['name'] . "</td>";
						echo "</tr>";
					}
						
				?>
				
			</table>
			
		</div>
		
		<div id="footer">Made by <a href="http://jimwhimpey.com">Jim Whimpey</a></div>
		
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-15817175-1");
		pageTracker._trackPageview();
		} catch(err) {}</script>
		
	</body>
	
</html>