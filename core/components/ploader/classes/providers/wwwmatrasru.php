<?php

require_once (MODX_CORE_PATH.'components/ploader/classes/provider.php');

class wwwmatrasru  extends provider{

    public $json_text;

    public function isProduct()
    {
        return ;
    }

    public function getProductName(){

        foreach ($this->parser->find('h1') as $e) {
            foreach($e->find('span') as $span) {
                $span->outertext = '';
            }
            $p = trim($e->innertext);
        }
        return $p;
    }

    public function getProductDescription(){

        $description = "";
        $i=1;
        foreach ($this->parser->find('div.item-description-content div.description-body p') as $p){
            if(count($this->parser->find('div.item-description-content div.description-body p'))>$i)
                $description .= "<p>".$p->plaintext."</p>";
            $i++;
        }

        return $description;
    }

    public function getProductFeatures(){
        $features = array();
        foreach ($this->parser->find('table.info-tab tr') as $tr){
            $item = array();
            foreach($tr->find('td') as $td) {
                if($td->class=="define")
                    $item['name'] =  trim($td->plaintext);
                else
                    $item['value'] = trim($td->plaintext);
            }
            $features[] = $item;
        }

        return $features;
    }

    //returt array( common, options, mods);
    public function getPrice(){

        $prod_id = 0;
        $w = 0;
        $l = 0;
        foreach ($this->parser->find('span.to-favorites') as $a)
        {
            $prod_id = $a->attr['data-id'];
            foreach ($this->parser->find('input[id=good-provider-size]') as $si) {
                $w = $si->attr['data-width'];
                $l = $si->attr['data-length'];
            }
        }
        //die("-".$this->content);
        $url = 'https://www.matras.ru/api/catalog/item/'.$prod_id.'?common=true&sizes=true&kits=true&colors=true&filter_width='.$w.'&filter_length='.$l;

        $this->json_text = $this->getContentItem($url, $this->id, $pref = "api", $this->proxy, $this->use_cache, $cookie_use = false);
        $base_data = json_decode($this->json_text,1);

        $result2 = array();

        //заполняем массивы цвета , размера и оснований
        foreach ($base_data as $key => $data_group){
            $needle = array('colors', 'sizes', 'kits');
            if(in_array($key, $needle)){
                foreach ($data_group as $option){
                    if($key == 'colors'){
                        $result2['options']['color'][]= array(
                            'id' => $option['id'],
                            'name' => $option['name'],
                            'image' => $option['url']
                        );
                    }

                    if($key == 'sizes'){
                        $result2['options']['size'][]= array(
                            'id' => $option['id'],
                            'name' => $option['w'].'x'.$option['h'],
                            'price' => $option['price'],
                            'old_price' => $option['discount_price'],
                        );
                    }

                    if($key == 'kits'){
                        $result2['options']['kit'][]= array(
                            'id' => $option['id'],
                            'name' => $option['kits'],
                        );
                    }
                }
            }
        }
        /*
        //пустой мод - грузим только размеры в модификации
        $mode = '';
        //если есть основания то комбинации гоним только по китам
        if($result2['options']['size']['kit'])
            $mode = 'kit';
            //если оснований нет, то проверяем есть ли цвета
            if($result2['options']['size']['color'])
                $mode = 'color';
*/
        /*
        $url = 'https://www.matras.ru/api/catalog/item/'.$prod_id.'?common=true&sizes=true&kits=true&colors=true&filter_width='.
            $w.'&filter_length='.$l.'&color='.$id_color.'&kit='.$kit_id;

        $temp_res = $this->getContentItem($url, $this->id, $pref = "api", $this->proxy, $this->use_cache, $cookie_use = false);
        $temp_data = json_decode($temp_res,1);
*/

        foreach ($result2['options']['size'] as $size){
            //получаем основую цену с первого размера
            if (!$result2['common'])
            {
                $result2['common'] = array(
                    'price' => $size['price'],
                    'old_price' =>  $size['old_price'],
                );
            }
            // получаем модификации
            if($size['price'] != $result2['common']['price'])
            {
                $result2['mods'][] = array(
                    'name' => $size['name'],
                    'price' => $size['price'],
                    'old_price' => ($size['price']==$size['old_price'])?0:$size['old_price'],
                    'options' => array(
                        'size' => $size['name'],
                        //'color' => 2,
                        //'kits' => 3,
                    )
                );
            }
        }



        return $result2;
        /*
        $this->json_text = $this->getContentItem($url, $this->id, $pref = "api", $this->proxy, $this->use_cache, $cookie_use = false);

        $json = json_decode($this->json_text, true);

        $modifications = array();
        $i=0;
        foreach ($json['sizes'] as $item)
        {
            if($i==0)
            {
                $result['price'] = $item['price'];
                $result['old_price'] = $item['discount_price'];
            }

            $modifications[] = array(
                'name' => 'size',
                'price' => $item['discount_price'],
                'old_price' => $item['price'],
                'options' => array(
                    'size' => $item['w'].'x'.$item['h'],
                )
            );

            $i++;
        }
        $result['modifications'] = $modifications;

        return $result;
        */
        /*
        $price = "";

        if( count($this->parser->find('div.sizes-grid')))
        {
            foreach ($this->parser->find('div.sizes-grid ul li strong, div.sizes-grid ul li a') as $li){
                $t=$li->attr['title'];
                if($t != null){
                    $price_temp = preg_replace('/[^0-9]/', "", str_replace("&thinsp;", "", $t));
                    if($this->discount>0)
                        $price['price'][] = round($price_temp/((100 - $this->discount)/100));
                    else
                        $price['price'][] = $price_temp;
                    $price['sizes'][] = str_replace(" ", "", trim($li->plaintext));
                }
            }

        }*/

      //  return $price;
    }

    public function getPriceDiscount(){

        $discount = 0;
        foreach ($this->parser->find('div.discount') as $div){
            $discount = $div->plaintext;
        }
        $discount = trim(str_replace('%', '', str_replace('-', '', $discount)));
        $this->discount = $discount;
        return $discount;
    }

    public function getImages(){
        $images_url = array();

        foreach ($this->parser->find('a.various img') as $img){
            $images_url[] = "https://www.matras.ru".$img->src;
        }
        foreach ($this->parser->find('a.thumb') as $a){
            $images_url[] = "https://www.matras.ru".$a->href;
        }

        return $images_url;
    }

    public function getProductConsistens(){

        $consistence = array();

        foreach ($this->parser->find('div.bottom-container li') as $con){
            $item = array();

            foreach ($con->find('span.extend') as $div){
                $item['name'] = trim(ltrim(trim($div->plaintext), '&mdash;&nbsp;'));
            }

            foreach ($con->find('div.popup-content') as $div){
                $item['description'] = trim($div->plaintext);
            }
            foreach ($con->find('div.layer-info img') as $img){
                $item['image_url'] = "https://www.matras.ru".$img->src;
            }

            $consistence[] = $item;
        }
        return $consistence;
    }

    public function getManufacturer(){
        $json = json_decode($this->json_text, true);
        $res = $json['common']['brand'];
        return $res;
    }

    public function getCategory()
    {
        $res = array();
        $i=0;
        foreach ($this->parser->find('div.breadcrumbs a') as $a) {
            if($i>0)
                $res['breadcrumbs'][] = trim($a->plaintext);
            $i++;
        }

        $c = count($res['breadcrumbs']);
        if($c>0)
        {

            $res['category'] = $res['breadcrumbs'][$c-1];
        }
        return $res;
    }

    public function getReviews(){
        return "";
    }

    public function getSitemap($type = "category")
    {
        $result = array();

        if ($type == "category")
            foreach ($this->parser->find('span.pic a') as $a){
                $result[] = "https://www.matras.ru".trim($a->href);
            }
        else
            $result = "";
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