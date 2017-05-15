<?php 
	include_once '../function.php';

	//удаляем товар
	if (isset($_GET['delete_tovar'])){
		$query="DELETE FROM product
		WHERE id='$_GET[key]' ";
	
		$resulti=$link->query($query);
		echo mysqli_error($link);	
		echo "<HTML><HEAD>
			<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://magaz.com/page/tovar.php'>
		</HEAD></HTML>"; 
	}

	//удаляем с корзины
	$id = $_GET['id'];
	if($id){
		unset($_SESSION['cart'][$id]);
	}
	header("Location: http://magaz.com/page/cart.php"); 
	exit;
