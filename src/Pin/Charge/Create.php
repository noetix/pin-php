<?php

namespace Pin\Charge;

use Pin\RequestInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Create implements RequestInterface
{
    protected $options;

    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'amount',
                'description',
                'email'
            ))
            ->setOptional(array(
                'currency',
                'ip_address',
                'card',
                'card_token',
                'customer_token'
            ))
            ->setAllowedTypes(array(
                'currency'       => 'string',
                'amount'         => 'numeric',
                'description'    => 'string',
                'email'          => 'string',
                'card'           => 'array',
                'card_token'     => 'string',
                'customer_token' => 'string'
            ))
            ->setAllowedValues(array(
                'currency' => array('AUD', 'USD')
            ));
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