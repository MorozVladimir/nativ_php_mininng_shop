<?php
    $title = "Управление заказами";

    $query1 = "SELECT id FROM users WHERE login = '$user'";
    $res1=$connection->query($query1);
    $uid = $res1->fetch_assoc()['id'];


    $query = "SELECT a.goods_id AS 'i', b.name AS 'g', SUM(num) as s_num, SUM(b.price) as 's_p' FROM orders AS a, goods as b, users AS c WHERE b.id = a.goods_id AND c.id = $uid AND a.user_id = c.id AND a.status = 'norm' GROUP BY a.goods_id";
	$res=$connection->query($query);

    $query3 = "SELECT SUM(c.price) AS 'p' FROM orders AS a, users AS b, goods AS c WHERE a.user_id = b.id AND a.goods_id = c.id AND a.user_id = $uid AND a.status = 'norm'";
    $res3=$connection->query($query3);
    $price = $res3->fetch_assoc()['p'];

    $query4 = "SELECT * FROM orders WHERE user_id = $uid";
    $res4 = $connection->query($query4);
    $is_good = $res4->num_rows;


    function createContent() {
    	global $res, $price, $is_good;
?>

<h2>Управление заказами <span id="l1"></span></h2>


<?php if($res->num_rows > 0) {
    $count = 0;
	foreach($res as $r){ $count = $count+1;?>
            <div id="<?=$r['i']?>" style="display: flex; margin: 20px;">
                <div class="cross_g" id="<?=$r['i']?>" style="width: 15px; "><?=$count?></div>
                <div style="width: 300px; margin: 0 20px;"><?=$r['g']?></div>
                <div class="mines_g" id="<?=$r['i']?>" style="width: 15px;border:1px solid black;background: green;">-</div>
                <div style="width: 20px; margin: 0 20px;"><?=$r['s_num']?></div>
                <div class="plus_g" id="<?=$r['i']?>" style="width: 15px;border:1px solid black;background: blue;">+</div>
                <div style="width: 45px; margin-left: 20px;"><?=$r['s_p']?></div>
            </div>
            

<?php }} else if($is_good > 0){?>
<h3>Ваш заказ принят мы с Вами свяжемся</h3>
<?php } else {?>
    <h3>В корзине нет ни одного товара</h3>
<?php } if($res->num_rows > 0) {?>
            <div>Общая стоимость - <?=$price?></div>
            <div style="display: flex;">
                <div class="subm" style="margin: 15px;"><button>Подтвердить заказ</button></div>
                <div class="rese" style="margin: 15px;"><button>Отменить заказ</button></div>
            </div>
<?php }}?>


<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('.mines_g').click(function(event){
            event.preventDefault();
            let gid = $(this).attr('id');
            $.ajax({
                url: "ajax/mines_item.php",
                data: "gid=" + gid,
                success: function(result){
                if(result=='ok'){window.location = 'index.php?id=order_page';}
                }
            });
        });
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){
        $('.plus_g').click(function(event){
            event.preventDefault();
            let gid = $(this).attr('id');
            $.ajax({
                url: "ajax/plus_item.php",
                data: "gid=" + gid,
                success: function(result){
                if(result=='ok'){window.location = 'index.php?id=order_page';}
                }
            });
        });
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){
        $('.subm').click(function(event){
            event.preventDefault();
          //  let gid = $(this).attr('id');
            $.ajax({
                url: "ajax/submit_order.php",
                data: "uid=" + 1,
                success: function(result){
                {window.location = 'index.php?id=order_page';$('#l1').text(result);}
                }
            });
        });
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){
        $('.rese').click(function(event){
            event.preventDefault();
         //   let uid = $(this).attr('id');
            $.ajax({
                url: "ajax/reset_order.php",
                data: "uid=" + 1,
                success: function(result){
                if(result=='ok'){window.location = 'index.php?id=order_page';$('#l1').text(result);}
                }
            });
        });
    });
</script>