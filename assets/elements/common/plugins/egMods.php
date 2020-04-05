<?php

switch ($modx->event->name) {
    case 'pdoToolsOnFenomInit':

        $fenom->addModifier('ceodata', function ($input, $key) {
            return $input[$key];
        });

        $fenom->addModifier('delivery', function ($input, $key) {
            //return "key -" . $key['vendor']."-".$key['therm'];
            //return "-".print_r($input);
            return print_r($input[$key['vendor']."-".$key['therm']]);
        });

        $fenom->addModifier('cdesc', function ($input, $key) {
            $rows = json_decode($input, 1);
            foreach($rows as $row)
                if($row['context']==$key)
                    return $row['desc'];
            return "";
        });

        $fenom->addModifier('purl', function ($input, $key) {
            return str_replace("https://".$_SERVER['HTTP_HOST'], $key, $input);
        });

        $fenom->addModifier('themepath', function ($input, $key) {
            return "file:".$input."/".$key;
        });

        $fenom->addModifier('toflat', function ($input, $key) {
            $tmp =array();
                foreach ($input as $item) {
                    $tmp[] = $item[$key];
                }
            return implode(',',$tmp);
        });

/*        $fenom->addModifier('addurl', function ($input) {
            if($input=='product') {
                $result="";
                $result .= $_GET['msoption|size'] ? $_GET['msoption|size'] . '/' : "";
                $result .= $_GET['reviews'] ? $_GET['reviews'] . '/' : "";
                return $result;
            }
        });*/

        $fenom->addModifier('size', function ($input) {
          //  die($input);
           // $key = 'size';
            if($input=='url') {
                $result = $_GET['msoption|size'] ? $_GET['msoption|size'] . '/' : "";
                return $result;
            }
            if ($input == 'size'){
                $result = $_GET['msoption|size']?" - ".$_GET['msoption|size']:"";
            }
            if ($input == 'size_sm'){
                $result = $_GET['msoption|size']?" - ".$_GET['msoption|size']." {'eg_sm'| lexicon}":"";
            }

            return $result;
        });

        $fenom->addModifier('deliverydate', function ($input) {
            //если число, то выводим дату доставки
            $t = $input['d_dayscount'];
            //if(!$t)
            //    $t = 38; //если запись о сродке доставке не найдена, то ставим +25 дней
            $hour = date('H');
            //если текущее время например после обеда
            if ($input['d_time'] > 0)
                if ($t == 0 && $hour >= $input['d_time'])
                    $t = $t + 1;

            $date = strtotime('+'.$t.' day');
            //проверяем на доступность
            if ($input['d_weekdays']!='' && $input['d_weekdays']!='0000000' )
            {
                $input['d_weekdays'] = '0'.$input['d_weekdays'].$input['d_weekdays'];
                $week = str_split($input['d_weekdays'] );
                for ($i=1; $i<13; $i++){
                    $nw = date('w', $date);
                    $rweekn = ($nw==0)?7:$nw;
                    if($week[$rweekn]==0)
                        $date = $date + 86400;
                    else
                    {
                        //если дата в массиве пропуска дат
                        $d = date('d.m.Y', $date);
                        if(in_array($d, $input['d_skeep']))
                            $date = $date + 86400;
                        else
                            break;
                    }
                }
            }
            $output = date("d.m.Y", $date);
            if(date("d.m.Y")==$output)
                $output.=" (сегодня)";
            if((date("d.m.Y")+1)==$output)
                $output.=" (завтра)";

            return $output;
        });

        $fenom->addModifier('daterange', function ($input) {
            //start week
            if($input=='sw'){
                return date("d.m.Y", strtotime('monday this week',time()));
            }
            //end week
            if($input=='ew'){
                return date("d.m.Y", strtotime('monday this week',time()+(7*86400)));
            }
            //start month
            if($input=='sm'){
                return date("01.m.Y", time());
            }
            //end month
            if($input=='em'){
                return date("t.m.Y", time()+(7*86400));
            }
        });

        //()
/*
        $fenom->addModifier('price_format', function ($input) {
            $price = str_replace(',','.',$input);
            $options = json_decode([2, ".", " "]);//$options = json_decode($modx->getOption('ms2_price_format'));
            if (is_array($options)) {
                return number_format($price, $options[0], $options[1], $options[2]);
            } else {
                return $price;
            }
        });*/
        break;
}