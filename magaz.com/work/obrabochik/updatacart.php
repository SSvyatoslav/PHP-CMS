<?php 
	session_start();
	include_once '/domains/magaz.com/work/function.php';

	foreach ($_GET as $key => $value) {
		foreach ($_SESSION['cart'] as $id => $quantity){
			$product = get_product($id);

			if($product['id'] == $key){
				$quantity = $value;
				$_SESSION['cart'][$product['id']] = $quantity ;

				if($quantity == 0){
					unset($_SESSION['cart'][$id]);
				}
			} 

		}

	}
	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://magaz.com/page/cart.php'></HEAD></HTML>";
