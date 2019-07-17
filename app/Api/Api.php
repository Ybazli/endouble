<?php

namespace App\Api;

use App\Exceptions\ApiException;

class Api
{
    public function getData($params)
    {
        if(!array_key_exists('sourceId' , $params))
            throw new ApiException();

        switch ($params['sourceId']) {
            case 'space':
                $api = new SpaceX();
                return $api->get($params);
                break;

            case 'comics':
                $api = new SpaceX();
                $params['sourceId'] = 'space';
                return $api->get($params);
                break;

            case 'comic':
                $api = new Xkcd();
                return $api->get($params);
                break;
            default:
                throw new ApiException();
                break;
        }
    }
}
