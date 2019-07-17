<?php


namespace App\Api;


use GuzzleHttp\Client;

class Xkcd implements ApiInterface
{
    protected $url = [
        'https://xkcd.com/',
        'info.0.json'
    ];

    protected $id = 'comic';
    protected $items = [
        'numbers' => 'num',
        'date' => 'year.month.day',
        'name' => 'title',
        'link' => 'link',
        'details' => 'alt',
        'image' => 'img'
    ];

    public function get($filters = [])
    {
        $http = new Client();
        $response = $http->request('GET', $this->fetchUrl($filters))->getBody();
        return $this->fetch(json_decode($response->getContents(), true));
    }

    protected function fetchUrl($filters = [])
    {
        if (array_key_exists('id' , $filters)) {
            $id = $filters['id'];
            return $this->url[0] . $id . '/'. $this->url[1];
        }else{
            return $this->url[0].$this->url[1];
        }
    }

    protected function fetch($data)
    {
        $items = [];
        foreach($this->items as $key => $value){
            if($key == 'date'){
                $items['date'] = $data['year'].'-'.$data['month'].'-'.$data['day'];
            }else{
                $items[$key] = $data[$value];
            }
        }
    return $items;
    }
}