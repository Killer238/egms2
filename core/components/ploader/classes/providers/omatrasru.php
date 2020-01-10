<?php

require_once (MODX_CORE_PATH.'components/ploader/classes/provider.php');

class omatrasru extends provider{

    public function isProduct()
    {
        foreach ($this->parser->find('div.prod__cont') as $n){
            if($n->itemtype == "http://schema.org/Product")
                return ;
        }
        return $this->noprod = true;
    }

    public function getProductName(){

        foreach ($this->parser->find('h1') as $e) {
            $p = trim($e->innertext);
        }
        return $p;
    }

    public function getProductDescription(){
        $description = "";
        foreach ($this->parser->find('div[itemprop=description] p') as $p){
            $description .= $p->outertext;
        }
        return $description;
    }

    public function getProductFeatures(){
        $features = array();
        foreach ($this->parser->find('div.detail__params_group') as $div){
            $item = array();
            foreach($div->find('div.detail__params_title') as $sdiv) {
                $item['name'] = trim($sdiv->plaintext);

            }
            foreach($div->find('div.detail__params_value') as $sdiv) {
                $item['value'] = trim($sdiv->plaintext);
            }
            $features[] = $item;
        }
        return $features;
    }

    public function getManufacturer(){
        $res = "";
        foreach ($this->extractDataResult['features'] as $feature)
        {
            if ($feature['name'] == 'Производитель')
                $res = $feature['value'];
        }
        return $res;
    }

    public function getCategory()
    {
        $res = array();
        foreach ($this->parser->find('li[itemtype=http://schema.org/ListItem] a') as $a) {
            $res['breadcrumbs'][] = trim($a->plaintext);
        }

        $c = count($res['breadcrumbs']);
        if($c>0)
        {

            $res['category'] = $res['breadcrumbs'][$c-1];
        }
        return $res;
    }

    public function getProductConsistens(){
        return "";
    }

    public function getPrice(){
        $price = "";

        if( count($this->parser->find('select.style-select')))
        {
            foreach ($this->parser->find('select.style-select option') as $option){
                $size_temp = explode("-",$option->plaintext)[0];
                $price_temp = preg_replace('/[^0-9]/', "", str_replace("&thinsp;", "", explode("-",$option->plaintext)[1]));

                if($this->discount>0)
                    $price['price'][] = round($price_temp/((100 - $this->discount)/100));
                else
                    $price['price'][] = $price_temp;
                $price['sizes'][] = str_replace(" ", "", trim($size_temp));
            }
        }else{
            foreach ($this->parser->find('ins.current-price meta[itemprop=price]') as $m){
                $price = round($m->content/((100 - $this->discount)/100));
            }
        }
        return $price;
    }

    public function getPriceDiscount(){
        $discount = 0;
        foreach ($this->parser->find('div.detail__sale') as $div){
            $discount = $div->plaintext;
        }
        $discount = trim(str_replace('%', '', str_replace('-', '', $discount)));
        $this->discount = $discount;
        return $discount;
    }

    public function getImages(){
        $images_url = array();

        foreach ($this->parser->find('div.detail__images_item img') as $img){

            $part = array_reverse(explode('/',$img->src));
            $images_url[] = "https://omatras.ru/upload/iblock/".substr($part[0],0,3)."/".$part[0];

        }
        return $images_url;
    }

    public function getReviews(){
        return "";
    }

    public function getSitemap($type = "sitemap")
    {
        $result = array();
        foreach ($this->parser->find('loc') as $loc){
            $result[] = trim($loc->plaintext);
        }
        return $result;
    }
    public function getMetaTitle(){
        return "not implemented!!";
    }

    public function getMetaDescription(){
        return "not implemented!!";
    }

    public function getMetaKeywords(){
        return "not implemented!!";
    }

    public function getH1(){
        return "not implemented!!";
    }
}