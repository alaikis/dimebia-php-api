<?php
namespace Alaikis\Dimebia\Traits;
use Alaikis\Dimebia\Endpoints\ChannelEndpoint;
use Alaikis\Dimebia\Endpoints\InvoiceEndpoint;
use Alaikis\Dimebia\Endpoints\OrderEndpoint;
use Alaikis\Dimebia\Endpoints\PaymentEndpoint;
use Alaikis\Dimebia\Endpoints\UserEndpoint;
use Alaikis\Dimebia\Endpoints\WalletEndpoint;

/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/15 14:39
 */
trait Initializable
{
    public string $password;
    public PaymentEndpoint $payments;
    public WalletEndpoint $wallets;
    public OrderEndpoint $orders;
    public InvoiceEndpoint $invoices;
    public ChannelEndpoint $channel;
    public UserEndpoint $users;
    public function initializeTraits()
    {
        $this->payments = new PaymentEndpoint($this);
        $this->wallets = new WalletEndpoint($this);
        $this->orders = new OrderEndpoint($this);
        $this->invoices = new InvoiceEndpoint($this);
        $this->channel = new ChannelEndpoint($this);
        $this->users = new UserEndpoint($this);
    }
}