<?php
include_once '../work/function.php';
	
if(!$_SESSION['admin']){
	echo "В доступе отказано.";
	exit;}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Поступившие заказы</title>
	<meta charset="utf-8">
</head>
<body>
<h1>Поступившие заказы:</h1>
<?php
	$orders = getOrders();
	$orderbyid = 1;


	if(!$orders){
		echo 'Заказов нет!';
		exit;
	}
	foreach($orders as $order ){
		$dt = date("d.m.Y H:i", $order["date"]);
?>
	<hr> 
	<h2>Заказ номер:<?=$orderbyid?> </h2>
	<p><b>Заказчик</b>:<?=$order["name"]?></p>
	<p><b>Email</b>:<?=$order["email"]?></p>
	<p><b>Телефон</b>:<?=$order["phone"]?></p>
	<p><b>Адрес доставки</b>:<?=$order["address"]?></p>
	<p><b>Дата размещения заказа</b>:<?=$dt?></p>

	<h3>Купленные товары:</h3>
	<table border="1" cellpadding="5" cellspacing="0" width="100%">
		<tr>
			<th>N п/п2</th>
			<th>Название</th>
			<th>Цена, грн.</th>
			<th>Количество</th>
		</tr>

		<?php
			$sum = 0;
			$i = 1;
			foreach ($order["goods"] as $items) {

			?>

			<tr>
				<td><?= $i++?></td>
				<td><?= $items['nameorder']?></td>
				<td><?= $items['price']?></td>
				<td><?= $items['quantity']?></td>
			</tr>
		<?php
				$sum += $items['price'] * $items['quantity'];
			}
			$orderbyid++;

?>
	</table>
	<p>Всего товаров в заказе на сумму:<?= $sum?> грн.</p>
	<?php } ?>
</body>
</html>