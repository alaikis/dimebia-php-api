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
class Dimebia
{

    use Initializable;

    /**
     * @var mixed
     */
    public string  $account;
    private string $password;
    /**
     * @var mixed|null
     */
    private string $baseUrl;
    /**
     * @var mixed|null
     */
    private string $version;

    public function __construct($account, $password, $baseUrl=null, $version=null)
    {
        $this->account = $account;
        $this->password = $password;
        $this->baseUrl = $baseUrl;
        $this->version = $version;
        $this->initializeTraits();
    }

}