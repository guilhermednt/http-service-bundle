<?php

namespace Donato\HttpServiceBundle\Factory;

use Guzzle\Http\Client;
use Guzzle\Common\Collection;

class ClientFactory
{

    /**
     * @var Collection
     */
    protected $config;

    public function setConfig(array $clientConfig)
    {
        if (array_key_exists('curl', $clientConfig)) {
            $curl = $clientConfig['curl'];
            unset($clientConfig['curl']);
        }

        $this->config = new Collection($clientConfig);
        if (is_array($curl)) {
            $this->config->set(Client::CURL_OPTIONS, $curl);
        }

        return $this;
    }

    /**
     * @param type $baseUrl
     * @param type $config
     * @return \Guzzle\Http\Client
     */
    public function getGuzzleClient($baseUrl = '', $config = null)
    {
        if (!is_null($config)) {
            $this->config->merge($config);
        }

        return new Client($baseUrl, $this->config);
    }

}
