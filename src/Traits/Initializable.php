<?php
namespace Alaikis\Dimebia\Traits;
use Alaikis\Dimebia\Endpoints\ChannelEndpoint;
use Alaikis\Dimebia\Endpoints\InvoiceEndpoint;
use Alaikis\Dimebia\Endpoints\OrderEndpoint;
use Alaikis\Dimebia\Endpoints\PaymentEndpoint;
use Alaikis\Dimebia\Endpoints\UserEndpoint;
use Alaikis\Dimebia\Endpoints\WalletEndpoint;
use Alaikis\Dimebia\http\Request;

/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/15 14:39
 */
trait Initializable
{
    public PaymentEndpoint $payments;
    public WalletEndpoint $wallets;
    public OrderEndpoint $orders;
    public InvoiceEndpoint $invoices;
    public ChannelEndpoint $channel;
    public UserEndpoint $users;

    /**
     * @throws \Exception
     */
    public function initializeTraits()
    {
        if(!isset($this->account)){
            throw new \Exception("the account is required");
        };
        if(!isset($this->password)){
            throw new \Exception("the password is required");
        };
        $request = new Request();
        $request->getUserToken($this->account,$this->password);
        if($this->baseUrl) $request->setBaseUrl($this->baseUrl);
        if($this->version) $request->setVersion($this->version);
        $this->payments = new PaymentEndpoint($request);
        $this->wallets = new WalletEndpoint($request);
        $this->orders = new OrderEndpoint($request);
        $this->invoices = new InvoiceEndpoint($request);
        $this->channel = new ChannelEndpoint($request);
        $this->users = new UserEndpoint($request);
    }
}