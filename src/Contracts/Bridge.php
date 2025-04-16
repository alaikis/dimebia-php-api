<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/16 8:04
 */

namespace Alaikis\Dimebia\Contracts;

use Alaikis\Dimebia\http\Request;
use Attribute;

class Bridge
{
    public string $token;
    /**
     * @var mixed
     */
    private Request $request;
    /**
     * @var mixed
     */

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @throws \Exception
     */
    public function httpFetch($uri, $param=[], $method = "post"): array
    {
        if (!method_exists($this->request,"httpFetch")) {
            throw new \Exception("Http client not found");
        }
        return $this->request->httpFetch($uri,$param, $method);
    }
}