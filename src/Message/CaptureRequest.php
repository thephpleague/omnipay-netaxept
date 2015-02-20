<?php

namespace Omnipay\Netaxept\Message;

/**
 * Netaxept Capture Request
 *
 * @author Antonio Peric-Mazar <antonio@locastic.com>
 */
class CaptureRequest extends PurchaseRequest
{
    public function getData()
    {
        $data = array();
        $data['transactionAmount'] = $this->getAmountInteger();
        $data['transactionId'] = $this->getTransactionId();
        $data['merchantId'] = $this->getMerchantId();
        $data['token'] = $this->getPassword();
        $data['operation'] = 'CAPTURE';

        return $data;
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint().'/Netaxept/Process.aspx?';
        $httpResponse = $this->httpClient->get($url.http_build_query($data))->send();

        return $this->response = new Response($this, $httpResponse->xml());
    }
}
