<?php

class SeodomainsImportProcessor extends modProcessor {
    public function process() {
        $Seodomains = $this->modx->getService('Seodomains', 'Seodomains', MODX_CORE_PATH . 'components/seodomains/model/');
        
        $response = $Seodomains->import($_POST['file-import'], $_POST['step-import']);

        $num = $_POST['step-import']-1;
        if ($response != 0) {
            return $this->success('Городов добавлено: '.$num);
        } else {
            return $this->failure('Городов добавлено: '.$num);
        }
    }
}

return "SeodomainsImportProcessor";