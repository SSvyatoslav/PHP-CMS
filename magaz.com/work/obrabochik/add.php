<?php
	$a="Добавление товара";
	header('Content-Type: text/html; charset=utf-8');
	include_once '../function.php';
	HEADERA($a);


	 // для картинок куда загружать
	$path = '/domains/magaz.com/img/tovar/';
	move_uploaded_file($_FILES['userfile']['tmp_name'], $path. $_FILES['userfile']['name']);
	// форма добавления товара
	echo '<div id="addtovar1">';
		echo '<form enctype="multipart/form-data" action="add.php?a=0&addtovar=1" method="POST">';
			echo 'Название товара <INPUT type="text" name="a">' . "<br>";
			echo 'Краткое Описание товара <INPUT type="text" name="b">' . "<br>";
			echo 'Большое Описание товара <INPUT type="text" name="big_descruption">' . "<br>";
			echo 'Цена товара <INPUT type="text" name="c">'. "<br>";
			echo '<input type="hidden" name="MAX_FILE_SIZE" value="30000000000000000" />';
			echo 'Изображение товара: <input name="userfile" type="file" />'. "<br>";
			echo  '<input type="submit" value="Добавить товар" />';
		echo	'</form>';
	echo '</div>';

	if (isset($_FILES['userfile'])){
			//ЗАГРУЖАЕМ ТОВАР
			//присваеваем переменным значения с формы
			global $connection;
			global $link;
			$img=$_FILES['userfile']['name'];
			$nameproduct=$_POST['a'];
			$description=$_POST['b'];
			$big_description=$_POST['big_descruption'];
			$price=$_POST['c'];
					
			/*$zagruzka="INSERT INTO product (name,description,big_description,price,img )
			VALUES ('$nameproduct','$description','$big_description','$price','$img')"; 
			
			$result=$link->query($zagruzka);
*/

		//	$stmt = mysqli_stmt_init($connection);
			$sql = 'INSERT INTO product(name,description,big_description,price,img)
		    VALUES (?, ?, ?, ?, ?)';
		    /*if (!mysqli_stmt_prepare($link, $sql))
		       return false;*/
		  	 $stmt = mysqli_prepare($link, $sql);

		  	 mysqli_stmt_bind_param($stmt, "sssis",
		    $nameproduct,$description,$big_description,$price,$img);
		    mysqli_stmt_execute($stmt);
		 	mysqli_stmt_close($stmt);

/*
		 	$sql = "INSERT INTO users(name, email, age) VALUES(?, ?, ?)";
// Уважаемый сервер, вот запрос - разбери его 
		 	$stmt = mysqli_prepare($link, $sql);
// Уважаемый сервер, вот параметры для запроса 
		 	mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $age);
// А теперь, исполни подготовленный запрос с переданными параметрами
 mysqli_stmt_execute($stmt); mysqli_stmt_close($stmt);


*/

		 	echo "<HTML><HEAD>
				<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://magaz.com/page/tovar.php'>
			</HEAD></HTML>";	
	}