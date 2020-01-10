<?php

require_once dirname(__FILE__) . '/response.class.php';

class citySelectSettlementGetProcessor extends citySelectResponseProcessor
{
    /** {@inheritDoc} */
    public function process()
    {
        $response = $this->citySelect->getSettlement();

        return $this->citySelect->success('', $response);
    }

}

return 'citySelectSettlementGetProcessor';