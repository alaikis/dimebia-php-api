<?php
namespace Alaikis\Dimebia;
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/3/25 9:45
 */
class Dimebia
{

    protected mixed $baseUrl="https://api.hottol.com/dimebia";
    protected mixed $token;
    protected mixed $version="v1";

    public function __construct($token, $baseUrl=null, $version=null)
    {
        $this->token = $token;
        if($baseUrl) $this->setBaseUrl($baseUrl);
        if($version) $this->setVersion($version);
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


    /**
     * make http request
     * @param $uri
     * @param $data
     * @param $method
     * @return string
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    private function httpFetch($uri,$data, $method = "post") {
        return "";
    }

    /**
     * make a order
     * @param $requestParams
     * @return string
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    public function paymentApply($requestParams) {
        return $this->httpFetch("/payments/apply", $requestParams);
    }

    /**
     * get the payment info by bill id
     * @param $billId
     * @return string
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function getPaymentById($billId) {
        return $this->httpFetch("/payments/get", ["transactionId"=>$billId]);
    }

    /**
     * get the payment list
     * @param $filter
     * @return string
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function getPayments($filter) {
        return $this->httpFetch("/payments/list", $filter);
    }

    /**
     * cancel the payment
     * @param $billId
     * @return string
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function paymentCancel($billId) {
        return $this->httpFetch("/payments/cancel", ["transactionId"=>$billId]);
    }

    /**
     * refund the payment
     * @param $billId
     * @param $refundAmount
     * @return string
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function paymentRefund($billId,$refundAmount) {
        return $this->httpFetch("/payments/refund", [
            "transactionId"=>$billId,
            "refundAmount"=>$refundAmount,
        ]);
    }

    /**
     * get the balances will group by currency
     * @param $filter
     * @return string
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function balances($filter) {
        return $this->httpFetch("/balances/list", $filter);
    }

    /**
     * mark the order as shipped
     * @param $filter
     * @return string
     * @Author Alex
     * @Date 2025/4/10 15:44
     */
    public function shipments($filter) {
        return $this->httpFetch("/shipments/list", $filter);
    }


}