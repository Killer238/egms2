<?php

require_once dirname(__FILE__) . '/response.class.php';

class citySelectSettlementGetListProcessor extends citySelectResponseProcessor
{
    /** {@inheritDoc} */
    public function process()
    {
        $params = $this->getProperties();
        unset($params['action']);

        $response = $this->citySelect->getSuggestSettlement($params);

        return $this->citySelect->success('', $response);
    }
}

return 'citySelectSettlementGetListProcessor';