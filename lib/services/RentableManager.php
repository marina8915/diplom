<?php

class RentableManager{

    public function getSortedPlants($plants, CalcConfig $config)
    {

        $valueMap = $plants;
        $profitMap = $this->getProfitMap($plants, $config);

        return $this->getMixedMap($profitMap, $valueMap);
    }

    public function getMostWantedPlant(array $resultingArray)
    {

     return $resultingArray[$this->getMaxArrayKey($resultingArray)];

    }


    // підрахунок рентабельності для культури
    public function getRentable(Plant $plant, CalcConfig $config){
        $money = 0;
        $money -= $this->getSeedingCost($plant);
        $money -= $this->getHoursCost($plant, $config->getHourPrice());
        $money -= $this->getFuelCost($plant, $config->getFuelPrice());
        $money -= $this->getFertilizerCost($plant);
        $money += $this->getGrowProfit($plant);
        return $money;

    }

    public function getFertilizerCost(Plant $plant){
        return $plant->getFertilizer()->getPrice() * $plant->getFertilizerMass();
    }

    public function getSeedingCost(Plant $plant){
        return $plant->getSeedingRate() *  $plant->getSeedPrice();
    }

    public function getHoursCost(Plant $plant, $price){
        return $plant->getManHours() * $price;
    }

    public function getFuelCost(Plant $plant, $price){
        return $plant->getFuel() * $price;
    }

    public function getGrowProfit(Plant $plant){
        return $plant->getPrice() * $plant->getGrowingRate();
    }

    // ассоціація рентабельності до рослини
    public function getProfitMap($plants, CalcConfig $config){
        $map = new SplObjectStorage();
        foreach($plants as $plant){
            $map[$plant] = $this->getRentable($plant, $config);
        }
        return $map;
    }

    // знаходження максиманьне значення (попарного порівняння попередників-наступників чи рентабельності)
    public function getMaxValue(SplObjectStorage $plants)
    {
        $max = null;
        foreach($plants as $plant){
            $value = $plants[$plant];
            if (is_null($max)) $max = $value;
            if ($max < $value) $max = $value;
        }
        return !is_null($max)?$max:0;
    }
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//СумарнеЗнач=МакЗначПоперднків/МакЗначПоПрибутку*ЗначПоПрибутку*Індекс+ЗначПоперднків*Індекс

    // приводить значення параметрів до єдиної шкали, суммує параметри, привязує до параметра культуру
    public function getMixedMap(SplObjectStorage $profitMap , SplObjectStorage $valueMap)
    {
        $result = array();

        $maxValue = $this->getMaxValue($valueMap);
        $maxProfit = $this->getMaxValue($profitMap);
        $scale = $maxValue != 0 ? $maxValue / $maxProfit : 1;

        foreach($profitMap as $plant){
            $key = ($scale *$profitMap[$plant])*0.67 +  $valueMap[$plant]*0.33;
            $result[(string)$key] = $plant;
        }

        return $result;
    }

    public function getMaxArrayKey(array $array)
    {
        $max = null;
        foreach(array_keys($array) as $key){
            if (is_null($max)) $max = $key;
            if ($max < (floatval($key))) $max = $key;
        }
        return !is_null($max)?$max:0;
    }
}