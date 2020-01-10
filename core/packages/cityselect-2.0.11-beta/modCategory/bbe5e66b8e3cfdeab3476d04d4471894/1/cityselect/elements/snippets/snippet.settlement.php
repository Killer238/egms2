<?php

/** @var array $scriptProperties */
/** @var citySelect $citySelect */
if (!$citySelect = $modx->getService('cityselect', 'citySelect',
    $modx->getOption('cityselect_core_path', null, $modx->getOption('core_path') . 'components/cityselect/') . 'model/cityselect/', $scriptProperties)
) {
    return 'Could not load citySelect class!';
}
$citySelect->initialize($modx->context->key, $scriptProperties);

$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl');
$settlement = $citySelect->getSettlement();

return $citySelect->pdoTools->getChunk($tpl, $settlement);
