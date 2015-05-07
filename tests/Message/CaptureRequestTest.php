<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $httpRequest;

    /**
     * @var \Omnipay\Netaxept\Message\CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $this->httpRequest = $this->getHttpRequest();

        $this->request = new CaptureRequest($client, $this->httpRequest);
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidResponseException
     */
    public function testGetDataThrowsExceptionWithoutTransactionAmount()
    {
        $this->httpRequest->query->set('transactionId', 'TRANS-123');

        $this->request->getData();
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidResponseException
     */
    public function testGetDataThrowsExceptionWithoutTransactionId()
    {
        $this->httpRequest->query->set('transactionAmount', 'ABC-123');

        $this->request->getData();
    }
}
