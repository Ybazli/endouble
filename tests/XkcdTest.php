<?php


class XkcdTest extends TestCase
{
    /** @test */
    public function request_for_commic_most_return_response_of_commic()
    {
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'comic',
        ]);
        $content = json_decode($response->response->getContent());
        $this->assertSame($content->meta->request->sourceId , 'comic');
    }

    /** @test */
    public function request_with_id_param_response_most_have_currect_response()
    {
        $id = rand(1,277);
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'comic',
            'id' => $id
        ]);

        $content = json_decode($response->response->getContent());
        $this->assertEquals($content->data->numbers , $id);

    }



    /** @test */
    public function it_most_to_have_data_key()
    {
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'comic',
        ]);
        $content = json_decode($response->response->getContent() , true);

        $this->assertTrue(array_key_exists('data' , $content));
    }

    /** @test */
    public function it_most_to_have_same_attrs()
    {
        $attrs = [
            'numbers',
            'date' ,
            'name' ,
            'link' ,
            'details',
            'image'
        ];
        $response = $this->json('GET' , route('api.home') , [
            'sourceId' => 'comic',
        ]);
        $content = json_decode($response->response->getContent() , true);

        foreach($attrs as $attr){
            $this->assertTrue(array_key_exists($attr , $content['data']));
        }



    }
}
