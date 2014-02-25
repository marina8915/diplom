<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(1);

$configuration = ProjectConfiguration::getApplicationConfiguration( 'frontend', 'dev', true);
new sfDatabaseManager($configuration);

$plant = PlantTable::getAll()->fetchOne();

//foreach($plant->getPrevs() as $plant){
//    var_dump('prev='.$plant->getName());
//}

foreach($plant->getNexts() as $plant){
    var_dump('next='.$plant->getName());
}

foreach(PlantTable::getNextsById($plant->getId()) as $plant){
    var_dump('next='.$plant->getName());
}

$t->is('Plant', get_class($plant));
//$t->is('Plant', get_class($plant));