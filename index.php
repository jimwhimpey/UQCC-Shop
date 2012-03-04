<!DOCTYPE html>

<html lang="en">

	<head>
		
		<title>UQ Cycle Club Kit Ordering Form</title>

		<?php require("./includes/head.php"); ?>
		
		<link rel="stylesheet" href="styles/closed.css" type="text/css" media="screen" />
	
		<script type="text/javascript" charset="utf-8">
	
			$(function(){
				// Calculate the time left to order
				var closing = new Date(2011, 10, 1, 1, 1, 1, 1).getTime();
				var current = new Date().getTime();
				var secondsDifference = Math.round(closing - current);
				var daysLeft = Math.round(secondsDifference/1000/60/60/24);
				var daysLeftString = (daysLeft > 1) ? daysLeft + " days" : daysLeft + " day";
				$(".explanation span span").text(daysLeftString);
				
				// if (daysLeft < 0) {
				// 					$(".closed").show();
				// 					$(".explanation, #kit-order, #kit-options, .sizing").hide();
				// 				}
				
			});
	
		</script>
	
	</head>

	<body>
		
		<?php require("./includes/header.php"); ?>
		
		<div class="blurb">
			<p>After placing your order you'll be given an order number which must 
				be used as the reference in a bank transfer to the club's account. We'll <strong>ship your order
				to you</strong> when it's ready.</p>
		</div>
		
		
		<div id="content">
			
			<div class="closed">
				Orders closed for now
			</div>
			
			<noscript>
			
				<p class="noscript">It looks like you don't have Javascript turned on which is required for this 
					site to work properly. For instructions on how to enable Javascript, 
					select your browser from <a href="http://www.google.com/support/websearch/bin/answer.py?hl=en&amp;answer=23852">
					this list</a>.</p>
			
					<style type="text/css" media="screen">
						
						.explanation,
						#kit-order,
						#kit-options {
							display: none;
							}
						
					</style>
			
			</noscript>
			
			
			
			<div id="kit-order">
				
				<h2>Your Order</h2>
				
				<table>
					<tr id="no-items"><td>No items yet.</td></tr>
				</table>
				
				<form action="./server/place-order.php" method="post">
				
					<div id="personal-details">
						
						<h3>Personal Details</h3>
					
						<input type="hidden" name="order-field" value='' id="order-field" />
					
						<p><label for="name">Your Name:</label>
							<input type="text" name="name" id="name" value="" /></p>
					
						<p><label for="email">Your Email Address:</label>
							<input type="text" name="email" id="email" value="" /></p>
					
					</div>
					
					<div id="shipping-information">
						
						<h3>Shipping Information</h3>
					
						<p><label for="address">Address:</label>
							<input type="text" name="address" id="address" value="" /></p>
					
						<p><label for="suburb">Suburb:</label>
							<input type="text" name="suburb" id="suburb" value="" /></p>
							
						<p><label for="postcode">Postcode:</label>
							<input type="text" name="postcode" id="postcode" value="" /></p>
						
						<p>	<label for="state">State:</label>
							<select name="state">
								<option value="Queensland">Queensland</option>
								<option value="New South Wales">New South Wales</option>
								<option value="Victoria">Victoria</option>
								<option value="Tasmania">Tasmania</option>
								<option value="South Australia">South Australia</option>
								<option value="Western Australia">Western Australia</option>
								<option value="Australian Capital Territory">Australian Capital Territory</option>
								<option value="Northern Territory">Northern Territory</option>
							</select></p>
					
					</div>
					
					<div id="shipping-price">
						<p>Australia Post Standard Shipping: <span>$6</span></p>
					</div>
					
				
					<p id="place-order">					
						<a href="#">Place Order</a>
						<span id="order-total">Total: <span></span></span>
					</p>
				
					<p id="clear-order">
						<a href="#">Clear Order</a>
					</p>
				
				</form>
				
			</div>
			
			
			
			
			
			
			<div id="kit-options">
				
				
				
				
				
				
				<div class="option">
					
					<h2><span>Men's Jersey</span> <span class="price">($80)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="XXX Large">XXX Large</option>
								<option value="XX Large">XX Large</option>
								<option value="X Large">X Large</option>
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
								<option value="X Small">X Small</option>
							</select></p>
							
						<p class="cut">	<label for="cut">Cut:</label>
							<select name="cut">
								<option value="Club Cut">Club Cut</option>
								<option value="Race Cut">Race Cut</option>
							</select></p>
						
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
							
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/jersey.png" class="image">
						<img src="./images/inventory/jersey.png" alt="Short Sleeve Jersey" width="150" height="150" />
					</a>
					
				</div>
				
				
				
				
				
				<div class="option">
					
					<div class="image"></div>
					<h2><span>Women's Jersey</span> <span class="price">($80)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="XXX Large">XXX Large</option>
								<option value="XX Large">XX Large</option>
								<option value="X Large">X Large</option>
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
								<option value="X Small">X Small</option>
							</select></p>
							
						<p class="cut">	<label for="cut">Cut:</label>
							<select name="cut">
								<option value="Club Cut">Club Cut</option>
								<option value="Race Cut">Race Cut</option>
							</select></p>
						
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
							
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/jersey.png" class="image">
						<img src="./images/inventory/jersey.png" alt="Short Sleeve Jersey"  width="150" height="150" />
					</a>
					
				</div>
				
				
				
								
				
				
				
				
				
				<div class="option">
					
					<div class="image"></div>
					<h2><span>Men's Bib Knicks</span> <span class="price">($90)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="XXX Large">XXX Large</option>
								<option value="XX Large">XX Large</option>
								<option value="X Large">X Large</option>
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
								<option value="X Small">X Small</option>
							</select></p>
							
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
						
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/bibs.png" class="image">
						<img src="./images/inventory/bibs.png" alt="Bib Knicks" width="150" height="150" />
					</a>
					
				</div>
				
				
				
				
				
				
				
				
				<div class="option">
					
					<div class="image"></div>
					<h2><span>Women's Bib Knicks</span> <span class="price">($90)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="XXX Large">XXX Large</option>
								<option value="XX Large">XX Large</option>
								<option value="X Large">X Large</option>
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
								<option value="X Small">X Small</option>
							</select></p>
							
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
						
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/bibs.png" class="image">
						<img src="./images/inventory/bibs.png" alt="Bib Knicks"  width="150" height="150" />
					</a>
					
				</div>
				
				
				
				
				
				
				
				<div class="option">
					
					<div class="image"></div>
					<h2><span>Arm Warmers</span> <span class="price">($30)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
							</select></p>
							
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
						
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/armwarmers.png" class="image">
						<img src="./images/inventory/armwarmers.png" alt="Arm Warmers"  width="150" height="150" />
					</a>
					
				</div>
				
				
				
				
				
				
				
				<div class="option">
					
					<div class="image"></div>
					<h2><span>Shoe Covers</span> <span class="price">($30)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
							</select></p>
							
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
						
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/shoecovers.png" class="image">
						<img src="./images/inventory/shoecovers.png" alt="Shoe Covers"  width="150" height="150" />
					</a>
					
				</div>
				
				
				
				
				
				
				<div class="option">
					
					<div class="image"></div>
					<h2><span>Socks (Defeet 5 inch cuff)</span> <span class="price">($15)</span></h2>
					
					<div class="options">
						
						<p>	<label for="size">Size:</label>
							<select name="size">
								<option value="Large">Large</option>
								<option value="Medium" selected="selected">Medium</option>
								<option value="Small">Small</option>
							</select></p>
							
						<p class="quantity"><label for="quantity">Quantity:</label>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select></p>
						
						<p class="add-to-order"><a href="#">Add to Order</a></p>
						
					</div>
					
					<a href="./images/inventory/large/socks.png" class="image">
						<img src="./images/inventory/socks.png" alt="Socks"  width="150" height="150" />
					</a>
					
				</div>
				
			
				
				
				
				
				
				
			</div>
			
			
			
			
		</div>
		
		
		<p class="sizing"><a href="http://tineli.com.au/custom-design-clothing/size-guide.php">See here for sizing information</a></p>
		
		
		<?php require("./includes/footer.php"); ?>
		
	</body>
	
</html>