<?php

namespace Alaikis\Dimebia;

use Alaikis\Dimebia\http\Request;
use Alaikis\Dimebia\Traits\Initializable;

/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/3/25 9:45
 */
class Dimebia extends Request
{

    use Initializable;
    /**
     * @var mixed
     */
    public string  $account;
    public function __construct($account, $password, $baseUrl=null, $version=null)
    {
        $this->password = $password;
        $this->account = $account;
        $this->getUserToken();
        if($baseUrl) $this->setBaseUrl($baseUrl);
        if($version) $this->setVersion($version);
        $this->initializeTraits();
    }

}