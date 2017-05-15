<?php 
	$a="Оформление Заказа";
	header('Content-Type: text/html; charset=utf-8');
	//подключение через абослютный путь МОЖЕТ НЕ РАБОТАТЬ НА ДРУГИХ МАШИНАХ
	include_once ('/domains/magaz.com/work/function.php');
	HEADERA($a);


?>
	<table border=1 cellpadding="5" cellspacing="0" width="100%">
            <tr>
                <td>Имя</td>
                <td>Цена</td>
                <td>Количество</td>
                <td>Сумма</td>
            </tr>
        <?php 
         foreach ($_SESSION['cart'] as $id => $quantity){
                $product = get_product($id);
                //считаем кол-во денег
                $allprice = $allprice + $product['price'] * $quantity;?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?> грн</td>
                    <td><?php echo $quantity; ?> шт.</td>
                   
                    <td>
                    <?php echo $product['price'] * $quantity?> грн</td>
                </tr> 


        <?php 
       
    }
        ?>
    </table>

    <form method="POST" action="send.php">
    	<p>Ваше имя
     		<input type="text" name="name" >
     	</p>
     	<p>Ваш Email
     		<input type="email" name="email" >
     	</p>
     	<p>Ваш № Телефона
     		<input type="phone" name="phone" >
     	</p>
     	<p>Адресс Доставки 
     		<input type="text" name="dostavka" >
     	</p>
     	<input type="submit" value="Заказать" >
    </form>