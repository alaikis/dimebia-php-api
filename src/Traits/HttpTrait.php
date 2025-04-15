<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/15 15:48
 */

namespace Alaikis\Dimebia\Traits;

trait HttpTrait
{
    private string $token;
    private string $baseUrl = "https://api.hottol.com/dimebia/user/";
    private string $version="";

    private string  $CONTENT_TYPE="application/json";
    /**
     * make http request
     * @param $uri
     * @param array $param
     * @param string $method
     * @return array
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    private function httpFetch($uri,$param=[], $method = "post"): array
    {
        $ch = curl_init();
        $api = $this->baseUrl . $uri;
        if ($this->version != '') {
            $api = $this->baseUrl . $this->version . "/". $uri;
        }

        //指定URL
        curl_setopt($ch, CURLOPT_URL, $api);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (strtolower($method) == 'post') {
            //声明使用POST方式来进行发送
            curl_setopt($ch, CURLOPT_POST, 1);
            //发送什么数据呢
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
        }
        $headers    = [];
        if (isset($this->token)) {
            $headers[]  = "token: {$this->token}";
        }

        if ($this->CONTENT_TYPE != '') {
            $headers[] = "Content-Type: {$this->CONTENT_TYPE}";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return (array) json_decode($output, true);
    }
}