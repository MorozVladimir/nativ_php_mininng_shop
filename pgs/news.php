<?php
    $title = "Новости";
    $query = "SELECT * FROM news";
    $res = $connection->query($query);
    function createContent() {
    	global $user, $res;
?>
<h2>Новости</h2>
<?php if($user=='admin'){?>
	<p style="padding-bottom: 20px;"><a href="index.php?id=news_editor">Довавить новость</a></p>
<?php } ?>

<?php if($res->num_rows>0){
			foreach($res as $r){?>
				<div style="border: 1px solid silver; border-radius: 5px; margin: 5px;">
					<div style="text-align: center;"><h3><?=$r['title']?></h3></div>
					<div style="display: flex;">
						<div><img style="width: 500px; padding: 20px;" src="<?=$r['image']?>" alt=""></div>
						<div style="padding: 20px;">
							<div><h4><?=$r['description']?></h4></div>
							<div><h5><?=$r['content']?></h5></div>
						</div>
					</div>
				</div>
				

<?php 
		}
 	}
 }
 ?>

