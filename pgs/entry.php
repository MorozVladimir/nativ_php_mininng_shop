<?php
    $title = "Авторизация";
    function createContent() {
    	global $connection;
    	if(empty($_POST['submit'])){
    		
?>

<h2>Авторизация</h2>
<form method="post" action="#">
	<p>
		<label for="login">Логин:</label><br>
		<input type="text" id="login" name="login" required><br>
	</p>
	<p>
		<label for="pass1">Пароль:</label><br>
		<input type="password" id="pass1" name="pass1" required><br>
	</p>
	
	<br>
	<p style="padding-top: 10px;">
		<input type="submit" id="submit" name="submit" value="Войти">
		&nbsp;
		<input type="reset" id="reset" name="reset" value="Сбросить">
	</p>
</form>

<?php 
		} else {
			$login = $_POST['login']; $login = htmlspecialchars($login);
			$pass1 = $_POST['pass1'];
			$passw = md5($pass1);
			$query = "SELECT login, passw FROM users WHERE login=? AND passw=?";
			$stmt = $connection->prepare($query);
			$stmt->bind_param('ss', $login, $passw);
			$stmt->execute();
			$res = $stmt->get_result();
			$N = $res->num_rows;
			if($N==0){echo('<h3 style="color:red">Авторизация провалена</h3>');}
			else {
				$_SESSION['user'] = $login;
				header('Location: index.php?id=main');
			}
	}	
}
		
?>