<?php

class msOptionsColorOnDocFormPrerender extends msOptionsColorPlugin
{
    public function run()
    {
        $mode = $this->modx->getOption('mode', $this->scriptProperties, modSystemEvent::MODE_NEW, true);
        if ($mode == modSystemEvent::MODE_NEW) {
            return;
        }

        /** @var modResource $resource */
        $resource = $this->modx->getOption('resource', $this->scriptProperties, null, true);
        if (
            !$resource
            OR
            !$this->msoptionscolor->isWorkingClassKey($resource)
            OR
            !$this->msoptionscolor->isWorkingTemplates($resource)
        ) {
            return;
        }

        $this->msoptionscolor->loadControllerJsCss($this->modx->controller, array(
            'css'             => true,
            'config'          => true,
            'tools'           => true,
            'color'           => true,
            'resource/inject' => true,
        ));
    }
}