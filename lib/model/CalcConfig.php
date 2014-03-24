<?php

class CalcConfig{

    private $hourPrice;
    private $fuelPrice;
    private $groundType;
    private $heaven;

    public static function hydrate(CalcConfig $calcConfig, array $data)
    {
        if (isset($data['fuel_price']))
        $calcConfig->setFuelPrice($data['fuel_price']);
        if (isset($data['hour_price']))
        $calcConfig->setHourPrice($data['hour_price']);
      if (isset($data['ground_type'])){
          $groundType = GroundTypeTable::findById($data['ground_type']);
           $calcConfig->setGroundType($groundType);
      }
          if (isset($data['heaven'])){
              $heaven = HeavenTable::findHeaven($data['heaven']);
              $calcConfig->setHeaven($heaven);
        }

        return $calcConfig;
    }

    public function setFuelPrice($fuelPrice)
    {
        $this->fuelPrice = $fuelPrice;
    }

    public function getFuelPrice()
    {
        return $this->fuelPrice;
    }

    public function setGroundType(GroundType $groundType)
    {
        $this->groundType = $groundType;
    }

    public function getGroundType()
    {
        return $this->groundType;
    }

    public function setHeaven(Heaven $heaven)
    {
        $this->heaven = $heaven;
    }

        public function getHeaven()
    {
        return $this->heaven;
    }

    public function setHourPrice($hourPrice)
    {
        $this->hourPrice = $hourPrice;
    }

    public function getHourPrice()
    {
        return $this->hourPrice;
    }


}