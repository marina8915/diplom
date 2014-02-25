<?php

/**
 * PlantTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PlantTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object PlantTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Plant');
    }

    public static function getAll()
    {
        return Doctrine_Query::create()
            ->select("p.*")
            ->from('Plant p')
            ->orderBy('p.price desc')
            ;
    }

    public static function getNextsById($id)
    {
        return Doctrine_Query::create()
            ->select("p.*, n.value as value")
            ->from('Plant p')
            ->leftJoin("p.PrevPR n")
            ->where('n.prev_plant_id = ?', $id)
            ->orderBy('n.value desc')
            ;
    }
}