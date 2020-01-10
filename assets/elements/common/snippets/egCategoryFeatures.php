<?php
$category_id = $modx->getOption('category_id', $scriptProperties);

$select = array(
    'option_id:>' => 1,
    'category_id' => $category_id,
);

$query = $modx->newQuery('msCategoryOption');
$query->setClassAlias('msCategoryOption');
$query->sortby('rank', 'ASC');
$query->innerJoin('msOption', 'msOption', '`msOption`.`id` = `msCategoryOption`.`option_id`');
$query->select(array('`msOption`.key as `key`'));

$query->where(array(
    'category_id' => $category_id,
    'required' => 1
));

$query->prepare();
//die($query->toSQL());
$query->stmt->execute();
$rows = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
$output = '';
foreach ($rows as $row) {
    $output[] = $row['key'];
}
//die(print_r($output));
return implode(",", $output);