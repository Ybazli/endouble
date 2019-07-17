<?php

namespace App\Http\Controllers;

use App\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApiController extends Controller
{
    protected $response = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->response['meta']['request'] = $request->all();
        $this->response['meta']['timestamp'] = Carbon::now()->format('Y-m-d\TH:i:s.v\Z');

        if($request->input('sourceId') == 'comics')
            $this->response['meta']['request']['sourceId'] = 'space';
    }

    public function home(Request $request)
    {
        $api = new Api();
        $response = $api->getData($request->all());
        $this->response['data'] = $response;
        return $this->response;
    }
}
