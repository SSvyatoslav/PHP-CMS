<?php
	session_start();

	define('DB_HOST', '127.0.0.1');
	define('DB_LOGIN', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'magaz');
	define('ORDERS_LOG', 'orders.log');
	$basket = [];
	$count = 0;
	$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

	if(!isset($_SESSION['cart'])){
		 $_SESSION['cart'] = array();
		 $_SESSION['total_items'] = 0;
		 $_SESSION['total_price'] = '0.00';
	}
	
	// все функция сайта

	function db_connect(){
	 	$host = '127.0.0.1';
	 	$user = 'root';
	 	$pswd = '';
	 	$db = 'magaz';

	 	$connection = mysqli_connect($host, $user, $pswd, $db);
	 	return $connection;
	}
	// Шапка
	function HEADERA($a){
		echo "<head>";
			echo "<title>$a</title>";

			echo '<link rel="stylesheet" type="text/css" href="http://magaz.com/style.css" />';
		echo "</head>";
		echo "<body>";
		if($_SESSION['admin']){
			echo "<a class='adminkas' href='/admin/'>Админка</a><br>";
			echo "<span class='adminkas'>Добрый день администратор</span>" . "<br>";
			echo "<FORM action='../index.php' METHOD='POST'>";
			echo '<INPUT name="exit_admin" type="submit" value="Exit" class="adminkas">' . "<br>";
			echo '</FORM>';
		}	
		echo "<header><h1>$a</h1></header>";
		echo "<div id='menu'>";
			echo "<a href='/#'>Главная | </a>";
			echo "<a href='/page/tovar'>Товары | </a>";
			echo "<a href='/page/kontakti'>Контакты | </a>";
			echo "<a href='/page/cart'>  Корзина </a> (" . coliches_tovarov()  . ')' . ' ' . allprice() . 'грн';
		echo "</div>";
		echo "<h1> $a</h1>";
		if(isset($_POST['exit_admin'])){
			session_destroy();
		}
		
	}
	// Добавление товара
	function product(){
		mysqli_select_db (db_connect(),"magaz");
		$result = mysqli_query(db_connect(),"SELECT  COUNT(*) FROM product ");
		$myrow = mysqli_fetch_array($result);
		$total=$myrow[0];
		
		$z=$_GET["a"];
		$b=$z*8;   // увеличивает № страницы
		//выводит товар
		$query="SELECT *
			FROM product
			ORDER BY id LIMIT $b,8";
			//FROM product";
		$result=db_connect()->query($query);
			


		while( $row = mysqli_fetch_array($result)){
			$s=$row["id"];
			echo "<div style='width:25%;float:left;'>";
				//название товара
				echo "<a href='onetovar.php?id=$s'>" . "<h1>" . $row["name"]  . "</h1></a>";
				echo "Описание - " . $row["description"];
				echo "<br>";
				echo "Цена - "  . $row["price"] . " грн.";
				echo "<br>";
					
				//переменная для картинок
				$img=$row["img"];
				echo "<img style='width:90%; border:1px solid;' src=../img/tovar/$img>";
			 	$s=$row["id"];
				if($_SESSION['admin']){
					echo "<FORM action='/work/obrabochik/delete.php?delete_tovar' METHOD='GET'>";
						// передаём скрытый ключ для удаления картинок со значением его айди
						echo "<input type='hidden' name='key' value='$s'>";
						echo '<INPUT name="delete_tovar" type="submit" value="удалить товар">' . "<br>";
						echo '</FORM>';


						echo "<FORM action='/work/obrabochik/edit.php?redactirovat' METHOD='GET'>";
						echo "<input type='hidden' name='key' value='$s'>";
							echo '<INPUT name="redactirovat" type="submit" value="изменить товар"></a>' . "<br>";
						echo '</FORM>';
					}

?>
					<a class="button" href="/page/tovar.php?a=0&add_to_cart&id=<?php echo $s ?>">Добавить в корзину</a>
					
<?php

				
			echo "</div>";
		}

		echo "<div id='footernavigation'>";
		$i=0;
		$b=0;
		while($i<($total/8) ) {
			$i++;
			echo "
			
			<a href='tovar.php?a=$b'>$i</a>" . "  " ;
			$b++;
		}
		echo  "</div>";					
	}
	// показываем 1 продукт
	function show_one_product($s){
	 	$s=$_GET['id'];
	 	global $link;
 		$query="SELECT *
			FROM product
			WHERE id=$s";
		$result=$link->query($query);
		while( $row = mysqli_fetch_array($result)){
			echo "<div style='width:50%;float:left;'>";
				//название товара
				echo "<a href='onetovar.php?id=$s'>" . "<h1>" . $row["name"]  . "</h1></a>";
				echo "Описание - " . $row["description"];
				echo "<br>";
				echo "Большое Описание - " . $row["big_description"];
				echo "<br>";
				echo "Цена - "  . $row["price"] . " грн.";
				echo "<br>";
				//переменная для картинок
				$img=$row["img"];
				echo "<img style='width:90%; border:1px solid;' src=../img/tovar/$img>";
			 	$s=$row["id"];
?>
			 	<h2><a class="button" href="/page/tovar.php?add_to_cart&id=<?php echo $s ?>">Добавить в корзину</a>
				 	</h2>
<?
					
				if($_SESSION['admin']){
					echo "<FORM action='/work/obrabochik/delete.php?delete_tovar' METHOD='GET'>";
						// передаём скрытый ключ для удаления картинок со значением его айди
						echo "<input type='hidden' name='key' value='$s'>";
						echo '<INPUT name="delete_tovar" type="submit" value="удалить товар">' . "<br>";
						echo '</FORM>';


						echo "<FORM action='/work/obrabochik/edit.php?redactirovat' METHOD='GET'>";
						echo "<input type='hidden' name='key' value='$s'>";
							echo '<INPUT name="redactirovat" type="submit" value="изменить товар"></a>' . "<br>";
						echo '</FORM>';
					}
				
			echo "</div>";
		}
	}
	// функция которая превращает в массив
	function db_result_to_array($result){
	 	$res_array = array();
	 	$count = 0;
	 	while ( $row= mysql_fetch_array($result)) {
	 		$res_array[$count] = $row;
	 		$count++;
	 	}
	 	return $res_array;
	}
	//покупка товара
	function get_products(){
	 	//подключение к базе
	 	db_connect();
	 	// выборка
	 	$query = "SELECT * FROM product ORDER BY id DESC";
	 	// в переменную помещаем выборку
	 	$result = mysql_query($query);
	 	// после помещаем всё в массив что бы можно было работать 
	 	$result = db_result_to_array($result);
	 	return $result;
	}
	function get_product($id){
		db_connect();
		$query = ("SELECT * FROM product WHERE id = '$id'");
		$result = mysqli_query(db_connect(),$query);
		$row = mysqli_fetch_array($result);
		return $row;
	}
	function add_to_cart($id){
	 	if(isset($_SESSION['cart'][$id])){
	 		$_SESSION['cart'][$id]++;
	 		header("Location : tovar.php");
	 		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=tovar.php'>
			</HEAD></HTML>";
	 		return true;
	 	}
	 	else{
	 		$_SESSION['cart'][$id] = 1;
	 		
	 		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=tovar'>
			</HEAD></HTML>";
			return true ;
	 	}
	 	return false ;
	}
	 //считаем количество товаров
	function coliches_tovarov(){
	 	if(isset($_SESSION['cart'])){
	 		$count = 0;
	 		foreach ($_SESSION['cart'] as $id => $quantity) {
	 			$count = $count + $quantity;
	 		}
	 		return $count;
	 	}
	 	else{
	 		return 0;
	 	}
	}
	function allprice(){
		if(isset($_SESSION['cart'])){
			$allprice = 0;
			foreach ($_SESSION['cart'] as $id => $quantity){
				$product = get_product($id);
			//считаем кол-во денег
				$allprice = $allprice + $product['price'] * $quantity;
			}
			return $allprice;
		}
		else{
			return 0;
		}
	}


	function SaveOrder($datetime){

		global $connection, $basket;
		$goods = myBasket();
		$stmt = mysqli_stmt_init($connection);
		$sql = 'INSERT INTO orders(
		        nameorder,
		        price,
		        quantity,
				datetime) 
		    VALUES (?, ?, ?, ?)';
		    if (!mysqli_stmt_prepare($stmt, $sql))
		       return false;
		     foreach($goods as $item){
		         mysqli_stmt_bind_param($stmt, "ssiiisi",
		         $item['nameorder'], $item['price'],
		         $item['quantity'],$datetime);
		         mysqli_stmt_execute($stmt);
		     }

		 mysqli_stmt_close($stmt);
		 
		 setcookie('basket', '', 1);
		 
		 return true;
		
	}

	function getOrders(){

		global $link;

		if(!is_file("/domains/magaz.com/admin/orders.log"))
		
		   return false;
		/* Получаем в виде массива персональные данные пользователей из файла */
		$orders = file("/domains/magaz.com/admin/orders.log");
		/* Массив, который будет возвращен функцией */
		$allorders = [];
		foreach ($orders as $order){
		   list($name, $email, $phone, $address, $date ) = explode("|", $order);
			/* Промежуточный массив для хранения информации о конкретном заказе */
			$orderinfo = [];
			/* Сохранение информацию о конкретном пользователе */
			$orderinfo["name"] = $name;
			$orderinfo["email"] = $email;
			$orderinfo["phone"] = $phone;
			$orderinfo["address"] = $address;
			$orderinfo["orderid"] = $orderid;
			$orderinfo["date"] = $date;
			
			/* SQL-запрос на выборку из таблицы orders всех товаров для конкретного покупателя */
			$sql = "SELECT nameorder, price, quantity 
			    FROM orders			 
			    WHERE  datetime='$date'";
			/* Получение результата выборки */
			if(!$result = mysqli_query($link, $sql))  
			   return false;
			$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
			mysqli_free_result($result);
			
			/* Сохранение результата в промежуточном массиве */
			$orderinfo["goods"] = $items;
			/* Добавление промежуточного массива в возвращаемый массив */
			$allorders[] = $orderinfo;
	 	}
	 	
	 	return $allorders;
	}