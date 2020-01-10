<?php
/*
$pageVarKey = 'size';
if (preg_match("#.*?({$pageVarKey})(.*)#", $_REQUEST[$req], $matches)) {
    // Отрезаем ЧПУ строку и получаем точный адрес текущей страницы
    $uri = str_replace($matches[2], '', $matches[0]);
    $uri = str_replace($matches[1], '', $uri);

    // Ищем страницу по этому адресу
    $id = 0;

}

*/
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

function getSubDomain($host) {

/*    $tmp = explode('.', $data);
    $tmp = array_slice($tmp, 0, -2);
    $str = implode(".", $tmp);
*/
    $alias = implode(".", array_slice(explode('.', $host), 0, -2));

    return $alias;
}

//echo getSubDomain('www.www.example.com');     // sub.dev
 //echo getSubDomain('http://nn.example.com');     // dev
//echo getSubDomain('http://example.com');     // dev

$classModification = 'msopModification';
$classOption = 'msopModificationOption';

if (!function_exists('getModificationOptions')) {
    function getModificationOptions(modX & $modx, $rid = null, $showZeroCount = true)
    {
        $options = [];

        $classModification = 'msopModification';
        $classOption = 'msopModificationOption';
        $classMsOption = 'msOption';

        $q = $modx->newQuery($classOption);
        $q->innerJoin($classModification, $classModification, "{$classModification}.id = {$classOption}.mid");
        $q->leftJoin($classMsOption, $classMsOption, "{$classOption}.key = {$classMsOption}.key");

        $q->select($modx->getSelectColumns($classOption, $classOption));
        $q->select($modx->getSelectColumns($classModification, $classModification));
        $q->select($modx->getSelectColumns($classMsOption, $classMsOption, '', ['caption'], false));

        $q->where([
            "{$classOption}.rid"          => "{$rid}",
            "{$classModification}.active" => true,
        ]);
        if (!$showZeroCount) {
            $q->andCondition([
                "{$classModification}.count:>" => 0,
            ]);
        }
        $options = array();
        if ($q->prepare() AND $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                $tmp = array(
                    'mid' => $row['mid'],
                    'key' => $row['key'],
                    'value' => $row['value'],
                    'price' => $row['price'],
                    'old_price' => $row['old_price'],
                    'selected' => ''
                );

                $options[] = $tmp;

            }
        }

        return $options;
    }
}

$productData = getModificationOptions($modx, 42);

print_r($productData);


