<?php
/**
 * @author Alex Lai
 * @email alex@laialex.com
 * @website https://laialex.com
 * @Date 2025/4/14 11:38
 */

namespace Alaikis\Dimebia\endpoint;

class PaymentEndpoint
{

    private $BASE_ENDPOINT = "transaction";
    /**
     * make a order
     * @param $requestParams
     * @return array
     * @Author Alex
     * @Date 2025/3/25 10:33
     */
    public function paymentApply($requestParams) {
        return $this->httpFetch($this->BASE_ENDPOINT . "/payments/apply", $requestParams);
    }

    /**
     * get the payment info by bill id
     * @param $billId
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function getPaymentById($billId) {
        $result = $this->httpFetch($this->BASE_ENDPOINT . "/payments/list", ["id"=>$billId]);
        if ($result["code"] == 0) {
            $result["data"] = $result["data"][0];
        }
        return $result;
    }

    /**
     * get the payment list
     * @param $filter
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function getPayments($filter) {
        return $this->httpFetch($this->BASE_ENDPOINT . "/payments/list", $filter);
    }

    /**
     * cancel the payment
     * @param $billId
     * @return array
     * @Author Alex
     * @Date 2025/4/10 15:43
     */
    public function paymentCancel($billId) {
        return $this->httpFetch($this->BASE_ENDPOINT . "/payments/cancel", ["transactionId"=>$billId]);
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
        return $this->httpFetch($this->BASE_ENDPOINT . "/payments/refund", [
            "transactionId"=>$billId,
            "refundAmount"=>$refundAmount,
        ]);
    }
}