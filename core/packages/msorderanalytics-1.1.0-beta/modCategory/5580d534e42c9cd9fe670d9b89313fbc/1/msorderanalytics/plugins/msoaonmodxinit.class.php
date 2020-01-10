<?php

/**
 * Расширяем нативный MAP массив
 */
class msoaOnMODXInit extends msoaPlugin
{
    public function run()
    {
        $this->map(array(
            'modResource' => array(
                'composites' => array(
                    'msoaObjects' => array(
                        'class' => 'msoaObject',
                        'local' => 'id',
                        'foreign' => 'parent',
                        'cardinality' => 'many',
                        'owner' => 'local',
                        'criteria' => array(
                            'foreign' => array(
                                'class' => 'modResource',
                            ),
                        ),
                    ),
                ),
            ),
        ));
    }
    
    /**
     * @param array $map
     *
     * @return bool
     */
    public function map(array $map = array())
    {
        foreach ($map as $class => $data) {
            $this->modx->loadClass($class);

            foreach ($data as $tmp => $fields) {
                if ($tmp == 'fields') {
                    foreach ($fields as $field => $value) {
                        foreach (array('fields', 'fieldMeta', 'indexes') as $key) {
                            if (isset($data[$key][$field])) {
                                $this->modx->map[$class][$key][$field] = $data[$key][$field];
                            }
                        }
                    }
                } elseif ($tmp == 'composites' || $tmp == 'aggregates') {
                    foreach ($fields as $alias => $relation) {
                        if (!isset($this->modx->map[$class][$tmp][$alias])) {
                            $this->modx->map[$class][$tmp][$alias] = $relation;
                        }
                    }
                }
            }
        }

        return true;
    }
}