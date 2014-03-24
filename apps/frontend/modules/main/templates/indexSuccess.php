<div class="clear"></div>
<br><br>
<?php foreach($fields as $field): ?>
    <div class="field-wrapper">
        <b>
            <a href="<?php echo url_for('@field_edit?id='.$field->getId()) ?>">
                <?php echo $field->getName(); ?>
            </a>
        </b>
        <div class="clear"></div>
        Попередник: <em><?php echo $field->getPlant()->getName(); ?></em>
        <div class="clear"></div>
        <? $SQUARE=($field->getLength()*$field->getWidth())/10000; ?>
        Площа: <?php echo $SQUARE; ?> га
        <div class="clear"></div>
        Грунт: <?php echo $field->getGroundType()->getName(); ?>
    </div>
<?php endforeach; ?>

<div class="field-wrapper">
    <a class="btn btn-success" href="<?php echo url_for('@field_new') ?>">Додати</a>
</div>

<br><br>
<div class="clear"></div>
<div class="calc-form-wrapper">
<h1>Створити сівозміну:</h1>
    <?php include_partial('form', array('form' => $form)); ?>
</div>


<div class="fertilizers-wrapper">
    <?php include_partial('fertilizer/landing_list', array('fertilizers' => $fertilizers)); ?>
</div>
<div class="clear"></div>
