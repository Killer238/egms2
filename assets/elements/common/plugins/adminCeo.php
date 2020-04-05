<?php
$modx->loadClass('egmsRd', MODX_CORE_PATH.'components/egms/model/egms/');

switch ($modx->event->name) {
    case 'OnDocFormSave':
    //    if ($mode=='new')
    //    {

        if (!function_exists('egGetModificationOptions')) {
            function replaceFields($replaced_field)
            {
                $fields = array(
                    "__city__" => "{'region.city' | placeholder}",
                    "__city_i__" => "{'region.city_i' | placeholder}",
                    "__city_r__" => "{'region.city_r' | placeholder}",
                    "__city_d__" => "{'region.city_d' | placeholder}",
                    "__city_v__" => "{'region.city_v' | placeholder}",
                    "__city_t__" => "{'region.city_t' | placeholder}",
                    "__city_p__" => "{'region.city_p' | placeholder}",
                    "__city_in__" => "{'region.city_in' | placeholder}",
                    "__city_on__" => "{'region.city_on' | placeholder}",
                    "__phone__" => "{'region.phone' | placeholder}",
                    "__host__" => "{'region.host' | placeholder}",
                    "__mainhost__" => "{'region.mainhost' | placeholder}",
                    "__sitename__" => "{'region.sitename' | placeholder}",
                    "__mail__" => "{'region.mail' | placeholder}",
                    "__region_address__" => "{'region.region_address' | placeholder}",
                    "__alias__" => "{'region.alias' | placeholder}",
                );
                foreach ($fields as $key => $field){
                    $replaced_field = str_replace($key, $field, $replaced_field);
                }

                return $replaced_field;
            }
        }

        $id = $resource->get('id');

        $seo_pages = $modx->getCollection("egmsRd", array('resource_id' => $id, "host" => "*"));
        if (!$seo_pages){
            $new_seo_page = array(
                'resource_id' => $id,
                'host' => "*",
                'title' => $resource->get('pagetitle'),
                'meta_description' => $resource->get('pagetitle'),
                'meta_keywords' => $resource->get('pagetitle'),
                'h1' => $resource->get('pagetitle'),
                'published' => 0
            );
            $psn = $modx->newObject('egmsRd');
            $psn->fromArray($new_seo_page);
            $psn->save();
        }else{
            //$seo_page
            foreach ($seo_pages as $seo_page)
            {
                $seo_page->set('title', replaceFields($seo_page->get('title')));//meta_title
                $seo_page->set('meta_description', replaceFields($seo_page->get('meta_description')));//meta_description
                $seo_page->set('meta_keywords', replaceFields($seo_page->get('meta_keywords')));//meta_keywords
                $seo_page->set('h1', replaceFields($seo_page->get('h1')));
                $seo_page->set('description_intro', replaceFields($seo_page->get('description_intro')));//description_intro
                $seo_page->set('description', replaceFields($seo_page->get('description')));//description
                $seo_page->set('description2', replaceFields($seo_page->get('description2')));//description2
                $seo_page->set('description3', replaceFields($seo_page->get('description3')));//description3

                $resource->set('content', replaceFields($resource->get('content')));
                $resource->set('longtitle', replaceFields($resource->get('longtitle')));

                $seo_page->save();
            }
        }

    //    }
        break;

}