<?php

namespace App\Api;

use GuzzleHttp\Client;

class SpaceX implements ApiInterface
{

    protected $url = 'https://api.spacexdata.com/v2/launches';
    protected $id = 'space';
    protected $items = [
        'numbers' => 'flight_number',
        'date' => 'launch_date_utc',
        'name' => 'mission_name',
        'link' => 'links.wikipedia',
        'details' => 'details'
    ];

    public function get($filters = [])
    {
        $http = new Client();
        $params = [];

        if (count($filters) && array_key_exists('limit', $filters))
            $params['limit'] = $filters['limit'];

        if (count($filters) && array_key_exists('year', $filters))
            $params['launch_year'] = $filters['year'];

        $response = $http->request('GET', $this->url, [
            'query' => $params
        ])->getBody();

        return $this->fetch(json_decode($response->getContents() , true));
    }


    protected function fetch($data)
    {
        $items = [];
        foreach ($data as $counter => $item) {
            foreach ($this->items as $key => $index) {

                if (strpos($index , '.')){
                    $array['link'] = $item['links']['wikipedia'];
                }else{
                    $array[$key] = $item[$index];
                }

            }
            $items[$counter] = $array ?? $data;
        }
        return $items;
    }


}
