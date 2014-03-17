<div class="login">
    <form action="<?php echo url_for('login/updateemail') ?>" method="post">
        Old E-mail:
            	<?php echo $set->getValue(); ?>
        <br>
        New E-mail:
            	<input name="newe" type="text">
    	<input type="submit" style="margin-left: 90px;">
    </form>

</div>
