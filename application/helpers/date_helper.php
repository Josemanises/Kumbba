<?php

#If your running PHP &gt; 5.3 you need to set this or your app will throw errors
date_default_timezone_set('Europe/Madrid');

function dateToText($date) 
{
    if(empty($date)) {
        return "No date provided";
    }
 
    $periods         = array("segundo", "minuto", "hora", "dia", "semana", "mes", "año", "decada");
    $lengths         = array("60","60","24","7","4.35","12","10");
 
    $now             = time();
    $unix_date         = strtotime($date);
 
       // check validity of date
    if(empty($unix_date)) {
        return "Bad date";
    }
 
    // is it future date or past date
    if($now > $unix_date) {
        $difference     = $now - $unix_date;
        $tense         = "hace";
 
    } else {
        $difference     = $unix_date - $now;
        $tense         = "desde ahora";
    }
 
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
 
    $difference = round($difference);
 
    if($difference != 1) {
	if ( $periods[$j] == 'mes') {
	    $periods[$j].= "es";
	} else {
	    $periods[$j].= "s";
	}
    }
 
    return "{$tense} $difference $periods[$j]";
}