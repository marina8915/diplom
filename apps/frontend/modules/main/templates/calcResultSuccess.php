<?php
/**$startYear = date('Y');
 @var $rentableManager RentableManager */
$rentableManager = $rentableManager->getRawValue();
?>

<script type="text/javascript">
    var allData = [];
    var valueData = [];
    var profitData = [];
    var groundData = [];
    var heavenData = [];
//  allData[fieldId][year] = googleCartData;
</script>


<table class="table table-striped" id="result_table">
    <thead>
    <tr>
        <th>Поле

        </th>
        <th>
           Культура
        </th>
        <th>
            Грунт
        </th>
        <th>
            Кліматична зона
        </th>
            <th>
                Сівозміна
            </th>

        <?php  $fieldCount=0 ?>
       <?php foreach($fields as $field): ?>
                 <?php  $fieldCount=$fieldCount+1 ?>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>

    <?php foreach($fields as $field): ?>
        <tr>
            <td>
                <script type="text/javascript">
                    allData['<?php echo $field->getId(); ?>'] = [];
                    valueData['<?php echo $field->getId(); ?>'] = [];
                    profitData['<?php echo $field->getId(); ?>'] = [];
                    groundData['<?php echo $field->getId(); ?>'] = [];
                    heavenData['<?php echo $field->getId(); ?>'] = [];
                </script>
              <?php echo $field->getName(); ?></td>
            <td><?php echo $field->getPlant()->getName(); ?></td>
            <td><?php echo $field->getGroundType()->getName(); ?></td>
            <td><?php echo $field->getHeaven()->getName(); ?></td>
            <?php
            /** @var $currentPlant Plant */
            $currentPlant = $field->getPlant();
            $currentGround = $field->getGroundType();
            $currentHeaven = $field->getHeaven();

            ?>
                <td fieldId="<?php echo $field->getId();?>" year="<?php echo $i;?>" ground="<?php echo $field->getGround_type_id();?>" class="year-cell" fieldName="<?php echo $field->getName();?>">
                    <?php
                    $valueMap = $currentPlant->getNextPlantsValueMap();
                    if ($valueMap instanceof sfOutputEscaperIteratorDecorator) $valueMap= $valueMap->getRawValue();
                    $groundMap=$currentGround->getNextPlantsGroundMap();
                    if ($groundMap instanceof sfOutputEscaperIteratorDecorator) $groundMap= $groundMap->getRawValue();
                    $heavenMap = $currentHeaven->getNextPlantsHeavenMap();
                    if ($heavenMap instanceof sfOutputEscaperIteratorDecorator) $heavenMap= $heavenMap->getRawValue();

                    $profitMap = $rentableManager->getProfitMap($valueMap, $calcConfig->getRawValue());
                    $mixedKeyMap = $rentableManager->getMixedMap($profitMap, $valueMap, $groundMap,$heavenMap);
                    $best = $rentableManager->getMostWantedPlant($mixedKeyMap);
                    ?>
                    <?php  echo $best;?>
                    <div class="clear"></div>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Сумарні пріоритети');
                    foreach($mixedKeyMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$key);
                    }
                    ?>
                    <script type="text/javascript">
                        allData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Пріоритети по попередниках');
                    foreach($valueMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$valueMap[$nextPlant]);
                    }
                    ?>
                    <script type="text/javascript">
                        valueData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                    <?php // готуємо дані для діаграм
                    $SQUARE=($field->getLength()*$field->getWidth())/10000;
                    $td = array();
                    $td [] = array('', 'Пріоритети по прибутку, грн/га');
                    foreach($profitMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$profitMap[$nextPlant]*$SQUARE);
                    }
                    ?>
                    <script type="text/javascript">
                        profitData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Пріоритети по грунтах');
                    foreach($groundMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$groundMap[$nextPlant]);
                    }
                    ?>
                    <script type="text/javascript">
                        groundData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Пріоритети по кліматичній зоні');
                    foreach($heavenMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$heavenMap[$nextPlant]);
                    }
                    ?>
                    <script type="text/javascript">
                        heavenData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                </td>
                <?php $currentPlant=$best;?>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.year-cell').each(function(){
            jQuery(this).bind('click', function(){
                jQuery('.year-cell').removeClass('active');
                jQuery(this).addClass('active');

                var fieldId = jQuery(this).attr('fieldId');
                var year = jQuery(this).attr('year');
                var fieldName = jQuery(this).attr('fieldName');

                var title = fieldName;
                var options = {
                    title: title,
                    hAxis: {title: 'Культури', titleTextStyle: {color: 'green'}}
                };
                // mixed
                var data = google.visualization.arrayToDataTable(allData[fieldId][year]);

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_all'));
                chart.draw(data, options);

                // value
                var data = google.visualization.arrayToDataTable(valueData[fieldId][year]);

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_value'));
                chart.draw(data, options);

                // profit
                var data = google.visualization.arrayToDataTable(profitData[fieldId][year]);

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_profit'));
                chart.draw(data, options);

                // ground
                var data = google.visualization.arrayToDataTable(groundData[fieldId][year]);

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_ground'));
                chart.draw(data, options);

                // heaven
                var data = google.visualization.arrayToDataTable(heavenData[fieldId][year]);

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_heaven'));
                chart.draw(data, options);
            });
        });

        jQuery('.year-cell').eq(0).trigger('click');
    });
    google.load("visualization", "1", {packages:["corechart"]});



</script>
<div id="chart_all" class="chart-div"></div>
<div id="chart_value" class="chart-div"></div>
<div id="chart_profit" class="chart-div"></div>
<div id="chart_heaven" class="chart-div"></div>
<div id="chart_ground" class="chart-div"></div>

