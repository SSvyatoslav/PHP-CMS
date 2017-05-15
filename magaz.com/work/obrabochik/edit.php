<?php

	$a="Редактирование товара";
	header('Content-Type: text/html; charset=utf-8');
	include_once '../function.php';
	HEADERA($a);
	
if (isset($_GET['redactirovat'])){
			
			$key_tovar=$_GET['key'];


			global $link;
			$query="SELECT *
			FROM product
			WHERE id=$key_tovar";
			$result1=$link->query($query);
		


			while($row = mysqli_fetch_array($result1)){
				// присваеваем имя для формы 
				$name = $row["name"];
				$description = $row["description"] ;
				$price = $row["price"];
				$img=$row["img"];
				$s=$row["id"];

				$_SESSION['img'] = $img;

				echo "<div style='width:25%;float:left;'>";
					echo '<form enctype="multipart/form-data" action="edit.php?updatetovar=1" METHOD="POST">';
						echo 'Название товара <INPUT type="text" name="a"' . "value='$name'>" . "<br>";
						echo 'Описание товара <INPUT type="text" name="b"' . "value='$description' >" . "<br>";
						echo 'Цена товара <INPUT type="text" name="c"' . "value='$price' >". "<br>";
						echo "<img style='width:90%; border:1px solid;' src=/img/tovar/$img>";
						echo '<input type="hidden" name="MAX_FILE_SIZE" value="30000000000000000" />';
						echo 'Изображение товара: <input name="imgfile" type="file" value="/img/tovar/$img" />'. "<br>";
						echo "<input type='hidden' name='key' value='$s'>";
						echo '<INPUT name="updatetovar" type="submit" value="ОБНОВИТЬ товар">' . "<br>";
					echo '</form>';
				echo "</div>";

				}




		}
			if (isset($_GET['updatetovar'])){	

			echo "ПОЗДРАВЛЯЮ ВЫ ОБНОВИЛИ ТОВАР";
			$namep=$_POST[a];
			$descriptionp=$_POST[b];
			$pricep=$_POST[c];
			$img=$_FILES['imgfile']['name'];

			$key=$_POST[key];
			// проверяем если новую картинку не задали подтягиваем через сессию старую
			if(!$img){
				$img = $_SESSION['img'];
			}
			
			// ghj
			$query="UPDATE product
			SET name='$namep', description='$descriptionp', price='$pricep', img ='$img'
			WHERE id=$key"; 
			$result=$link->query($query);

			if($img){
				$path = '../img/tovar/';
		 	move_uploaded_file($_FILES['imgfile']['tmp_name'], $path. $_FILES['imgfile']['name']);
			}


		 	echo "<HTML><HEAD>
				<META HTTP-EQUIV='Refresh' CONTENT='0; URL=http://magaz.com/page/tovar.php'>
			</HEAD></HTML>";

		}