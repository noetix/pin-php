<?php

namespace Pin\Charge;

use Pin\RequestInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class Refund implements RequestInterface
{
    protected $options;
    protected $token;

    public function __construct($token, array $options = array())
    {
        // token
        if (!is_string($token)) {
            throw new InvalidOptionsException('The first argument is expected to be of type "string"');
        }

        $this->token = $token;

        // options
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array(
                'amount'
            ))
            ->setAllowedTypes(array(
                'amount' => 'numeric'
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
        return sprintf('/1/charges/%s/refunds', $this->token);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $this->options;
    }
}
