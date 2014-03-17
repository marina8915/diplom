<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="uk" lang="uk">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>
<body>
<div class="site-wrapper">
<h1 class='logo'>
    <a href='/'><img src="../img/logo.png" alt="Інформаційна система оптимізації сівозміни малого аграрного підприємства"/>
    Інформаційна система оптимізації сівозміни малого аграрного підприємства</a></h1>
<?php include_partial('main/user_menu') ?>

    <div class="navbar">    
 	<div class="navbar-inner">
            <div class="container">
                <?php include_partial('main/head_menu') ?>

            </div>
        </div>
    </div>
<img class= "slaid" src="/img/slaid.jpg" width="800" height="250" />
    <?php echo $sf_content ?>
</div>
<footer>
	Copyright  &copy; 2013, Бакум М.В.
</footer>

</body>
</html>
