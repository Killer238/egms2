<?php
$input['d_weekdays']='1100111';
$date = strtotime('2020-02-25');
$input['d_days'] = 0;
$input['d_time'] = 2;
$input['d_skeep'] = explode(',','28.02.2020,29.02.2020');

if (trim($input['d_days'])=='')
    $input['d_days']=0;
if(is_numeric($input['d_days']))
{
    $t = $input['d_days'];
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
}else{
    $output = $input['d_time'];
}

echo date('d.m.Y', $date);