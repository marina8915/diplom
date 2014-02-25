<div class="login">
    <form action="<?php echo url_for('login/editpass') ?>" method="post">
        Старий пароль:
            	<input name="oldpassword" type="password">
        <br>
        Новий пароль:
            	<input name="newpassword" type="text">
        <div class="clear"></div>
    	<input type="submit" class="btn btn-success" value="Надіслати">
    </form>

</div>
