<?php

abstract class msOptionsColorPlugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var msoptionscolor $msoptionscolor */
    protected $msoptionscolor;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    public function __construct(modX $modx, &$scriptProperties)
    {
        $this->modx = &$modx;
        $this->scriptProperties =& $scriptProperties;

        $fqn = $modx->getOption('msoptionscolor_class', null, 'msoptionscolor.msoptionscolor', true);
        $path = $modx->getOption('msoptionscolor_core_path', null,
            $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/msoptionscolor/');
        $this->msoptionscolor = $modx->getService(
            $fqn,
            '',
            $path . 'model/',
            array('core_path' => $path)
        );
        if (!$this->msoptionscolor) {
            return false;
        }
        
        $this->msoptionscolor->initialize($this->modx->context->key);
    }

    abstract public function run();
}