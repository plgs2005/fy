<?php

namespace App\Influencer\Campaign;

use Illuminate\Database\Eloquent\Model;

use App\Casts\Date;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Infrastructure\API\ClickMeter\ClickMeterApi;

use App\Infrastructure\API\Countries\Countries;

use Illuminate\Support\Str;

class Campaign extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'name',
        'type',
        'goal',
        'audience_id',
        'social_platform_instagram',
        'social_platform_facebook',
        'format',
        'format_type_feed',
        'format_type_story',
        'style',
        'goal_description',
        'goal_images',
        'physical_product',
        'digital_product',
        'service',
        'product_description',
        'product_images',
        'url',
        'instructions',
        'instruction_images',
        'budget',
        'datetime',
        'different_influencers',
        'manual_select_influencers',
        'checkout_session',
        'paid',
        'clickmeter_group_id',
        'endedNotification'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'campaign_date' => Date::class,
    ];

    protected $dates = [
        'campaign_date',
    ];

    //Brand the campaign belongs to
    public function brand()
    {
        return $this->belongsTo('App\Influencer\User\User');
    }

    //Influencers selected for the campaign
    public function influencers()
    {
        return $this->belongsToMany('App\Influencer\User\User', 'users_campaigns')->withPivot('brand_accept', 'influencer_accept', 'influencer_decline_motive', 'rating', 'value', 'admin_accept', 'score', 'manual_add', 'impressions', 'paid', 'tracking_link_url', 'tracking_link_id', 'startingNotification', 'startedNotification')->withTimestamps();;
    }

    public function audience()
    {
        return $this->belongsTo('App\Influencer\Audience\Audience');
    }

    public function posts()
    {
        return $this->hasMany('App\Influencer\Post\Post');
    }

    //returns a array with influencer ids that are part of the campaign
    public function influencerIds()
    {
        foreach ($this->influencers as $influencer) {
            $ar['id'.$influencer->id] = $influencer->id;
        }
        return $ar;
    }

    public function adminAcceptInfluencer()
    {
        foreach ($this->influencers as $influencer) {
            if ($influencer->pivot->admin_accept==null) {
                return true;
            }
        }
    }

    public function starts2()
    {
        return Carbon::parse($this->datetime)->format('Ymd');
    }

    public function starts($alt = false)
    {
        if ($alt) {
            $date = Carbon::parse($this->datetime)->format('M d');
            $time = Carbon::parse($this->datetime)->format('g A');
            return "$date - {$time}";
        } else {
            $date = Carbon::parse($this->datetime)->format('m/d/Y');
            $time = Carbon::parse($this->datetime)->format('g A');
            return "$date at {$time}";
        }
        
    }

    public function ends($alt = false)
    {
        if ($alt) {
            $days = ($this->format_type_feed) ? 7 : 1;
            $date = Carbon::parse($this->datetime)->addDays($days)->format('M d');
            $time = Carbon::parse($this->datetime)->format('g a');
            return "$date - {$time}";
        } else {
            $days = ($this->format_type_feed) ? 7 : 1;
            $date = Carbon::parse($this->datetime)->addDays($days)->format('m/d/Y');
            $time = Carbon::parse($this->datetime)->format('g A');
            return "$date at {$time}";
        }
    }

    public function dateMetadata()
    {
        $date1 = Carbon::parse($this->datetime)->format('M d, Y');
        $time1 = Carbon::parse($this->datetime)->format('ga');

        $days = ($this->format_type_feed) ? 7 : 1;
        $date2 = Carbon::parse($this->datetime)->addDays($days)->format('M d, Y');
        $time2 = Carbon::parse($this->datetime)->format('ga');
        return "$date1 at $time1 - $date2 at $time2";
    }

    public function created_at()
    {
        return Carbon::parse($this->created_at)->format(config('app.date_format'));
    }

    public function impression_count()
    {
        foreach ($this->posts as $post) {
            foreach ($post->metrics as $metric) {
                if ($metric->tipo == 'impressions') {
                    $this->impressions = $this->impressions+$metric->valor;
                }
            }
        }
        if ($this->impressions == null) {
            $this->impressions = 0;
        }
        return $this->impressions;
    }

    public function createClickmeterGroup()
    {
        $brand = $this->brand;
        $tag = $brand->clickmeterTag();
        $clickMeterApi = new ClickMeterApi;
        $res = $clickMeterApi->createGroup($this->name.'-id'.$this->id, $brand->brand_name.' campaign '.$this->name, $tag);
        $this->clickmeter_group_id = $res['id'];
        $this->save();
        return $res['id'];
    }
    public function createClickmeterConversion()
    {
        $brand = $this->brand;
        $tag = $brand->clickmeterTag();
        $clickMeterApi = new ClickMeterApi;
        $res = $clickMeterApi->createConversion($this->name.'-id'.$this->id, 'Conversion code for'.$this->name.'-id'.$this->id);
        $this->clickmeter_conversion_id = $res['id'];
        $this->save();
        return $res['id'];
    }

    public function createUserLink($user, $conversion = false)
    {
        $influencer = $this->influencers->where('id', $user->id)->first();
        if ($influencer->pivot->tracking_link_url OR $influencer->pivot->tracking_link_id) {
            return array('tracking_link_id'=>$influencer->pivot->tracking_link_id, 'tracking_link_url'=>$influencer->pivot->tracking_link_url);
        }
        $tag = $influencer->clickmeterTag();
        $clickMeterApi = new ClickMeterApi;
        $title = $this->name.'-id'.$this->id.'-'.$influencer->name.'-id'.$influencer->id;
        $name = 'InfluencifyTest'.$this->id.$influencer->id;

        $res = $clickMeterApi->createLink($title, $name, $this->clickmeter_group_id, $this->url, $tag, $this->clickmeter_conversion_id);

        $res = $clickMeterApi->getDatapoint($res['id']);
        $this->influencers()->updateExistingPivot($influencer->id, ['tracking_link_id' => $res['id'], 'tracking_link_url' => $res['trackingCode']]);

        return $res;
    }


    public function clicks()
    {
        if ($this->clickmeter_group_id) {
            $retorno['conversions']=0;
            $clickMeterApi = new ClickMeterApi;
            $res = $clickMeterApi->getGroupHits($this->clickmeter_group_id);
            foreach ($res['hits'] as $value) {
                if (isset($value['conversion1'])) {
                    $retorno['conversions']++;
                }
            }
            $retorno['clicks'] = count($res['hits']);
            return $retorno;
        } else {
            return false;
        }
    }

    //Provavelmente não utilizada
    public function clicksByCountry()
    {
        $clickMeterApi = new ClickMeterApi;
        $res = $clickMeterApi->clicksByCountry($this->clickmeter_group_id);
        foreach ($res['data'] as $value) {
            $temp = [$value['id']=>$value['totalClicks']];
        }
        $this->clicks = $temp;
    }

    /**
     * Creates clicksData atribute on campaign instance with clicks data for this campaigns on clickmeeter
     * Used on brand campaign analytics
     * 
     * @param CarbonInstance $start
     * @param CarbonInstance $end
     * 
     * @return null
     */
    public function clicksData($start, $end)
    {
        $start = $start->format('Ymd');
        $end = $end->format('Ymd');

        $clickMeterApi = new ClickMeterApi;
        $countriesApi = new Countries;

        $data = ['countries'=>array(), 'cities'=>array(), 'days'=>array()];

        $period = new CarbonPeriod($start, $end);
        foreach ($period as $date) {
            $date = $date->format('M, d');
            $data['days'][$date]=0;
        }


        $end = Carbon::parse($end)->addDay()->format('Ymd');
        
        $res = $clickMeterApi->getGroupHits($this->clickmeter_group_id, $start, $end);

        if (isset($res['hits'])) {
            foreach ($res['hits'] as $value) {

                if (array_key_exists($value['location']['country'], $data['countries'])) {
                    $data['countries'][$value['location']['country']]['clicks']++;
                } else {
                    $data['countries'][$value['location']['country']]['clicks']=1;
                    $data['countries'][$value['location']['country']]['countryName']=$countriesApi->getCountryByCode(Str::upper($value['location']['country']));
                    $data['countries'][$value['location']['country']]['countryFlag']=$countriesApi->getCountryFlag($data['countries'][$value['location']['country']]['countryName'])['data']['flag'];
                }

                if (array_key_exists($value['location']['city'], $data['cities'])) {
                    $data['cities'][$value['location']['city']]['clicks']++;
                } else {
                    $data['cities'][$value['location']['city']]['clicks']=1;
                    $data['cities'][$value['location']['city']]['country']=$value['location']['country'];
                    $data['cities'][$value['location']['city']]['countryName']=$countriesApi->getCountryByCode(Str::upper($value['location']['country']));
                    $data['cities'][$value['location']['city']]['countryFlag']=$countriesApi->getCountryFlag($data['countries'][$value['location']['country']]['countryName'])['data']['flag'];
                }
                $date = substr($value['accessTime'], 0, 8);
                $date = Carbon::parse($date)->format('M, d');

                if (array_key_exists($date, $data['days'])) {
                    $data['days'][$date]++;
                } else {
                    $data['days'][$date]=1;
                } 
            }
            $this->clicksData = $data;
        } else {
            $this->clicksData = null;
        }
    }

    public function influencerClicksData($user)
    {
        $user = $this->influencers->where('id', $user->id)->first();
        $clickMeterApi = new ClickMeterApi;
        $res = $clickMeterApi->getDatapointHits($user->pivot->tracking_link_id);
        if ($res == null) {
            $return['clicks'] = 0;
            return $return;
        }

        $oneDate = true;
        $i=0;

        //verifica se todos os hits sao do mesmo dia
        foreach ($res['hits'] as $value) {
            $date = substr($value['accessTime'], 0, 8);
            $hour = substr($value['accessTime'], 8, 2);

            if ($i==0) {
                $mostRecentDate = $date;
            } else {
                if ($oneDate == true) {
                    if ($previousDate == $date) {
                        $oneDate = true;
                    } else {
                        $oneDate = false;
                    }
                }
            }
            $i++;
            $previousDate = $date;
        }

        $data['clicks'] = $i;


        $data['chartData'] = array();
        
        if ($oneDate) {
            foreach ($res['hits'] as $value) {
                $hour = substr($value['accessTime'], 8, 2);
                if (array_key_exists($hour, $data['chartData'])) {
                    $data['chartData'][$hour]++;
                } else {
                    $data['chartData'][$hour]=1;
                }
            }
        } else {
            $mostRecentDate = Carbon::parse($mostRecentDate);
            $startDate = Carbon::parse($date);

            $period = new CarbonPeriod($startDate, $mostRecentDate);
            foreach ($period as $date) {
                $date = $date->format('M, d');
                $data['chartData'][$date]=0;
            }

            foreach ($res['hits'] as $value) {
                $date = substr($value['accessTime'], 0, 8);
                $date = Carbon::parse($date)->format('M, d');
                if (array_key_exists($date, $data['chartData'])) {
                    $data['chartData'][$date]++;
                } else {
                    $data['chartData'][$date]=1;
                }
            }
        }

        return $data;
        
    }

    public function status()
    {
        $now = Carbon::now();
        $start = Carbon::parse($this->datetime);
        $days = ($this->format_type_feed) ? 7 : 1;
        $end = Carbon::parse($this->datetime);
        $end->addDays($days);


        if ($now->isBefore($start)) {
            return 'scheduled';
        } elseif ($now->isAfter($start) AND $now->isBefore($end)) {
            return 'active';
        } elseif ($now->isAfter($end)) {
            return 'ended';
        }

    }

    public function fundsReleased()
    {
        $influencers = $this->influencers;
        foreach ($influencers as $influencer) {
            if (!$influencer->pivot->paid) {
                return false;
            }
        }
        return true;
    }

    public function selectedInfluencersCount()
    {
        $count = $this->influencers()->where('brand_accept', 1)->get()->count();
        return $count;
    }

}
