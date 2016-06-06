<?php

namespace Pin\Card;

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
                'number',
                'expiry_month',
                'expiry_year',
                'cvc',
                'name',
                'address_line1',
                'address_city',
                'address_postcode',
                'address_state',
                'address_country'
            ))
            ->setAllowedTypes('number', 'numeric')
            ->setAllowedTypes('expiry_month', 'numeric')
            ->setAllowedTypes('expiry_year', 'numeric')
            ->setAllowedTypes('cvc', 'numeric')
            ->setAllowedTypes('name', 'string')
            ->setAllowedTypes('address_line1', 'string')
            ->setAllowedTypes('address_city', 'string')
            ->setAllowedTypes('address_postcode', 'numeric')
            ->setAllowedTypes('address_state', 'string')
            ->setAllowedTypes('address_country', 'string')
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
        return '/1/cards';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->options;
    }
}
