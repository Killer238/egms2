<?php

class SeodomainsCityGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'SeodomainsCity';
    public $defaultSortField = 'id'; 
    public $defaultSortDirection = 'ASC';
    
    /**
     * @param xPDOQuery $c
     *
     * @return array
     */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $query = trim($this->getProperty('query'));
        if ($query) {
            $c->where(array(
                'domain:LIKE' => "%{$query}%",
                'OR:city:LIKE' => "%{$query}%",
            ));
        }

        return $c;
    }
    
     /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $array = $object->toArray();
        
        $array['actions'] = array();
        
        // Edit
        $array['actions'][] = array(
            'cls' => 'seodomains-update',
            'icon' => 'icon icon-edit',
            'title' => $this->modx->lexicon('update'),
            //'multiple' => $this->modx->lexicon('view'),
            'action' => 'updateItem',
            'button' => true,
            'menu' => true,
        );

        // Copy
        $array['actions'][] = array(
            'cls' => 'seodomains-duplicate',
            'icon' => 'icon icon-copy',
            'title' => $this->modx->lexicon('duplicate'),
            //'multiple' => $this->modx->lexicon('view'),
            'action' => 'duplicateItem',
            'button' => true,
            'menu' => true,
        );
        
        // Remove
        $array['actions'][] = array(
            'cls' => 'seodomains-remove',
            'icon' => 'icon icon-trash-o action-red',
            'title' => $this->modx->lexicon('remove'),
            'multiple' => $this->modx->lexicon('remove'),
            'action' => 'removeItem',
            'button' => true,
            'menu' => true,
        );

        return $array;
    }
}

return "SeodomainsCityGetListProcessor";