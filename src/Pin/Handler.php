<?php

namespace Pin;

use Pin\RequestInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Buzz\Browser;
use Buzz\Client\Curl;

class Handler
{
    protected $options = array();
    protected $browser;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);
        $this->options = $resolver->resolve($options);

        $this->init();
    }

    /**
     * Set our default options.
     *
     * @param OptionsResolverInterface $resolver
     */
    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'host' => function (Options $options) {
                    if ($options->has('test') && $options['test']) {
                        return 'https://test-api.pin.net.au';
                    }

                    return 'https://api.pin.net.au';
                }
            ))
            ->setRequired(array(
                'key'
            ))
            ->setOptional(array(
                'host',
                'test',
                'timeout',
            ))
            ->setAllowedTypes(array(
                'host' => 'string',
                'key'  => 'string',
                'test' => 'bool',
                'timeout' => 'int',
            ));
    }

    /**
     * Initialise
     */
    protected function init()
    {
        $client = new Curl;
        $client->setVerifyPeer(false);
        $client->setOption(CURLOPT_USERPWD, $this->options['key'] . ':');
        if (isset($this->options['timeout'])) {
            $client->setTimeout($this->options['timeout']);
        }

        $this->browser = new Browser($client);
    }

    /**
     * Submit a request to the API.
     *
     * @param RequestInterface $request
     * @return object
     */
    public function submit(RequestInterface $request)
    {
        $response = $this->browser->submit(
            $this->options['host'] . $request->getPath(),
            $request->getData(),
            $request->getMethod());

        return json_decode($response->getContent());
    }

    /**
     * Get the transport handler, currently only Buzz.
     *
     * @return Buzz\Browser
     */
    public function getTransport()
    {
        return $this->browser;
    }
}
