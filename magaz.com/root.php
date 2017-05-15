<?php 
	/*ЧПУ*/
	include_once '/work/function.php';


	if($_GET){
		return $_SERVER['REQUEST_URI'];
	}
	else{
		switch ($_SERVER['REQUEST_URI']) {
			case '/page/tovar':
				include_once("/page/tovar.php");
				break;
			case '/tovar':
				include_once("/page/tovar.php");
				break;

			case '/page/kontakti':
				include_once("/page/kontakti.php");
				break;
			case '/kontakti':
				include_once("/page/kontakti.php");
				break;

			case '/page/cart':
				include_once("/page/cart.php");
				break;
			case '/cart':
				include_once("/page/cart.php");
				break;

			case '/page/updatacart':
				include_once("/page/updatacart.php");
				break;
			case '/page/updatacart.php':
				include_once("/page/updatacart.php");
				break;

			default:
				include_once("index.php");
				break;
		}
	}
 ?>