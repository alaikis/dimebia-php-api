<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/16 8:04
 */

namespace Alaikis\Dimebia\Contracts;

use Alaikis\Dimebia\Traits\HttpTrait;

class Bridge
{
    public string $token;
    /**
     * @var mixed
     */
    private $container;

    public function __construct($container) {
        $this->token = $container['token'] ?? null;
        $this->container = $container;
    }

    /**
     * @throws \Exception
     */
    public function httpFetch($uri, $param=[], $method = "post") {
        $client = $this->$container['httpFetch'] ?? null;
        if (!$client) {
            throw new \Exception("Http client not found");
        }
        return $client($uri,$param, $method);
    }
}