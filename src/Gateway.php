<?php

namespace Omnipay\Netaxept;

use Omnipay\Common\AbstractGateway;
use Omnipay\Netaxept\Message\AnnulRequest;
use Omnipay\Netaxept\Message\AuthorizeRequest;
use Omnipay\Netaxept\Message\CompleteAuthorizeRequest;
use Omnipay\Netaxept\Message\PurchaseRequest;
use Omnipay\Netaxept\Message\CompletePurchaseRequest;
use Omnipay\Netaxept\Message\CreditRequest;

/**
 * Netaxept Gateway
 *
 * @link http://www.betalingsterminal.no/Netthandel-forside/Teknisk-veiledning/Overview/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Netaxept';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'password' => '',
            'useOwnTransactionId' => false,
            'testMode' => false,
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function authorize($parameters = array())
    {
        return $this->createRequest(AuthorizeRequest::class, $parameters);
    }

    public function completeAuthorize($parameters = array())
    {
        return $this->createRequest(CompleteAuthorizeRequest::class, $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest(CaptureRequest::class, $parameters);
    }

    public function void(array $parameters = array())
    {
        return $this->createRequest(AnnulRequest::class, $parameters);
    }

    public function credit(array $parameters = array())
    {
        return $this->createRequest(CreditRequest::class, $parameters);
    }
}
