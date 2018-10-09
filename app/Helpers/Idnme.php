<?php

namespace App\Helpers;

use DateTime;

class Idnme
{
    public static function print_date($date, $time = false) {
        $month = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        
        date_default_timezone_set('Asia/Jakarta');
        $date = new DateTime($date);

        if($time) {
            $date = $date->format('d')." ".$month[$date->format('m')]." ".$date->format('Y')." pukul ".$date->format('H:i');
        } else {
            $date = $date->format('d')." ".$month[$date->format('m')]." ".$date->format('Y');
        }

        return $date;
    }
    
    public static function print_rupiah($amount, $decimal = null, $marker = null){	
        $mark = "";
        if($marker) {
            $mark = "Rp ";
        }
        if($decimal) {
            $result = $mark. number_format($amount,2,',','.');
        } else {
            $result = $mark. number_format($amount,0,',','.');
        }
        
        return $result;
    }
}
