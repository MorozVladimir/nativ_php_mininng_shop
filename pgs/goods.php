<?php

	$query = "SELECT * FROM goods ";
	$res=$connection->query($query);

	if($user == 'Гость'){$uid = 0;}
	else{
	$query1 = "SELECT id FROM users WHERE login = '$user'";
	$res1=$connection->query($query1);
	$uid = $res1->fetch_assoc()['id'];
	}
	

	$query2 = "SELECT SUM(num) AS 'n' FROM orders WHERE user_id = $uid AND status = 'norm'";
	$res2=$connection->query($query2);
	$num = $res2->fetch_assoc()['n'];

	$query3 = "SELECT SUM(c.price) AS 'p' FROM orders AS a, users AS b, goods AS c WHERE a.user_id = b.id AND a.goods_id = c.id AND a.user_id = $uid AND a.status = 'norm'";
	$res3=$connection->query($query3);
	$price = $res3->fetch_assoc()['p'];


    $title = "Товары для майнинга";
    function createContent() {
    	global $user, $res, $num, $price;
?>
<div style="display: flex;">
	<div style="width: 500px;"><h2>Товары для майнинга</h2></div>

	<?php if($user != 'Гость'){?>

	<div>
		<div style="padding-top: 20px; width: 200px;"><span>Колличество товаров:</span><span style="padding-left: 10px;"><?=$num?></span>шт.</div>
		<div style="padding-bottom: 20px;"><span>Общая стоимость:</span><span style="padding-left: 33px;"><?=$price?></span>грн.</div>
	</div>
	<div><a href="index.php?id=order_page"><image style="width: 75px;padding: auto;" src="img/basket.jpg"></image></a>
	</div>

	<?php }?>

</div>

<?php if($user=='admin'){?>
	<p style="padding-bottom: 20px;"><a href="index.php?id=goods_editor">Довавить товар</a></p>
<?php }?>
<div style="display: flex; flex-wrap: wrap; width: 1000px;" >
	<?php if($res->num_rows>0){ 
		foreach($res as $r){?>
			<div style="margin: 10px; padding: 10px; border: 1px solid silver; border-radius: 5px; width: 300px;">
				<div><h5><?=$r['name']?></h5></div> 
				<div><img style="width: 250px; margin-left: 20px;" src="<?=$r['image_good']?>" alt=""></div>
				<div style="display: flex" class="caption"><h4><?=$r['price']?> грн.</h4>

				<?php if($user != 'Гость'){?>
					<a style="margin: auto;" href="" id="<?=$r['id']?>">В корзину</a>
				<?php }?>

				</div>
			</div>
			<?php }?>
</div>
		
<?php }}?>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.caption a').click(function(event){
			event.preventDefault();
			let gid = $(this).attr('id');
			$.ajax({
				url: "ajax/basket.php",
				data: "gid=" + gid,
				success: function(result){
				if(result=='ok'){window.location = 'index.php?id=goods'; $('#l1').text(result);}
				}
			});
		});
	});
</script>

