<?php

class msOptionsColorOnResourceDuplicate extends msOptionsColorPlugin
{
    public function run()
    {
        /** @var modResource $resource */
        $newResource = $this->modx->getOption('newResource', $this->scriptProperties, null, true);
        $oldResource = $this->modx->getOption('oldResource', $this->scriptProperties, null, true);
        if (
            !$this->msoptionscolor->getOption('create_colors_with_duplicate', null, true)
            OR
            !$newResource
            OR
            !$oldResource
            OR
            !$this->msoptionscolor->isWorkingClassKey($newResource)
            OR
            !$this->msoptionscolor->isWorkingTemplates($newResource)
        ) {
            return;
        }

        $class = 'msocColor';
        $q = $this->modx->newQuery($class);
        $q->where(array('rid' => $oldResource->get('id')));
        /** @var  xPDOObject|$color */
        foreach ($this->modx->getIterator($class, $q) as $color) {
            /** @var xPDOObject $o */
            $o = $this->modx->newObject($class);
            $o->fromArray($color->toArray(), '', true);
            $o->set('rid', $newResource->get('id'));
            $o->save();
        }

    }
}
