<?php

namespace Pin\Customer;

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
                'email'
            ))
            ->setOptional(array(
                'ip_address',
                'card',
                'card_token'
            ))
            ->setAllowedTypes(array(
                'email'          => 'string',
                'card'           => 'array',
                'card_token'     => 'string'
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
        return '/1/customers';
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->options;
    }
}