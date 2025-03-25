<?php

/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/3/25 9:45
 */
class Dimebia
{

    protected mixed $baseUrl="https://api.dimebia.alaikis.com";
    protected mixed $token;
    protected mixed $version="v1";

    public function __construct($token, $baseUrl=null, $version=null)
    {
        $this->token = $token;
        if($baseUrl) $this->setBaseUrl($baseUrl);
        if($version) $this->setVersion($version);
    }


    /**
     * set the base request url
     * @param $baseUrl
     * @return void
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    public function setBaseUrl($baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }
    public function setVersion(mixed $version)
    {
        $this->version = $version;
    }


    /**
     * make http request
     * @param $uri
     * @param $data
     * @param $method
     * @return string
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    private function httpFetch($uri,$data, $method = "post") {
        return "";
    }

    /**
     * make a order
     * @param $requestParams
     * @return string
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    public function createPayment($requestParams) {
        return $this->httpFetch("/payment/create", $requestParams);
    }

    public function balances() {}

    public function shipments()
    {
    }

    public function orderRefunds(){
    }



}