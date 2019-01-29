<?php

namespace Omnipay\Netaxept\Message;

use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertEquals('f3d94dd5c0f743a788fc943402757c58', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame("Missing parameter: 'Order Number'", $response->getMessage());
    }

    public function testCompletePurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('CompletePurchaseSuccess.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('8a88d40cab5b47fab25e24d6228180a7', $response->getTransactionReference());
        $this->assertSame('OK', $response->getMessage());
    }

    public function testCompletePurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('CompletePurchaseFailure.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('Unable to find transaction', $response->getMessage());
    }

    public function testCaptureSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('CaptureSuccess.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('cc497f37603678c61a09fd5645959812', $response->getTransactionReference());
        $this->assertSame('OK', $response->getMessage());
    }

    public function testCaptureFailure()
    {
        $httpResponse = $this->getMockHttpResponse('CaptureFailure.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('Unable to find transaction', $response->getMessage());
    }

    public function testAnnulSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('AnnulSuccess.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('3fece3574598c6ae3932fae5f38bc8af', $response->getTransactionReference());
        $this->assertSame('OK', $response->getMessage());
    }

    public function testAnnullFailure()
    {
        $httpResponse = $this->getMockHttpResponse('AnnulFailure.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('Unable to find transaction', $response->getMessage());
    }

    public function testCreditSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('CreditSuccess.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEquals('3fece3574598c6ae3932fae5f38bc8af', $response->getTransactionReference());
        $this->assertSame('OK', $response->getMessage());
    }

    public function testCreditFailure()
    {
        $httpResponse = $this->getMockHttpResponse('CreditFailure.txt');
        $xml = simplexml_load_string($httpResponse->getBody()->getContents());
        $response = new Response($this->getMockRequest(), $xml);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('Unable to find transaction', $response->getMessage());
    }
}
