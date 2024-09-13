<?php

use GuzzleHttp\Client;


class DialogInputView2 extends TPage
{
    public function __construct()
    {
        parent::__construct();
        $parametros = array();
        $client = new Client();
        $res     = $client->request('GET',
            'https://webhook.site/718330f2-e430-480f-9a7b-ecc57bc71ca7?tipo=1',
            ['verify'=>false, 'headers'=>['usuario'=>'tadeu'],
                'form_params' => [
                'foo' => 'bar',
                'baz' => ['hi', 'there!']]
                ]
        );

        if($res->getStatusCode() == 200){
            echo $res->getBody();
        }
    }
    

}