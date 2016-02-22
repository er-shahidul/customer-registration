<?php

namespace AppBundle\Model;

class Customer
{
    private $endpoint;

    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function create($data)
    {
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $this->endpoint . '/customers/');
        curl_setopt($ch,CURLOPT_POST, count($data['customer']));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data['customer']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-ApiKey: 3e66f6b0b56047b28f81e26fac118e0'
        ]);

        //execute post
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);

        //close connection
        curl_close($ch);

        if ($info['http_code'] == 201) {
            return json_decode($result);
        }

        throw new \Exception($result);
    }
}
