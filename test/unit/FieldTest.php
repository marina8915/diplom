<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(2);

$configuration = ProjectConfiguration::getApplicationConfiguration( 'frontend', 'dev', true);
new sfDatabaseManager($configuration);

$field = FieldTable::getAll()->fetchOne();

$t->is('Field', get_class($field));
$t->is('Plant', get_class($field->getPlant()));