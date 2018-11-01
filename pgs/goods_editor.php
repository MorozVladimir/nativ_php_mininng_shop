<?php
    $title = "Страница добавление товаров";
    function createContent() {
    	global $connection;
    	if(empty($_POST['submit'])){
    		
?>

<h2>Страница добавления товаров</h2>
<form method="post" action="#" enctype="multipart/form-data">
	<p>
		<label for="name">Название товара:</label><br>
		<input type="text" id="name" name="name" required style="width: 547px;"><br>
	</p>
	<p>
		<label for="category">Категория товара:</label><br>
		<input type="text" id="category" name="category" required style="width: 547px;"><br>
	</p>
	<p>
		<label for="produser">Производитель:</label><br>
		<input type="text" id="produser" name="produser" required style="width: 547px;"><br>
	</p>
	<p>
		<label for="number_good">Количество товара:</label><br>
		<input type="text" id="numder_good" name="number_good" required style="width: 547px;"><br>
	</p>
	<p>
		<label for="price">Цена товара:</label><br>
		<input type="text" id="price" name="price" required style="width: 547px;"><br>
	</p>
	<p>
		<label for="image_good">Загрузить файл:</label>
		<input type="file" id="image_good" name="image_good">
	</p>
	
	<br>
	<p style="padding-top: 10px;">
		<input type="submit" id="submit" name="submit" value="Добавить">
		&nbsp;
		<input type="reset" id="reset" name="reset" value="Отмена">
	</p>
</form>

<?php 
		} else {
			$name = $_POST['name']; 
			echo($name);
			$category = $_POST['category'];
			echo($category);
			$produser = $_POST['produser'];
			$number_good = $_POST['number_good'];
			$price = $_POST['price'];

			$dir = 'fls/';
			$file_name = $_FILES['image_good']['name'];
			echo($file_name);
			$file_path = $dir.$file_name;

			$image_good = $file_path;
			copy($_FILES['image_good']['tmp_name'], $file_path);
			$query = "INSERT INTO goods (name, category, produser, image_good, number_good, price) VALUES (?,?,?,?,?,?)";
			$stmt = $connection->prepare($query);
			$stmt->bind_param('ssssid', $name, $category, $produser,  $image_good, $number_good, $price);
			$stmt->execute();
			header('Location: index.php?id=goods');
		}
	}
?>