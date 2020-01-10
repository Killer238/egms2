<?php
class stockFilter extends mse2FiltersHandler {

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