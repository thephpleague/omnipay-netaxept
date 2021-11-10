<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * Netaxept Complete Purchase Request
 */
class CompleteAuthorizeRequest extends PurchaseRequest
{
    public function getData()
    {
        $data = array();
        $data['responseCode'] = $this->httpRequest->query->get('responseCode');
        $data['transactionId'] = $this->httpRequest->query->get('transactionId');
        $data['merchantId'] = $this->getMerchantId();
        $data['token'] = $this->getPassword();
        $data['operation'] = 'AUTH';

        if (empty($data['responseCode']) || empty($data['transactionId'])) {
            throw new InvalidResponseException();
        }

        return $data;
    }

    public function sendData($data)
    {
        if ('OK' !== $data['responseCode']) {
            return $this->response = new ErrorResponse($this, $data);
        }

        $url = $this->getEndpoint().'/Netaxept/Process.aspx?';
        $httpResponse = $this->httpClient->request('GET', $url.http_build_query($data));

        return $this->response = new Response($this, simplexml_load_string($httpResponse->getBody()->getContents()));
    }
}
