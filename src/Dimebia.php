<?php

namespace Alaikis\Dimebia;

use Alaikis\Dimebia\Endpoints\ChannelEndpoint;
use Alaikis\Dimebia\Endpoints\InvoiceEndpoint;
use Alaikis\Dimebia\Endpoints\OrderEndpoint;
use Alaikis\Dimebia\Endpoints\PaymentEndpoint;
use Alaikis\Dimebia\Endpoints\UserEndpoint;
use Alaikis\Dimebia\Endpoints\WalletEndpoint;
use Alaikis\Dimebia\Traits\HttpTrait;
use Alaikis\Dimebia\Traits\Initializable;

/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/3/25 9:45
 */
class Dimebia
{

    use Initializable,HttpTrait;
    private string $password;
    public PaymentEndpoint $payments;
    public WalletEndpoint $wallets;
    public OrderEndpoint $orders;
    public InvoiceEndpoint $invoices;
    public ChannelEndpoint $channel;
    public UserEndpoint $users;
    /**
     * @var mixed
     */
    private string  $account;

    public function __construct($account, $password, $baseUrl=null, $version=null)
    {
        $this->password = $password;
        $this->account = $account;
        $this->token = $this->getUserToken();
        if($baseUrl) $this->setBaseUrl($baseUrl);
        if($version) $this->setVersion($version);
        $this->initializeTraits();
    }

    private function getUserToken(){
        return $this->httpFetch("/member/open/auth/login",[
            "account"=>$this->account,
            "password"=>$this->password,
        ])["data"]["token"];
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

}