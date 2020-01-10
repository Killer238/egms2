<?php

/**

 */


class pconnecter
{



    public static function getConnecter($id_connecter=null)
    {
        $sql = 'SELECT * FROM '._DB_PREFIX_.'egploader_connecter';
        if ($id_connecter != null)
            $sql.= ' WHERE id_connecter='.(int)$id_connecter;
        $sql .= ' ORDER BY id_connecter';

        return (Db::getInstance()->executeS($sql));
    }


    public function download($id_connecter = null, $actions = "execute")
    {
        $this->fillPconnecter($id_connecter);

        $type = ($this->connection_type == 1)?"sitemap":"category";
        $loader = new LoadManager();
        $loader->setVariables(0, $this->provider, 0, 0);
        $loader->getContent($this->url_sitemap);

        $products = $loader->getDataFromSitemap($type);
        $i_exist = 0;
        $i_addad = 0;
        foreach ($products as $product){

            $e = ploader::productExist($product, Tools::getValue('check_exist_url'));
            if($e)
                $i_exist ++;
            else
            {
                $i_addad++;
                ploader::addLoadProduct($product, $this->provider);
            }
        }
        $this->updateDatetime($id_connecter);

        $result = 'Connection: <font style="color:green;">'.$id_connecter.'</font>; Founeded: '.count($products).'; Addad: '.$i_addad.'; Exist: '.$i_exist.';<br>';
        return $result;
    }


    public function update($null_values = false)
    {

        return parent::update($null_values);

    }


    public function add($autodate = true, $null_values = false, $val)
    {
        $url_sitemap_array = explode(PHP_EOL, $this->url_sitemap);

        foreach ($url_sitemap_array as $url)
        {
            //if(substr($url, 0, 4) == "http")

            $this->url_sitemap = $url;

            $result = parent::add($autodate, $null_values);
        }

        return $result;
    }


}