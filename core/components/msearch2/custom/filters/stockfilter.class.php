<?php
class stockFilter extends mse2FiltersHandler {

    public function getSortFields($sort)
    {
        //это нужно чтобы сначало показывать только тех производителей, по которым делается доставка
        $catalog_full = $this->modx->getContext($this->modx->context->key)->getOption('catalog_full');
        //die(parent::getSortFields($sort));
        //egmsDelivery|d_dayscount:desc
        if($catalog_full==1)
        {
            $prent_sort = parent::getSortFields($sort);
            //die($prent_sort);
            switch ($prent_sort){
                case "":
                    return "`egmsDelivery`.`priority` desc, `Data`.`price` asc";
                    break;
                case "`fastprice` asc":
                    return "`egmsDelivery`.`priority` desc, `egmsDelivery`.`d_dayscount` asc, `Data`.`price` asc";
                default:
                    return "`egmsDelivery`.`priority` desc, ".parent::getSortFields($sort);
            }
        }
/*            if(parent::getSortFields($sort)==""){
                return "`egmsDelivery`.`priority` desc";
            }else{
                return "`egmsDelivery`.`priority` desc, ".parent::getSortFields($sort);
            }*/
        else
            return parent::getSortFields($sort);
    }

    public function getEgmsRegionsDeliveryValues(array $fields, array $ids)
    {
       // print_r($fields);
       $results[$fields[0]] = array(
             //       'title' => net,
             //       'value' => 0,
             //       'type' => 'boolean',
                    'instock' => array(22 => 22, 42 => 42, 33 => 33, 51 => 51/*, 89 => 89*/)
            );

       // print_r($results);
        return $results;

    }

    public function getDeliveryTimeValues(array $fields, array $ids)
    {
        // print_r($fields);
        $results[$fields[0]] = array(
            //       'title' => net,
            //       'value' => 0,
            //       'type' => 'boolean',
            'instock' => array(22 => 22, 42 => 42, 33 => 33, 51 => 51/*, 89 => 89*/)
        );

        // print_r($results);
        return $results;

    }
}