<?php
	session_destroy();
	header('Location: index.php?id=main');

    $title = 'Выход';
    function createContent() {

?>

<h2>Выход</h2>

<?php }?>