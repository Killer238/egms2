<?php

/** @var array $scriptProperties */
$corePath = $modx->getOption('msoptionscolor_core_path', null,
    $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/msoptionscolor/');
/** @var msoptionscolor $msoptionscolor */
$msoptionscolor = $modx->getService('msoptionscolor', 'msoptionscolor', $corePath . 'model/msoptionscolor/',
    ['core_path' => $corePath]);
if (!$msoptionscolor) {
    return 'Could not load msoptionscolor class!';
}
/** @var pdoFetch $pdoFetch */

$fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
$path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}
$pdoFetch->setConfig($scriptProperties);
$pdoFetch->addTime('pdoTools loaded.');

$class = $scriptProperties['class'] = 'msocColor';
$tpl = $scriptProperties['tpl'] = $modx->getOption('tpl', $scriptProperties, 'tpl.msOptionsColor', true);
$product = $scriptProperties['product'] = $modx->getOption('product', $scriptProperties, $modx->resource->id, true);
$options = $scriptProperties['options'] = $modx->getOption('options', $scriptProperties, 'size', true);
$byOptions = $scriptProperties['byOptions'] = $modx->getOption('byOptions', $scriptProperties, '{}', true);
$excludeOptions = $modx->getOption('excludeOptions', $scriptProperties, 'modification,modifications,mssetincart,msal', true);

/** @var msProduct $product */
$product = $modx->getObject('msProduct', $product);
if (!$product OR !($product instanceof msProduct)) {
    return "[msOptionsColor] The resource with id = {$product->id} is not instance of msProduct.";
}

// Add user parameters
foreach (['byOptions'] as $k) {
    if (!empty($scriptProperties[$k])) {
        $tmp = $scriptProperties[$k];
        if (!is_array($tmp)) {
            $tmp = json_decode($tmp, true);
        }
        ${$k} = $scriptProperties[$k] = $tmp;
    }
}

if (!empty($excludeOptions) AND !is_array($excludeOptions)) {
    $excludeOptions = $msoptionscolor->explodeAndClean($excludeOptions);
}
$excludeOptions = is_array($excludeOptions) ? $excludeOptions : [];

$options = $msoptionscolor->explodeAndClean($options);
if (!empty($byOptions)) {
    $options = array_keys($byOptions);
    foreach ($options as $k => $v) {
        if (in_array($v, $excludeOptions)) {
            unset($options[$k]);
        }
    }
    $scriptProperties['limit'] = 0;
}

// where
$where = [
    "{$class}.rid"    => $product->id,
    "{$class}.key:IN" => $options,
];
if (empty($showEmptyColor)) {
    $where["{$class}.color:!="] = "";
}
if (empty($showEmptyPattern)) {
    $where["{$class}.pattern:!="] = "";
}
if (empty($showInactive)) {
    $where["{$class}.active"] = 1;
}

$groupby = [];
$leftJoin = [];
$innerJoin = [];
$select = [
    $class => $modx->getSelectColumns($class, $class),
];
$sortby = [];

// Include thumbnails
if (!empty($includeThumbs)) {
    $thumbs = $msoptionscolor->explodeAndClean($includeThumbs);
}

foreach (['where', 'leftJoin', 'innerJoin', 'select', 'groupby', 'sortby'] as $v) {
    if (!empty($scriptProperties[$v])) {
        $tmp = $scriptProperties[$v];
        if (!is_array($tmp)) {
            $tmp = json_decode($tmp, true);
        }
        if (is_array($tmp)) {
            $$v = array_merge($$v, $tmp);
        }
    }
    unset($scriptProperties[$v]);
}

if (!empty($options)) {
    foreach ($options as $option) {
        if (empty($byOptions[$option])) {
            $innerJoin[$option] = [
                'class' => 'msProductOption',
                'on'    => "`{$option}`.key = {$class}.key AND `{$option}`.value = {$class}.value AND `{$option}`.product_id = {$class}.rid",
            ];
            if (isset($product->loadData()->_fields[$option])) {
                $values = $product->get($option);
                if (!empty($values) AND is_array($values)) {
//                    $values = implode("`','`", $values);
//                    $sortby["FIELD (`{$option}`.`value`, '`{$values}`')"] = "ASC";

                    $values = implode("','", $values);
                    $sortby["FIELD (`{$option}`.`value`, '{$values}')"] = "ASC";
                }
            }
        } else {
            $innerJoin[$option] = [
                'class' => 'msProductOption',
                'on'    => "`{$option}`.key = {$class}.key AND `{$option}`.value = {$class}.value AND `{$option}`.product_id = {$class}.rid",
            ];
        }
    }
}

$pdoFetch->addTime('Conditions prepared');

$default = [
    'class'             => $class,
    'where'             => $where,
    'leftJoin'          => $leftJoin,
    'innerJoin'         => $innerJoin,
    'select'            => $select,
    'sortby'            => json_encode($sortby, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
    'sortdir'           => 'ASC',
    'groupby'           => implode(', ', $groupby),
    'return'            => 'data',
    'nestedChunkPrefix' => 'minishop2_',
];

// Merge all properties and run!
$pdoFetch->setConfig(array_merge($default, $scriptProperties), false);
$rows = $pdoFetch->run();

// Process rows
$output = $colors = [];
if (!empty($rows) AND is_array($rows)) {
    foreach ($rows as $k => $row) {
        $key = $row['key'];
        $value = $row['value'];

        // process thumbs
        $row['thumbs'] = null;
        if (!empty($thumbs)) {
            $row['thumbs'] = $modx->call('msocColor', 'getThumbs', [&$modx, $row, $thumbs]);
        }

        // byOptions
        if (!empty($byOptions) AND $byOptions[$key] == $value) {
            $colors[$key] = $row;
        } else if (empty($byOptions)) {
            $colors[$key][] = $row;
        }

    }
}

if ($modx->user->hasSessionContext('mgr') AND !empty($showLog)) {
    $modx->log(modX::LOG_LEVEL_ERROR, print_r($pdoFetch->getTime(), 1));
}

if (!empty($scriptProperties['return']) AND $scriptProperties['return'] === 'data') {
    return $colors;
}

$output = $pdoFetch->getChunk($tpl, [
    'id'     => $product->id,
    'colors' => $colors,
]);
if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder, $output);
} else {
    return $output;
}