<?php

/** @var array $scriptProperties */
/** @var msoptionscolor $msoptionscolor */

$fqn = $modx->getOption('msoptionscolor_class', null, 'msoptionscolor.msoptionscolor', true);
$path = $modx->getOption('msoptionscolor_core_path', null,
    $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/msoptionscolor/');
if (!$msoptionscolor = $modx->getService($fqn, '', $path . 'model/',
    array('core_path' => $path))
) {
    return false;
}

$className = 'msOptionsColor' . $modx->event->name;
$modx->loadClass('msOptionsColorPlugin', $msoptionscolor->getOption('modelPath') . 'msoptionscolor/systems/', true,
    true);
$modx->loadClass($className, $msoptionscolor->getOption('modelPath') . 'msoptionscolor/systems/', true, true);
if (class_exists($className)) {
    /** @var msoptionscolorPlugin $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}
return;