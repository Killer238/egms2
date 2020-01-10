<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

$key = "matras_type";

if ($option = $modx->getObject('msOption', array('key' => $key)))
{
    $t = $option;
}
/*
    print 'Option not found' . PHP_EOL;

    if ($found = $modx->getObject('msOption', array('key' => $key))) {
        print 'Option key exists' . PHP_EOL;
        $key = $key . '_2';
    }
    $option = $modx->newObject('msOption');
    $option->fromArray(array('key' => $key, 'caption' => $name, 'type' => 'textfield'));
    $option->save();
    print 'Option '.$key.' created' . PHP_EOL;
} else {
    print 'Option found' . PHP_EOL;
}
if (!$cop = $modx->getObject('msCategoryOption', array('option_id' => $option->id, 'category_id' => $res->parent))) {
    print 'Category option not found' . PHP_EOL;
    $table = $modx->getTableName('msCategoryOption');
    $sql = "INSERT INTO {$table} (`option_id`,`category_id`,`active`) VALUES ({$option->id}, {$res->parent}, 1);";
    $stmt = $this->modx->prepare($sql);
    $stmt->execute();
    print 'Category option created' . PHP_EOL;
} else {
    print 'Category option found' . PHP_EOL;
    $q = $modx->newQuery('msCategoryOption');
    $q->command('UPDATE');
    $q->where(array('option_id' => $option->id, 'category_id' => $res->parent));
    $q->set(array('active' => 1));
    $q->prepare();
    $q->stmt->execute();
    print 'Category option updated' . PHP_EOL;
}

if ($po = $modx->getObject('msProductOption', array('product_id' => $res->id, 'key' => $option->key))) {
    print 'Value found' . PHP_EOL;
    $q = $modx->newQuery('msProductOption');
    $q->command('UPDATE');
    $q->where(array('key' => $option->key));
    $q->set(array('value' => $val));
    $q->prepare();
    $q->stmt->execute();
    print 'Value updated' . PHP_EOL;
} else {
    print 'Value not found' . PHP_EOL;
    $table = $modx->getTableName('msProductOption');
    if (!is_int($val)) {
        $val = '"' . $val . '"';
    }
    $sql = "INSERT INTO {$table} (`product_id`,`key`,`value`) VALUES ({$res->id}, \"{$option->key}\", {$val});";
    $stmt = $this->modx->prepare($sql);
    $stmt->execute();
    print 'Value created' . PHP_EOL;
}
*/