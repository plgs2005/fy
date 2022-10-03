<?php

namespace App\Infrastructure\API\ClickMeter;

use Illuminate\Support\Facades\Http;

class ClickMeterApi
{
    protected $key;
    protected $baseUrl = 'http://apiv2.clickmeter.com';

    /**
     * Constructor
     */
    function __construct()
    {
        $this->key = env('CLICKMETER_API_KEY');
    }

    /**
     * Cria codigo de rastreamento
     * 
     * @param string $name          Conversion name
     * @param string $description   Conversion description
     * 
     * @return array
     */
    public function createConversion($name, $description)
    {
        $body = array(
            'name' => $name,
            'description' => $description,
        );
        $response = Http::withHeaders(
            [
                'X-Clickmeter-Authkey' => $this->key,
            ]
        )->post($this->baseUrl . '/conversions', $body);

        return $response->Json();
    }

    /**
     * Recupera um codigo de rastreamento pelo id
     * 
     * @param integer $id Conversion id
     * 
     * @return array
     */
    public function getConversion($id)
    {
        return Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
        ->get($this->baseUrl.'/conversions/'.$id)->Json();
    }

    /**
     * Cria um link de rastreamento
     * 
     * @param string      $title         Link title
     * @param string      $name          Link name - last part of tracking link url 
     *                                   Ex: http://clickmetertracking.com/$name
     * @param integer     $groupId       groupId
     * @param string      $url           Link Url
     * @param object|null $tag           Tag for identification [Optional]
     * @param true|null   $conversion_id Conversion id to attach to the tracking link [Optional]
     * 
     * @return array
     */
    public function createLink($title, $name, $groupId, $url, $tag = null, $conversion_id = null)
    {
        if ($tag) {
            $body = array(
                'type' => 0,
                'title' => $title,
                'groupId' => $groupId,
                'name' => $name,
                'firstConversionId' =>$conversion_id,
                'typeTL' => array(
                    'domainId' => 52960,
                    'redirectType' => '307',
                    'url' => $url
                ),
                'tags' => array([
                    'name' => $tag->name,
                    'id' => $tag->id
                ])
            );
        } else {
            $body = array(
                'type' => 0,
                'title' => $title,
                'groupId' => $groupId,
                'name' => $name,
                'firstConversionId' =>$conversion_id,
                'typeTL' => array(
                    'domainId' => 52960,
                    'redirectType' => '307',
                    'url' => $url
                )   
            );
        }

        $response = Http::withHeaders(
            [
                'X-Clickmeter-Authkey' => $this->key,
            ]
        )->post($this->baseUrl . '/datapoints', $body);

        return $response->Json();
    }

    public function getDatapoint($id)
    {
        return Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl.'/datapoints/'.$id)->Json();
        
    }

    /** 
     * Cria campanha/grupo no clickmeter
     * 
     * @param string $name        Campaign name
     * @param string $description Campaign description
     * @param object $tag         Campaign tag
     * 
     * @return array
     */
    public function createGroup($name, $description, $tag)
    {
        $body = array(
            'name' => $name,
            'notes' => $description,
            'tags' => array([
                'name' => $tag->name,
                'id' => $tag->id
            ])
        );
        $response = Http::withHeaders(
            [
                'X-Clickmeter-Authkey' => $this->key,
            ]
        )->post($this->baseUrl . '/groups', $body);

        return $response->Json();
    }

    /**
     * Cria tag
     *
     * @param string $name Tag name
     * 
     * @return array
     */
    public function createTag($name)
    {
        $body = array(
            'name' => $name,
        );

        $response = Http::withHeaders(
            [
                'X-Clickmeter-Authkey' => $this->key,
            ]
        )->post($this->baseUrl . '/tags', $body);

        return $response->Json();
    }

    public function getTag($id)
    {
        return Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl.'/tags/'.$id)->Json();
    }

    public function getTags()
    {
        $tags = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/tags')->Json();
        dump($tags);
        foreach ($tags['entities'] as $tag) {
            dump($tag['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl . '/tags/' . $tag['id']);
            dump($res->Json());
        }
    }

    public function getCampaigns()
    {
        $groups = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/groups')->Json();
        dump($groups);
        foreach ($groups['entities'] as $group) {
            dump($group['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl . '/groups/' . $group['id']);
            dump($res->Json());
        }
    }

    public function getDatapoints()
    {
        $datapoints = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/datapoints')->Json();
        dump($datapoints);
        foreach ($datapoints['entities'] as $datapoint) {
            dump($datapoint['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl . '/datapoints/' . $datapoint['id']);
            dump($res->Json());
        }
    }

    public function getDatapointHits($id)
    {
        $timeframe = 'timeframe=last180';
        return Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl.'/datapoints/'.$id.'/hits?'.$timeframe)->Json();
    }

    public function getGroupHits($id, $start = null, $end = null)
    {
        if (isset($start) AND isset($end)) {
            $timeframe = "timeframe=custom&fromDay={$start}&toDay={$end}";
        } else {
            $timeframe = 'timeframe=last180';
        }
        return Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl.'/groups/'.$id.'/hits?'.$timeframe)->Json();
    }

    public function clicksByCountry($groupId)
    {
        return Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->get($this->baseUrl."/reports?type=countries&timeframe=last180&group={$groupId}")->Json();
    }

    public function deleteAllConversions()
    {
        $conversions = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/conversions')->Json();
        dump($conversions);
        foreach ($conversions['entities'] as $conversion) {
            dump($conversion['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->delete($this->baseUrl . '/conversions/' . $conversion['id']);
            dump($res->Json());
        }
    }

    public function deleteAllDatapoints()
    {
        $datapoints = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/datapoints')->Json();
        dump($datapoints);
        foreach ($datapoints['entities'] as $datapoint) {
            dump($datapoint['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->delete($this->baseUrl . '/datapoints/' . $datapoint['id']);
            dump($res->Json());
        }
    }

    public function deleteAllCampaigns()
    {
        $groups = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/groups')->Json();
        dump($groups);
        foreach ($groups['entities'] as $group) {
            dump($group['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->delete($this->baseUrl . '/groups/' . $group['id']);
            dump($res->Json());
        }
    }

    public function deleteAllTags()
    {
        $tags = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
            ->get($this->baseUrl . '/tags')->Json();
        dump($tags);
        foreach ($tags['entities'] as $tag) {
            dump($tag['id']);
            $res = Http::withHeaders(['X-Clickmeter-Authkey' => $this->key,])
                ->delete($this->baseUrl . '/tags/' . $tag['id']);
            dump($res->Json());
        }
    }
}
