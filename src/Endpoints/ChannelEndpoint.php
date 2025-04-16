<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/14 11:46
 */

namespace Alaikis\Dimebia\Endpoints;

use Alaikis\Dimebia\Contracts\Bridge;
use Alaikis\Dimebia\Traits\HttpTrait;

class ChannelEndpoint extends EndpointCollection
{

    private const BASE_ENDPOINT = 'channel';

    /**
     * @throws \Exception
     */
    public function channelModify($channel){
        return $this->httpFetch(
            self::BASE_ENDPOINT . "/modify",
            $channel
        );
    }

    /**
     * @throws \Exception
     */
    public function availableGrants($queryParams=[]){
        return $this->httpFetch(
            self::BASE_ENDPOINT . "/grants",
            $queryParams
        );
    }

    /**
     * @throws \Exception
     */
    public function channelList($queryParams=[]){
        return $this->httpFetch(
            self::BASE_ENDPOINT . "/list",
            $queryParams
        );
    }

    /**
     * @throws \Exception
     */
    public function channel($channelId){
        $result=  $this->httpFetch(
            self::BASE_ENDPOINT . "/list",
            [
                "id" => $channelId
            ]
        );
        if ($result["code"] == 0) {
            $result["data"] = $result["data"][0];
        }
        return $result;
    }
}