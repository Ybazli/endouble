<?php
use Carbon\Carbon;

class ApiTest extends TestCase{

    /** @test */
    public function request_with_empty_params_most_return_error()
    {
        $response = $this->json('GET' , route('api.home'));

        $response->assertResponseStatus(400);
    }

    /** @test */
    public function invalid_sourceid_most_return_error()
    {
        $sourceId = 'hello';
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => $sourceId
        ]);

        $response->assertResponseStatus(400);
    }

    /** @test */
    public function sourceid_commics_most_change_to_space()
    {
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'comics',
            'limit' => 1
        ]);

        $response->assertResponseStatus(200);

        $content = json_decode($response->response->getContent() , true);

        $this->assertSame($content['meta']['request']['sourceId'] , 'space');

        $this->assertSame(count($content['data']) , 1);

    }


    /** @test */
    public function response_most_to_have_request_params()
    {
        $params = [
            'sourceId' => 'space',
            'limit' => 1,
            'year' => 2018
        ];

        $response = $this->json('GET' , route('api.home') , $params);

        $response->assertResponseStatus(200);

        $content = json_decode($response->response->getContent() , true);

        foreach($params as $key => $value){

            $this->assertTrue(array_key_exists($key , $content['meta']['request']));

            $this->assertSame($content['meta']['request'][$key] , $value);
        }
    }


    /** @test */
    public function it_most_have_timestamp_with_currect_value()
    {
        $now = explode(Carbon::now()->format('Y-m-d\TH:i:s.v\Z') , '.');

        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'space',
            'limit' =>1
        ]);

        $content = json_decode($response->response->getContent() , true);
        $this->assertTrue(array_key_exists('timestamp' , $content['meta']));
        $this->assertSame(explode($content['meta']['timestamp'] , '.')[0] , $now[0]);

    }






}
