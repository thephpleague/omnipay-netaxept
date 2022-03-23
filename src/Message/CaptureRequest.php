<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Common\Exception\InvalidResponseException;

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
        $data['transactionId'] = $this->getTransactionReference();
        $data['merchantId'] = $this->getMerchantId();
        $data['token'] = $this->getPassword();
        $data['operation'] = 'CAPTURE';

        if (empty($data['transactionAmount']) || empty($data['transactionId'])) {
            throw new InvalidResponseException();
        }

        return $data;
    }

    public function sendData($data)
    {
        $url = $this->getEndpoint().'/Netaxept/Process.aspx?';
        $httpResponse = $this->httpClient->request('GET', $url.http_build_query($data));

        return $this->response = new Response($this, simplexml_load_string($httpResponse->getBody()->getContents()));
    }
}
