<h5>Вартість добрив:</h5>
<div class="clear"></div>
<ul>
    <?php foreach($fertilizers as $fertilizer): ?>
        <li>
            <a href="<?php echo url_for('@fertilizer_edit?id='.$fertilizer->getId()) ?>">
                <?php echo $fertilizer->getName(); ?> <b><?php echo $fertilizer->getPrice(); ?></b><em>грн/кг</em>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<div class="clear"></div>
<a href="<?php echo url_for('@fertilizer') ?>">
    змінити...
</a>