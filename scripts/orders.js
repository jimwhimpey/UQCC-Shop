$(function(){
	
	// On the page load setup the JSON object to hold the order
	var order = new Object();	
	
	// Event listener for adding to the order
	$(".add-to-order a").click(function(){
	
		// Get our variables
		var name		= $(this).parent().parent().parent().find("h2 span:first-child").text();
		var price		= $(this).parent().parent().parent().find("h2 span.price").text();
		var size		= $(this).parent().parent().parent().find("select[name=size] option:selected").text();
		if ($(this).parent().parent().parent().find("select[name=cut]").length > 0) {
			size = $(this).parent().parent().parent().find("select[name=size] option:selected").text() + " - " + $(this).parent().parent().parent().find("select[name=cut] option:selected").text();
		}
		var quantity	= $(this).parent().parent().parent().find("select[name=quantity] option:selected").text();
		
		// Get the raw price number
		price = price.replace(/^\(\$|\)/g, "");
		
		// Add them all to a JSON object
		var item	= {	"name": 	name,
						"price": 	price,
						"size": 	size,
						"quantity": quantity
						};
							
		// Find out how many items are in the order and add this item
		// to the next slot.
		var orderSize 	= countProperties(order);
		var nextSlot	= orderSize + 1
		
		// Add the item to the order array
		order[nextSlot] = item;
		
		// Add the value to a hidden form field
		$("#order-field").attr("value", JSON.stringify(order));
		
		// Calculate the order total and insert it into the page
		var total = 0;
		for (var orderItem in order) {
			total = total + (order[orderItem].quantity * order[orderItem].price);
		}
		
		// Add the shipping price
		total = total + 6;
		$("#order-total span").text("$" + total.toFixed(2));
		
		// If the no items row is still in there then we 
		// want to get rid of it and add headings.
		if ($("#no-items").length > 0) {
			$("#no-items").remove();
			$("#order-total").show();
			$("#clear-order").show();
			$("#kit-order table").append("<tr><th class='item'>Item</th><th class='qty'>Qty</th><th class='total'>Total</th></tr>");
		}
		
		// Scroll up to the order form
		$('html, body').animate({
			scrollTop: $("#kit-order").offset().top - 30
		}, 1000);
		
		
		// Add the item to the order visually
		$("#kit-order table").append("<tr><td class='item'>" + item.name + " <span>" + item.size + "</span></td><td class='qty'>" + item.quantity + "</td><td class='total'>" + (item.quantity * item.price).toFixed(2) + "</td></tr>");
		$("#kit-order table tr:last-child td").css("backgroundColor", "#FF6").animate({"backgroundColor": "#FFF"}, 2000);
		
		// Fade the background colour off everything, sometimes they get stuck
		$("#kit-order table tr td").animate({"backgroundColor": "#FFF"}, 2000);
		
		// Kill default behaviour
		return false;
		
	});
	
	// Event Listener for clearing the order
	$("#clear-order a").click(function(){
	
		$("#kit-order table tr").remove();
		$("#kit-order table").append('<tr id="no-items"><td>No items yet.</td></tr>');
		$("#order-total").hide();
		$("#clear-order").hide();
		$("#order-field").attr("value", "");
		$("#order-total span").text("");
		var total = 0;
		order = new Object();
		return false;
		
	});
	
	// Event listener for when a user clicks Place Order
	$("#place-order a").click(function(){
		processOrder();
		return false;
	});
	
	// Process the order form
	function processOrder() {
		// Check if they have some content in the order 
		// and that they've filled out their name and email address
		if (order[1] == undefined) {
			alert("You can't order nothing!");
		} else {
			if ($("#kit-order input#name").attr("value") == "" || $("#kit-order input#email").attr("value") == "" || $("#kit-order input#address").attr("value") == "" || $("#kit-order input#suburb").attr("value") == "" || $("#kit-order input#postcode").attr("value") == "") {
				alert("You must fill out ALL personal and shipping information. We will be shipping all orders, there is no option for pickup.");
			} else {
				$("#kit-order form").submit();
			}
		}
	}
	
});