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
    public function initializeTraits()
    {
        $this->payments = new PaymentEndpoint();
        $this->wallets = new WalletEndpoint();
        $this->orders = new OrderEndpoint();
        $this->invoices = new InvoiceEndpoint();
        $this->channel = new ChannelEndpoint();
        $this->users = new UserEndpoint();
    }
}