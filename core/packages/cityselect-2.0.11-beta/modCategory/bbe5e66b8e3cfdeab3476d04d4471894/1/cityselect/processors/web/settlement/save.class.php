<?php

require_once dirname(__FILE__) . '/response.class.php';

class citySelectSettlementSaveProcessor extends citySelectResponseProcessor
{
    /** {@inheritDoc} */
    public function process()
    {
        $data = json_decode($this->getProperty('data'), true);
        $response = $this->citySelect->setSettlement($data);

        return $this->citySelect->success('', $response);
    }
}

return 'citySelectSettlementSaveProcessor';
