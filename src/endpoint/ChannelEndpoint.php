<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/14 11:46
 */

namespace Alaikis\Dimebia\endpoint;

class ChannelEndpoint
{
    private $BASE_ENDPOINT = 'channel';

    public function channelModify($channel){
        return $this->httpFetch(
            $this->BASE_ENDPOINT . "/modify",
            $channel
        );
    }

    public function availableGrants($queryParams=[]){
        return $this->httpFetch(
            $this->BASE_ENDPOINT . "/grants",
            $queryParams
        );
    }

    public function channelList($queryParams=[]){
        return $this->httpFetch(
            $this->BASE_ENDPOINT . "/list",
            $queryParams
        );
    }

    public function channel($channelId){
        $result=  $this->httpFetch(
            $this->BASE_ENDPOINT . "/list",
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