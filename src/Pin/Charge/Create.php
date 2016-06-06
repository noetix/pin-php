<?php

namespace Pin\Charge;

use Pin\RequestInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Create implements RequestInterface
{
    protected $options;

    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(array(
                'amount',
                'description',
                'email'
            ))
            ->setDefined(array(
                'currency',
                'ip_address',
                'card',
                'card_token',
                'customer_token',
                'capture'
            ))
            ->setAllowedTypes('currency', 'string')
            ->setAllowedTypes('amount', 'numeric')
            ->setAllowedTypes('description', 'string')
            ->setAllowedTypes('email', 'string')
            ->setAllowedTypes('card', 'array')
            ->setAllowedTypes('card_token', 'string')
            ->setAllowedTypes('customer_token', 'string')
            ->setAllowedTypes('capture', 'string')
            ->setAllowedValues('currency', array('AUD', 'USD', 'NZD', 'SGD', 'EUR', 'GBP', 'CAD', 'HKD', 'JPY'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod()
    {
        return self::METHOD_POST;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return '/1/charges';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->options;
    }
}
