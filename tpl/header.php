<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Майнинг магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php?id=main">Главная</a></li>
            <li><a href="index.php?id=about">Про сайт</a></li>
            <li><a href="index.php?id=news">Новости</a></li>
            <li><a href="index.php?id=goods">Каталог</a></li>
            <li><a href="index.php?id=contact">Контакти</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a style="margin-right: 30px;" href="#">Hi, <?=$user?></a></li>
<?php if($user=='Гость'){ ?>
            <li><a href="index.php?id=entry">Вход</a></li>
            <li><a href="index.php?id=reg">Регистрация</a></li>
<?php } else { ?>
            <li><a href="index.php?id=exit">Выход</a></li>
            <li><a href="index.php?id=profile">Профиль</a></li>
<?php } ?>
          </ul>

        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->