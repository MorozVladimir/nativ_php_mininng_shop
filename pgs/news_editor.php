<?php
    $title = "Страница добавление новостей";
    function createContent() {
    	global $connection;
    	if(empty($_POST['submit'])){
    		
?>

<h2>Страница добавления новостей</h2>
<form method="post" action="#" enctype="multipart/form-data">
	<p>
		<label for="title">Заголовок:</label><br>
		<input type="text" id="title" name="title" required style="width: 547px;"><br>
	</p>
	<p>
		<label for="description">Описание:</label><br>
		<textarea id="description" name="description" cols="85" rows="3"></textarea>
	</p>
	<p>
		<label for="content">Содержимое:</label><br>
		<textarea id="content" name="content" cols="85" rows="9"></textarea>
	</p>
	<p>
		<label for="image">Загрузить файл:</label>
		<input type="file" id="image" name="image">
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
			$title = $_POST['title']; 
			$description = $_POST['description'];
			$content = $_POST['content'];

			$dir = 'fls/';
			$file_name = $_FILES['image']['name'];
			$file_path = $dir.$file_name;

			$image = $file_path;

			copy($_FILES['image']['tmp_name'], $file_path);
			$publish_date = date('Y-m-d H:i:s');
			$status = 'publish';

			$query = "INSERT INTO news (title, description, content, image, publish_date, status) VALUES (?,?,?,?,?,?)";
			$stmt = $connection->prepare($query);
			echo($title.$description.$content.$image.$publish_date.$status);
			$stmt->bind_param('ssssss', $title, $description, $content, $image, $publish_date, $status);
			$stmt->execute();
			header('Location: index.php?id=news');
		}
	}
?>