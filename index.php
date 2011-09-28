<!DOCTYPE html>

<html lang="en">

	<head>
		
		<title>UQ Cycle Club Kit Ordering Form</title>

		<?php require("./includes/head.php"); ?>
	
		<script type="text/javascript" charset="utf-8">
	
			$(function(){
				// Calculate the time left to order
				var closing = new Date(2011, 10, 1, 1, 1, 1, 1).getTime();
				var current = new Date().getTime();
				var secondsDifference = Math.round(closing - current);
				var daysLeft = Math.round(secondsDifference/1000/60/60/24);
				var daysLeftString = (daysLeft > 1) ? daysLeft + " days" : daysLeft + " day";
				$(".explanation span span").text(daysLeftString);
			});
	
		</script>
	
	</head>

	<body>
		
		<?php require("./includes/header.php"); ?>
		
		<div id="content">
			
			<div class="closed">
				Orders Closed
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
			
			
			<p class="explanation">After placing your order you'll be given an order number which must 
				be used as the reference in a bank transfer to the club's account. We'll email when your 
				order is ready. <span>Orders close in <span></span></span>.</p>
			
			
			
			
			
			<div id="kit-order">
				
				<h2>Your Order</h2>
				
				<table>
					<tr id="no-items"><td>No items yet.</td></tr>
				</table>
				
				<form action="./server/place-order.php" method="post">
				
					<div id="personal-details">
					
						<input type="hidden" name="order-field" value='' id="order-field" />
					
						<p><label for="name">Your Name:</label>
							<input type="text" name="name" id="name" value="" /></p>
					
						<p><label for="email">Your Email Address:</label>
							<input type="text" name="email" id="email" value="" /></p>
					
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
						<img src="./images/inventory/jersey.png" alt="Short Sleeve Jersey" />
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
						<img src="./images/inventory/jersey.png" alt="Short Sleeve Jersey" />
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
						<img src="./images/inventory/bibs.png" alt="Bib Knicks" />
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
						<img src="./images/inventory/bibs.png" alt="Bib Knicks" />
					</a>
					
				</div>
				
				
			
				
				
				
				
				
				
			</div>
			
			
			
			
		</div>
		
		
		<p class="sizing"><a href="http://tineli.com.au/custom-design-clothing/size-guide.php">See here for sizing information</a></p>
		
		
		<?php require("./includes/footer.php"); ?>
		
	</body>
	
</html>