<?php

namespace Pin\Card;

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
	        ->setAllowedTypes(array(
                'number'           => 'numeric',
                'expiry_month'     => 'numeric',
                'expiry_year'      => 'numeric',
                'cvc'              => 'numeric',
                'name'             => 'string',
                'address_line1'    => 'string',
                'address_city'     => 'string',
                'address_postcode' => 'numeric',
                'address_state'    => 'string',
                'address_country'  => 'string'
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