<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Tests\TestCase;

class CompleteAuthorizeRequestTest extends TestCase
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $httpRequest;

    /**
     * @var \Omnipay\Netaxept\Message\CompleteAuthorizeRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $this->httpRequest = $this->getHttpRequest();

        $this->request = new CompleteAuthorizeRequest($client, $this->httpRequest);
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidResponseException
     */
    public function testGetDataThrowsExceptionWithoutResponseCode()
    {
        $this->httpRequest->query->set('transactionId', 'TRANS-123');

        $this->request->getData();
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidResponseException
     */
    public function testGetDataThrowsExceptionWithoutTransactionId()
    {
        $this->httpRequest->query->set('responseCode', 'ABC-123');

        $this->request->getData();
    }
}
