<?php

namespace Pin\Charge;

use Pin\RequestInterface;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class Retrieve implements RequestInterface
{
    protected $token;

    public function __construct($token)
    {
        if (!is_string($token))
            throw new InvalidOptionsException('The first argument is expected to be of type "string"');

        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod()
    {
        return self::METHOD_GET;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return sprintf('/1/charges/%s', $this->token);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array();
    }
}