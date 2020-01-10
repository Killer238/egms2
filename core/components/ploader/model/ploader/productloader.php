<?php

class productloader
{

    public $modx;
    public $config = array();
    public $result = array('connectors' => 0, 'founded' => 0, 'added' => 0, 'exists' => 0);


    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;
        $this->config = array(
            'param1' => 1,
            'param2' => 2,
        );
        $this->config = array_merge($this->config, $config);

    }



}