<?php
/**$startYear = date('Y');
 @var $rentableManager RentableManager */
$rentableManager = $rentableManager->getRawValue();
?>

<script type="text/javascript">
    var allData = [];
    var valueData = [];
    var profitData = [];
    //    allData[fieldId][year] = googleCartData;
</script>

Сівозміна:

<table class="table table-striped" id="result_table">
    <thead>
    <tr>
        <th>&nbsp;

        </th>
        <?php for($i=1; $i<1+$yearsCount; $i++): ?>
            <th>
                <b><?php echo 'Поле '.$i; ?></b>
            </th>
        <?php endfor; ?>
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
                </script>
              <!-- <b><?php echo $field->getName(); ?></b>
                <em><?php echo $field->getPlant()->getName(); ?></em> -->
            </td>

            <?php
            /** @var $currentPlant Plant */
            $currentPlant = $field->getPlant();

            for($i=$startYear; $i<$startYear+$yearsCount; $i++): ?>
                <td fieldId="<?php echo $field->getId();?>" year="<?php echo $i;?>" class="year-cell" fieldName="<?php echo $field->getName();?>">
                    <?php
                    $valueMap = $currentPlant->getNextPlantsValueMap();
                    if ($valueMap instanceof sfOutputEscaperIteratorDecorator) $valueMap= $valueMap->getRawValue();
                    $profitMap = $rentableManager->getProfitMap($valueMap, $calcConfig->getRawValue());
                    $mixedKeyMap = $rentableManager->getMixedMap($profitMap, $valueMap);
                    $best = $rentableManager->getMostWantedPlant($mixedKeyMap);
                    ?>
                    <b><?php echo $best; ?></b>
                    <div class="clear"></div>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Сумарний пріоритет');
                    foreach($mixedKeyMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$key);
                    }
                    ?>
                    <script type="text/javascript">
                        allData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Пріоритет по попередниках');
                    foreach($valueMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$valueMap[$nextPlant]);
                    }
                    ?>
                    <script type="text/javascript">
                        valueData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                    <?php // готуємо дані для діаграм
                    $td = array();
                    $td [] = array('', 'Пріоритет по прибутку в грн/га');
                    foreach($profitMap as $key=>$nextPlant){
                        $td [] = array($nextPlant->getName(), (float)$profitMap[$nextPlant]);
                    }
                    ?>
                    <script type="text/javascript">
                        profitData['<?php echo $field->getId(); ?>']['<?php echo $i; ?>'] = <?php echo json_encode($td); ?>;
                    </script>

                </td>
                <?php $currentPlant=$best; ?>
            <?php endfor; ?>
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

                var title = 'Поле ' + year;
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
            });
        });

        jQuery('.year-cell').eq(0).trigger('click');
    });
    google.load("visualization", "1", {packages:["corechart"]});



</script>

<div id="chart_value" class="chart-div"></div>
<div id="chart_profit" class="chart-div"></div>
<div id="chart_all" class="chart-div"></div>
