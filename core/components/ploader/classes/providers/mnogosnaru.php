<?php
require_once(_PS_MODULE_DIR_.'egploader/classes/provider.php');

class mnogosnaru extends provider{

    public function isProduct()
    {
        foreach ($this->parser->find('div[id=main-block] div') as $n){
            if($n->itemtype == "http://schema.org/Product")
                return;
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
        foreach ($this->parser->find('tr[itemprop=additionalProperty]') as $div){
            $item = array();
            foreach($div->find('td[itemprop=name]') as $sdiv) {
                $item['name'] = trim($sdiv->plaintext);

            }
            foreach($div->find('td[itemprop=value]') as $sdiv) {
                $item['value'] = trim($sdiv->plaintext);
            }
            $features[] = $item;
        }
        return $features;
    }

    public function getProductConsistens(){
        return "";
    }

    public function getPrice(){

        //https://mnogosna.ru/modules/product/product_js.php?act=fetch&prod_id=24436&options[13607]=3909771
        return "999";
    }

    public function getPriceDiscount(){
        $discount = 0;
        foreach ($this->parser->find('div.discount-label') as $div){
            $discount = $div->plaintext;
        }
        $discount = trim(str_replace('%', '', str_replace('-', '', $discount)));
        $this->discount = $discount;
        return $discount;
    }

    public function getImages(){
        $images = "";
        $i=0;
        foreach ($this->parser->find('div[itemtype=http://schema.org/ImageObject] a') as $a){
            if($i>0)
                $images .= ",";
            $images .= $a->href;
            $i++;
        }
        return $images;
    }

    public function getReviews(){
        return "";
    }

    public function getSitemap($type = "sitemap")
    {
        $result = array();
        foreach ($this->parser->find('loc') as $loc){
            $result[] = str_replace('xn-----6kcarfgwrqroabgmkiqhs5r.xn--p1ai','mnogosna.ru', trim($loc->plaintext));
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