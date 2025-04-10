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
    private mixed $password;
    private $CONTENT_TYPE;

    public function __construct($user, $password, $baseUrl=null, $version=null)
    {
        $this->token = null;
        $this->password = $password;
        $this->token = $this->getUserToken();
        if($baseUrl) $this->setBaseUrl($baseUrl);
        if($version) $this->setVersion($version);
    }

    private function getUserToken(){
        return "";
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
     * @return array
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    private function httpFetch($uri,$data, $method = "post"): array
    {
        $ch = curl_init();
        $api = $this->baseUrl . "/" . $this->version . "/". $uri;
        //指定URL
        curl_setopt($ch, CURLOPT_URL, $api);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (strtolower($method) == 'post') {
            //声明使用POST方式来进行发送
            curl_setopt($ch, CURLOPT_POST, 1);
            //发送什么数据呢
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
        }
        $headers    = [];
        if (!empty($this->token)) {
            $headers[]  = "token: {$this->token}";
        }

        if ($this->CONTENT_TYPE != '') {
            $headers[] = "Content-Type: {$this->CONTENT_TYPE}";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 900);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return (array) json_decode($output, true);
    }

    /**
     * make a order
     * @param $requestParams
     * @return array
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    public function paymentApply($requestParams) {
        return $this->httpFetch("/payments/apply", $requestParams);
    }

    /**
     * get the payment info by bill id
     * @param $billId
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function getPaymentById($billId) {
        return $this->httpFetch("/payments/get", ["transactionId"=>$billId]);
    }

    /**
     * get the payment list
     * @param $filter
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function getPayments($filter) {
        return $this->httpFetch("/payments/list", $filter);
    }

    /**
     * cancel the payment
     * @param $billId
     * @return array
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
     * @return array
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
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function balances($filter) {
        return $this->httpFetch("/balances/list", $filter);
    }

    /**
     * mark the order as shipped
     * @param $filter
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:44
     */
    public function shipments($filter) {
        return $this->httpFetch("/shipments/list", $filter);
    }


}