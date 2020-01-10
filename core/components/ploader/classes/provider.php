<?php

abstract class provider
{

    public $content;
    public $parser;
    public $noprod;
    public $extractDataResult;
    public $discount;
    public $content_cache;
    public $provider;
    public $errors;

    public $id;
    public $proxy;
    public $use_cache;

    private $save_dir;
    private $save_dir_img;
    private $image_counter;

    public function __construct($provider)
    {
        $this->parser = new simple_html_dom();
        $this->provider = $provider;
        $this->noprod = false;
        $this->discount = 0;
        //$this->isProduct();
        $this->save_dir = MODX_BASE_PATH . 'ploader/content/' .$this->provider;
        $this->save_dir_img = $this->save_dir.'/images';
    }

    public function getContent($url, $id, $pref = "def", $proxy = null, $use_cache = false, $cookie_use = false)
    {
        $this->id = $id;
        $this->proxy = $proxy;
        $this->use_cache = $use_cache;
        $this->parser->load($this->getContentItem($url, $id, $pref, $proxy, $use_cache, $cookie_use));//$this->parser->load($this->content);
        $this->image_counter = 0;
    }

    public function getContentItem($url, $id, $pref = "def", $proxy = null, $use_cache = false, $cookie_use = false){
        $this->errors = array();

        $content = false;
        if(!is_dir($this->save_dir )) {
            mkdir($this->save_dir , 0777, true);
        }


        if ($use_cache) {
            $this->content = file_get_contents($this->save_dir.'/'.$pref.'_'.$this->provider.'_'.$id.'.txt', $content);
        }
        else
        {

            $ch = curl_init( $url );

            if ($proxy){
                curl_setopt($ch, CURLOPT_PROXY, $proxy);
            }

            curl_setopt($ch, CURLOPT_VERBOSE, true);
            $user_agent = "Mozilla/5.0 (X11; Linux i686; rv:24.0) Gecko/20140319 Firefox/24.0 Iceweasel/24.4.0";
            curl_setopt($ch, CURLOPT_USERAGENT,$user_agent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
            // curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);   // переходит по редиректам
            curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
            if ($cookie_use)
            {
                curl_setopt($ch, CURLOPT_COOKIEFILE, $this->save_dir . '/cookie.txt');
            }

            $content = curl_exec( $ch );

            curl_close( $ch );

            $this->content = $content;//mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");

            if($this->content)
                file_put_contents($this->save_dir.'/'.$pref.'_'.$this->provider.'_'.$id.'.txt', $content);
        }
        if (!$this->content)
            if($use_cache)
                $this->errors[] = array(
                    'code' => 300,
                    'id' => $id,
                    'url' => $url,
                    'message' => 'cannot load from cache!');
            else{
                if($proxy)
                    $this->errors[] = array(
                        'code' => 301,
                        'id' => $id,
                        'url' => $url,
                        'message' => 'cannot load from proxy'.$proxy);
                else
                    $this->errors[] = array(
                        'code' => 303,
                        'id' => $id,
                        'url' => $url,
                        'message' => 'not load!');
            }


        return $this->content;//$this->parser->load($this->content);
    }

    public function saveImagesToCache()
    {
        foreach ($this->extractDataResult['product_images'] as $url)
            if($url != "")
                $this->saveImage($url);
    }


    private function saveImage($url)
    {
        if(!is_dir($this->save_dir_img )) {
            mkdir($this->save_dir_img , 0777, true);
        }
        $save_dir = $this->getSaveDir($url);
        //проверка на существование файла
        if(!file_exists($save_dir))
            file_put_contents($save_dir, file_get_contents($url));
        $this->image_counter++;
    }

    private function getSaveDir($image)
    {
        return $this->save_dir_img.'/'.$this->provider.'_'.$this->id.'_'.$this->image_counter.".".$this->getImageExtensin($image);
    }

   public function getImagesFromCache()
   {
       $images = array();
       foreach ($this->extractDataResult['product_images'] as $image)
       {
           $ci = $this->getSaveDir($image);
           if(file_exists($ci))
               $images[] = $ci;
           else
               $images[] = $image;
           $this->image_counter++;
       }
       $this->extractDataResult['product_images'] = $images;
       return $images;
   }

    public function getImageExtensin($url)
    {
        $ext = end(explode(".", $url));
        return $ext;
    }

    public  function getAllData(){
        $this->extractDataResult['id_load'] = $this->id_load;

        $this->extractDataResult['product_name'] = $this->getProductName();
        $this->extractDataResult['page_type'] = ($this->isProduct())?'NOPROD':'PRODUCT';
        $this->extractDataResult['product_images'] = $this->getImages();

        $this->extractDataResult['meta_title'] = $this->getMetaTitle();
        $this->extractDataResult['meta_description'] = $this->getMetaDescription();
        $this->extractDataResult['meta_keywords'] = $this->getMetaKeywords();

        $this->extractDataResult['h1'] = $this->getH1();
        $this->extractDataResult['description'] = $this->getProductDescription();

        $this->extractDataResult['price_discount'] = $this->getPriceDiscount();
        $this->extractDataResult['price'] = $this->getPrice();

        $this->extractDataResult['features'] = $this->getProductFeatures();
        $this->extractDataResult['consistens'] = $this->getProductConsistens();
        $this->extractDataResult['reviews'] = $this->getReviews();
        $this->extractDataResult['manufacturer'] = $this->getManufacturer();
        $this->extractDataResult['catdat'] = $this->getCategory();

        return $this->extractDataResult;
    }

    abstract public function isProduct();

    abstract public function getManufacturer();

    abstract public function getCategory();

    abstract public function getProductName();

    abstract public function getProductDescription();

    abstract public function getProductFeatures();

    abstract public function getProductConsistens();

    abstract public function getPrice();

    abstract public function getPriceDiscount();

    abstract public function getImages();

    abstract public function getReviews();

    abstract public function getSitemap($type = "sitemap");

    abstract public function getMetaTitle();

    abstract public function getMetaDescription();

    abstract public function getMetaKeywords();

    abstract public function getH1();
}