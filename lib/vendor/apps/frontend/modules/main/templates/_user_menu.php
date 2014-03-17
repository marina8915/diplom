<?php if ($sf_user->isAuthenticated()):?>

<ul class="nav pull-right fos-top-control">
    <li>
        <a href="<?php echo url_for('login/editpass')?>">
            Змінити пароль
        </a>
    </li>
    <li>
        <a href="<?php echo url_for('login/logout')?>">
            Вихід
        </a>
    </li>
</ul>


<?php endif; ?>




