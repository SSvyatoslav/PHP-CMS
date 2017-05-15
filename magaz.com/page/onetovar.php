<?php
	session_start();
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

	
	show_one_product($_GET['id']);