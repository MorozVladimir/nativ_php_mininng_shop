<?php
    $title = "Регистрация";
    function createContent() {
    	global $connection;
    	if(empty($_POST['submit'])){
    		
?>

<h2>Регистрация</h2>
<form method="post" action="#">
	<p>
		<label for="login">Логин:</label><br>
		<input type="text" id="login" name="login" required><br>
	</p>
	<p>
		<label for="pass1">Пароль:</label><br>
		<input type="password" id="pass1" name="pass1" required><br>
	</p>
	<p>
		<label for="pass2">Повтор:</label><br>
		<input type="password" id="pass2" name="pass2" required><br>
	</p>
	<p>
		<label for="email">E-Mail:</label><br>
		<input type="email" id="email" name="email" required>
	</p>
	
	<br>
	<p style="padding-top: 10px;">
		<input type="submit" id="submit" name="submit" value="Отправить">
		&nbsp;
		<input type="reset" id="reset" name="reset" value="Сбросить">
	</p>
</form>

<?php 
		} else {
			$login = $_POST['login']; $login = htmlspecialchars($login);
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];
			//проверка занятости логина
			$query = "SELECT login FROM users WHERE login=?";
			$stmt = $connection->prepare($query);
			$stmt->bind_param('s', $login);
			$stmt->execute();
			$res = $stmt->get_result();
			$N = $res->num_rows;
			if($N>0){echo('<h3 style="color:red">Логин занят</h3>');}
			//проверка совпадения паролей
			else if($pass1!=$pass2){echo('<h3 style="color:red">Пароли не совпадают</h3>');}
				else{
					$passw = md5($pass1);
					$email = $_POST['email'];
					$regdate = date('Y-m-d H:i:s');
					$status = 'norm';
					$query = "INSERT INTO users (login, passw, email, regdate, status) VALUES(?,?,?,?,?)";
					$stmt = $connection->prepare($query);
					$stmt->bind_param('sssss',$login, $passw, $email, $regdate, $status);
					$stmt->execute();
					echo "Вы успешно зарегистрированы";
				}
			
			}
	}
?>