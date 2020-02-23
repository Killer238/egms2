<?php

class msocColor extends xPDOObject
{

    public static function load(xPDO & $xpdo, $className, $criteria, $cacheFlag = true)
    {
        /** @var $instance msocColor */
        $instance = parent::load($xpdo, 'msocColor', $criteria, $cacheFlag);
        if (!is_object($instance) OR !($instance instanceof $className)) {
            if (is_array($criteria) AND isset($criteria['rid'], $criteria['key'], $criteria['value'])) {
                $query = array(
                    'rid'   => (int)$criteria['rid'],
                    'key'   => trim($criteria['key']),
                    'value' => trim($criteria['value']),
                );
                $q = $xpdo->newQuery('msocColor');
                $q->where($query);
                if (!$instance = $xpdo->getObject('msocColor', $q)) {
                    $instance = $xpdo->newObject('msocColor');
                    $instance->fromArray($query, '', true);
                    if ($xpdo->getOption('msoptionscolor_fill_colors_with_create', null, false)) {
                        $row = $instance->getColor();
                        $instance->fromArray($row);
                    }

                    if ($instance->save()) {
                        //$instance->_new = true;
                    }
                }
            }
        }

        return $instance;
    }

    public function getColor($key = null, $value = null, $rid = null)
    {
        if (is_null($key)) {
            $key = parent::get('key');
        }
        if (is_null($value)) {
            $value = parent::get('value');
        }

        $class = 'msocColor';
        $q = $this->xpdo->newQuery($class);
        $q->where(array(
            "{$class}.key"   => "{$key}",
            "{$class}.value" => "{$value}",
        ));

        if (!is_null($rid)) {
            $q->where(array(
                "{$class}.rid" => "{$rid}",
            ));
        }
        $q->select($this->xpdo->getSelectColumns($class, $class, '', array('rid'), true));
        $q->limit(1);

        $row = array();
        if ($q->prepare() AND $q->stmt->execute()) {
            if (!$row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                $row = array();
            }
        }

        return $row;
    }

    /**
     * @param null $cacheFlag
     *
     * @return bool
     */
    public function save($cacheFlag = null)
    {
        $isNew = $this->isNew();

        if ($this->xpdo instanceof modX) {
            $this->xpdo->invokeEvent('msocColorBeforeSave', array(
                'mode'      => $isNew ? modSystemEvent::MODE_NEW : modSystemEvent::MODE_UPD,
                'color'     => &$this,
                'cacheFlag' => $cacheFlag,
            ));
        }

        $saved = parent:: save($cacheFlag);

        if ($saved && $this->xpdo instanceof modX) {
            $this->xpdo->invokeEvent('msocColorSave', array(
                'mode'      => $isNew ? modSystemEvent::MODE_NEW : modSystemEvent::MODE_UPD,
                'color'     => &$this,
                'cacheFlag' => $cacheFlag,
            ));
        }

        return $saved;
    }

    public function remove(array $ancestors = array())
    {
        if ($this->xpdo instanceof modX) {
            $this->xpdo->invokeEvent('msocColorBeforeRemove', array(
                'color'     => &$this,
                'ancestors' => $ancestors,
            ));
        }

        $remove = parent::remove($ancestors);

        if ($this->xpdo instanceof modX) {
            $this->xpdo->invokeEvent('msocColorRemove', array(
                'color'     => &$this,
                'ancestors' => $ancestors,
            ));
        }

        return $remove;
    }

    public static function getThumbs(xPDO & $xpdo, array $row = array(), array $thumbs = array())
    {
        $data = array();

        $ids = array();
        if (!empty($row['image'])) {
            $ids[] = $row['image'];
        }
        if (!empty($row['image2'])) {
            $ids[] = $row['image2'];
        }

        if (!empty($thumbs) AND !empty($ids)) {
            $q = $xpdo->newQuery('msProductFile', array(
                'id:IN' => $ids,
            ));
            $q->sortby("FIELD (msProductFile.id, '" . implode("','", $ids) . "')", "ASC");
            $q->select("msProductFile.url as main");

            foreach ($thumbs as $thumb) {
                $tmp = '_' . $thumb;
                $q->leftJoin('msProductFile', $tmp, "{$tmp}.parent = msProductFile.id AND {$tmp}.path LIKE '%{$thumb}/%'");
                $q->select("{$tmp}.url as {$thumb}");
            }

            if ($q->prepare() && $q->stmt->execute()) {
                while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                    foreach ($row as $k => $v) {
                        if (!isset($data[$k])) {
                            $data[$k] = array();
                        }
                        if (!empty($v)) {
                            $data[$k][] = $v;
                        }
                    }
                }
            }
        }

        return $data;
    }
}