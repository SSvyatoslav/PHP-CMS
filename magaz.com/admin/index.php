<?php 
	$a="admin Panel";
	include_once '../work/function.php';
	HEADERA($a);
	if(!$_SESSION['admin']){
	?>
		<form action="index.php" method="post">
            <label>
          	  Ваш логин (email):
            <br>
            <input type="text" name="name">
            
            </label>
            <br>
            <label>
          	  Пароль:
            <br>
            <input type="password" name="password">
            </label>
            <br>
            <br>
            <br>
            <label>
                <input type="submit" value="Enter">
            
            </label>
        </form>
<?php 
	}
	else{
		echo "<a href='/admin/orders.php'> Просмотр заказов</a><br>";
		echo "<a href='/work/obrabochik/add.php'> Добавить товар </a><br>";
	}
		if(isset($_POST['name'])){
			//выгружаем введеные даные администратором
			$nameuser = $_POST['name'];
			$password = $_POST['password'];
		
			//выгружаем с базы
			$query="SELECT *
			FROM user";
			$result=$link->query($query);
			while( $row = mysqli_fetch_array($result)){

				 $namedb = $row["name"];
				 $passworddb = $row["password"];
			}

			//сравниваем и устанавливаем куку 
			if($nameuser == $namedb && $password == $passworddb){
				echo "Поздравляю вы вошли как администратор";
				$_SESSION['admin'] = 'thisadmin';
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php'>
				</HEAD></HTML>";
			}
			else{
				echo "Введеное имя или пароль не правильные, попробуйте ещё разок.";
			}
		}
