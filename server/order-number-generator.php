<?php

	// Function for generating a random string
	function generateOrderNumber() {
		echo "test";
		$orderNumber 	= "";
		$possible 		= "23456789ABCDEFGHJKMNPQRSTUVWXYZ"; 
		$i 				= 0; 
		while ($i < 6) { 
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			if (!strstr($password, $char)) { 
				$orderNumber .= $char;
				$i++;
			}
		}
		return $orderNumber;
	}

?>