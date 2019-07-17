<?php


class SpaceTest extends TestCase
{
    /** @test */
    public function request_for_space_api_most_return_response_of_sapce_x()
    {
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'space',
            'limit' => 1,
            'year' => 2019
        ]);
        $content = json_decode($response->response->getContent());
        $this->assertSame($content->meta->request->sourceId , 'space');
    }

    /** @test */
    public function request_with_limit_param_response_most_have_same_count()
    {
        $limitNumber = rand(1,5);
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'space',
            'limit' => $limitNumber,
            'year' => 2019
        ]);

        $content = json_decode($response->response->getContent());
        $this->assertEquals(count($content->data) , $limitNumber);

    }

    /** @test */
    public function request_with_year_param_response_most_same_year()
    {
        $year = 2018;
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'space',
            'limit' => 3,
            'year' => $year
        ]);

        $content = json_decode($response->response->getContent() , true);

        foreach($content['data'] as $item){
            $this->assertEquals(explode('-' , $item['date'])[0] , $year);
        }

    }

    /** @test */
    public function it_most_to_have_data_key()
    {
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'space',
            'limit' => 1,
            'year' => 2012
        ]);
        $content = json_decode($response->response->getContent() , true);

        $this->assertTrue(array_key_exists('data' , $content));
    }

    /** @test */
    public function success_response_most_to_have_attrs()
    {
        $attrs = [
            'numbers',
            'date' ,
            'name' ,
            'link' ,
            'details'
        ];
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'space',
            'limit' => 3,
            'year' => 2012
        ]);
        $content = json_decode($response->response->getContent() , true);

        foreach($content['data'] as $item){
            foreach($attrs as $attr){
                $this->assertTrue(array_key_exists($attr , $item));
            }
        }

    }

}
