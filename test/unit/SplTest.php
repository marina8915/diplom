<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(1);

function get_execution_time()
{
    static $microtime_start = null;
    if($microtime_start === null)
    {
        $microtime_start = microtime(true);
        return 0.0;
    }
    return microtime(true) - $microtime_start;
}

class TestClass{
    public $v;
    public function __construct(){
        $this->v = 'bootstrapbootstrapbootstrapbootstrapbootstrapbootstrapbootstrapbootstrapbootstrapbootstrapbootstrapbootstrap';
    }
}

$s = new SplObjectStorage();

$n = 100000;
$array= array();
for($i = 1; $i<=$n; $i++){
    if ($i % 20000 == 0){
        print('usage='. memory_get_usage().PHP_EOL);
        print('peak usage='. memory_get_peak_usage().PHP_EOL);
    }
    $obj = new TestClass();
    $s[$obj] = 'unitunitunitunitunitunit';
//    $array[]=array('obj'=>$obj, 'val'=>'unitunitunitunitunitunit');
}

get_execution_time();
foreach($s as $item){
    $as = $item->v;
}

print('spend='. get_execution_time().PHP_EOL);