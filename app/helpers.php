<?php
use Carbon\Carbon;

function selectedCategory($selectedCategory, $catId)
{
    try {
        if ($selectedCategory->contains($catId)) {
            return 'selected';
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function socialMedias($social_media)
{
    if ($social_media->social_media !== 'facebook') {
        $array = array('facebook_page', 'instagram_business');
        $array2 = array('Facebook Page', 'Instagram');
        $return = str_replace($array, $array2, $social_media->social_media);
        return $return;
    }  
}

function socialMedias2($social_medias)
{
    $array = array('facebook_page', 'instagram_business');
    $array2 = array('Facebook Page', 'Instagram');
    foreach ($social_medias as $key => $value) {
        if ($value !== 'facebook') {
            $ar[] = str_replace($array, $array2, $value);
        }
    }
    return $ar;
}

function visitorCookie()
{
    $cookie_name = 'visitorCookie';
    $timeToExpire = 86400 * 30; // 86400 = 1 day
    
    if (isset($_GET['ref'])) {
        $referrer = $_GET['ref'];
    } else {
        $referrer = false;
    }

    if (!isset($_COOKIE[$cookie_name])) {
        $visitor = \App\Visitor::Create();

        if ($referrer === false) {
            $cookie_value = json_encode(array('id'=>$visitor->id));
        } else {
            $cookie_value = json_encode(array('id'=>$visitor->id, 'referrer'=>$referrer));
        }
        
        return setcookie($cookie_name, $cookie_value, time() + ($timeToExpire), "/");
    } else {
        $cookie = json_decode($_COOKIE[$cookie_name]);

        if (isset($cookie->referrer) AND $referrer !== false) {
            $cookie_value = json_encode(array('id'=>$cookie->id, 'referrer'=>$referrer));
            setcookie($cookie_name, $cookie_value, time() + ($timeToExpire), "/");
        } else {
            
        }
    }
      return $_COOKIE[$cookie_name];
}

function getVisitorCookie()
{
    $cookie_name = 'visitorCookie';
    if (isset($_COOKIE[$cookie_name])) {
        return $_COOKIE[$cookie_name];
    } else {
        return false;
    }
}

function thousandsFormat($num, $stripeCurrency = false)
{
    if ($stripeCurrency and $num != 0) {
        $num = substr($num, 0, -2);
    }
    if ($num>=1000) {
  
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
  
          return $x_display;
  
    }
  
    return $num;
}

function engagementPercent($impressions, $engagement)
{
    if ($engagement < 1 OR $impressions < 1) {
        return 0;
    } else {
        return round(($engagement*100)/$impressions, 2).'%';
    }
}

function stripeNumFormat($num)
{   
    $int = substr($num, 0, -2);
    $decimal = substr($num, -2);

    $num = $int.'.'.$decimal;
    $num = number_format($num, 2);
    $num = '$ '.$num;
    return $num;
}

function paymentTimelineDate($dateString)
{
    $date = \Illuminate\Support\Carbon::createFromFormat('M-j-Y', $dateString);
    $timelineDateString = '<div class="marker-timeline-payment">'.$date->format('M').'<br><span class="text-bold-700">'.$date->format('j').'</span><br>'.$date->format('Y').'</div>';
    return $timelineDateString;
}

function paymentTimelineDateInfluencer($dateString)
{
    $date = \Illuminate\Support\Carbon::createFromFormat('M-j-Y', $dateString);
    $timelineDateString = '<div class="marker-timeline-payment"><p>'.$date->format('d/m/Y').'</p></div>';
    return $timelineDateString;
}

// date for carbon parse() and php date format
function dateFormat($date, $format)
{
    $datetime = Carbon::parse($date)->format($format);
    return $datetime;
}
