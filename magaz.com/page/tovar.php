<?php
	error_reporting(0);
	$a="ТОВАРЫ";
	header('Content-Type: text/html; charset=utf-8');
	include_once '../work/function.php';
	HEADERA($a);

	// кнопка добавления товара которая ведёт в скрипт с добавлением
	if($_SESSION['admin']){ 
		echo '<form enctype="multipart/form-data" action="../work/obrabochik/add.php" method="POST">';
		echo 	'<input type="submit" value="Добавить товар" />';
		echo '</form>';
	}
	//товары)
	product();
		//корзина
	if (isset($_GET['add_to_cart'])){
		echo "добавленно в корзину!";
		$id = $_GET['id'];
		$add_item = add_to_cart($id);		 	
	 }