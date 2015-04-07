<?php

namespace App\Components;

use \GuzzleHttp\Client,
    \Phalcon\DiInterface,
    \Phalcon\DI;

/**
 * Class ApiTestCase
 * @package App\Components
 */
class ApiTestCase extends \PHPUnit_Framework_TestCase {

    /** @var  Client */
    private $http;

    /**
     * @var DiInterface
     */
    private $di;

    /**
     * @return Client
     */
    public function getHttp() {
        return $this->http;
    }

    /**
     * @param Client $http
     */
    public function setHttp($http) {
        $this->http = $http;
    }

    /**
     * @return DiInterface
     */
    public function getDi() {
        return $this->di;
    }

    /**
     * @param DiInterface $di
     */
    public function setDi($di) {
        $this->di = $di;
    }

    protected final function setUp() {
        $client = new Client([
            'base_url' => [
                'http://test.ph.com',
                ['version' => '1']
            ]
        ]);
        $this->setHttp($client);
    }

    /**
     * @param string $prefix
     * @return string
     */
    public function getUniqueName($prefix = '') {
        return uniqid($prefix);
    }

    /**
     * @param string $url
     * @param array $data
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface
     */
    public function post($url, array $data) {
        $body = json_encode($data);
        return $this
            ->getHttp()
            ->post($url, ['body' => $body]);
    }

    /**
     * @param string $url
     * @param array $data
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface
     */
    public function put($url, array $data) {
        $body = json_encode($data);
        return $this
            ->getHttp()
            ->put($url, ['body' => $body]);
    }

    /**
     * @param $url
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function get($url) {
        return $this->getHttp()->get($url);
    }

    /**
     * @param $url
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function delete($url) {
        return $this->getHttp()->delete($url);
    }

}