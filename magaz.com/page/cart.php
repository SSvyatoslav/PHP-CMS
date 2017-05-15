<?php
	error_reporting(0);
	$a="КОРЗИНА";
	header('Content-Type: text/html; charset=utf-8');
	include_once '../work/function.php';
	HEADERA($a);

	$allprice = 0;

	if($_SESSION['cart']){
		echo "Вы купили :" . '<br>';
		?>
		<form action="/work/obrabochik/updatacart.php?id=$product['id']" >
			<table border="1" width="100%">
				<tr>
					<td>Имя</td>
					<td>Цена</td>
					<td>Количество(шт.)</td>
					<td>Сумма</td>
					<td>Удалить</td>
				</tr>
		<?php


		if(!$_GET){
			foreach ($_SESSION['cart'] as $id => $quantity){
				$product = get_product($id);
				//считаем кол-во денег
				$allprice = $allprice + $product['price'] * $quantity;
		?>
		
							<td><?php echo $product['name']; ?></td>
							<td><?php echo $product['price']; ?> грн</td>
							<td>
								<input type="number" name="<?=$product['id']?>"  value="<?= $quantity;?>">
							</td>
							<td><?php echo $product['price'] * $quantity ?> грн</td>
							<td><a href="/work/obrabochik/delete.php?id=<?= $product['id'] ?>">Удалить </td>
						</tr>

<?php
	
	}

		}

			foreach ($_GET as $key => $value) {
				$allprice = $allprice + $product['price'] * $quantity;

					foreach ($_SESSION['cart'] as $id => $quantity){
						$product = get_product($id);

						echo "<br>";

						if($product['id'] == $key){

							$quantity = $value;

							$id = $quantity;
						?>
						<tr>
							<td><?php echo $product['name']; ?></td>
							<td><?php echo $product['price']; ?> грн</td>
							<td>
								<input type="number" name="<?=$product['id']?>"  value="<?= $quantity;?>">
							</td>
							<td><?php echo $product['price'] * $quantity ?> грн</td>
							<td><a href="/work/obrabochik/delete.php?id=<?= $product['id'] ?>">Удалить </td>
						</tr>

					<?php
					} 

				$quantity = $value;
					}	
			}
		?>

		</table>
			<input type="submit" value="обновить корзину">
		</form>
	<p>
		<a href='checkout/index.php'>
			Оформить заказ
		</a>
	</p>
	<?php
		echo "<p class='textg'>Общая Количество - " .	coliches_tovarov() . '<br>';
	
		echo "Общая цена - "  .  allprice() . 'грн.' . '<br>' ;
		
	}
	else{
		echo "<h2 class='textg'>Корзина пустая.</h2>";
	}
