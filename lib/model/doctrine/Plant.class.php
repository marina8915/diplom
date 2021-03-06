<?php

/**
 * Plant
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    marina
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Plant extends BasePlant
{
   // const SQUARE = 20;

    public function __toString(){
        return (string)$this->getName();
    }

    public function getNextPlantsValueMap()
    {
        $result = new SplObjectStorage();

        $nexts = PlantTable::getAll()->execute();
        foreach($nexts as $next){
            $result[$next] = 2;
        }

        $nexts = PlantTable::getNextsById($this->getId())->execute();
        foreach($nexts as $next){
            $result[$next] =  $next->getValue();
        }
        return $result;
    }

}
