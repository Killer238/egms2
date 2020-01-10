<?php

/** @var modX $modx */
/** @var array $scriptProperties */

/** @var citySelect $citySelect */
if (!$citySelect = $modx->getService('cityselect', 'citySelect',
    $modx->getOption('cityselect_core_path', null, $modx->getOption('core_path') . 'components/cityselect/') . 'model/cityselect/')
) {
    return;
}

switch ($modx->event->name) {
    case 'OnHandleRequest':
        /* check context */
        if ($modx->context->key == 'mgr') {
            return;
        }

        /* check user location */
        if (!$modx->getOption('cityselect_check_user_location', null, true)) {
            return;
        }

        if (!$data = $citySelect->getSettlement() AND $data = $citySelect->getUserAddressByIp()) {
            $citySelect->setSettlement($data);
        }
        break;

    case 'pdoToolsOnFenomInit':
        if (!$fenom = $modx->getOption('fenom', $scriptProperties)) {
            return;
        }

        if (!isset($fenom->location)) {
            $fenom->addAccessorSmart('settlement', 'settlement', Fenom::ACCESSOR_PROPERTY);
            $fenom->settlement = $citySelect->getSettlement();
        }

        break;
}


