<?php
namespace App\Helper;

use Zend\Session\Container;
use Zend\View\Helper\AbstractHelper;

class LoginHelper extends AbstractHelper
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->container['emailAddress'] = $emailAddress;
    }

    /**
     * @return string|null
     */
    public function getEmailAddress()
    {
        return $this->container['emailAddress'];
    }

    /**
     * @return string
     */
    public function __invoke()
    {
        return $this->getEmailAddress();
    }
}
