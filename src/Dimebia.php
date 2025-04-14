<?php
namespace Alaikis\Dimebia;

use Alaikis\Dimebia\endpoint\ChannelEndpoint;
use Alaikis\Dimebia\endpoint\InvoiceEndpoint;
use Alaikis\Dimebia\endpoint\OrderEndpoint;
use Alaikis\Dimebia\endpoint\PaymentEndpoint;
use Alaikis\Dimebia\endpoint\UserEndpoint;
use Alaikis\Dimebia\endpoint\WalletEndpoint;

/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/3/25 9:45
 */
class Dimebia
{

    protected mixed $baseUrl="https://api.hottol.com/dimebia/user/";
    protected mixed $token;
    protected mixed $version="v1";
    private mixed $password;
    private $CONTENT_TYPE;
    private mixed $user;

    public $payments;
    public $wallets;
    public $orders;
    public $invoices;

    public $channel;

    public $users;
    public function __construct($account, $password, $baseUrl=null, $version=null)
    {
        $this->password = $password;
        $this->account = $account;
        $this->token = getUserToken();
        if($baseUrl) $this->setBaseUrl($baseUrl);
        if($version) $this->setVersion($version);
        $this->initEndpoints();
    }

    private function initEndpoints(): void
    {
        $this->payments = new PaymentEndpoint($this);
        $this->wallets = new WalletEndpoint($this);
        $this->orders = new OrderEndpoint($this);
        $this->invoices = new InvoiceEndpoint($this);
        $this->channel = new ChannelEndpoint($this);
        $this->users = new UserEndpoint($this);
    }

    private function getUserToken(){
        return $this->httpFetch("/member/open/auth/login",[
            "account"=>$this->account,
            "password"=>$this->password,
        ])->data->token;
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
     * @param array $param
     * @param string $method
     * @return array
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    private function httpFetch($uri,$param=[], $method = "post"): array
    {
        $ch = curl_init();
        $api = $this->baseUrl . "/" . $this->version . "/". $uri;
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
    /**
     * mark the order as shipped
     * @param $filter
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:44
     */
    public function shipments($filter) {
        return $this->httpFetch("/shipments/list", $filter);
    }

}