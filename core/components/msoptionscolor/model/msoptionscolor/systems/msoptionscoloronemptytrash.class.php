<?php

class msOptionsColorOnEmptyTrash extends msOptionsColorPlugin
{
    public function run()
    {
        $ids = (array)$this->modx->getOption('ids', $this->scriptProperties, array(), true);
        $this->modx->removeCollection('msocColor', array('rid:IN' => $ids));
    }
}
