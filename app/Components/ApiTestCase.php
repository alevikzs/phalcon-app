<?php

namespace App\Components;

use \Phalcon\DiInterface,
    \Phalcon\DI,

    \GuzzleHttp\Client,
    \GuzzleHttp\Message\ResponseInterface;

/**
 * Class ApiTestCase
 * @package App\Components
 */
abstract class ApiTestCase extends \PHPUnit_Framework_TestCase {

    /** @var  Client */
    private $http;

    /**
     * @var DiInterface
     */
    private $di;

    /**
     * @var array
     */
    private $stub;

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
        $this->setHttp(new Client([
            'base_url' => [
                'http://test.ph.com',
                ['version' => '1']
            ]
        ]));

        $this->initData();
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
     * @return ResponseInterface
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
     * @return ResponseInterface
     */
    public function put($url, array $data) {
        $body = json_encode($data);
        return $this
            ->getHttp()
            ->put($url, ['body' => $body]);
    }

    /**
     * @param $url
     * @return ResponseInterface
     */
    public function get($url) {
        return $this->getHttp()->get($url);
    }

    /**
     * @param $url
     * @return ResponseInterface
     */
    public function delete($url) {
        return $this->getHttp()->delete($url);
    }

    /**
     * @param mixed $actual
     */
    public function assertEmptyStr($actual) {
        $this->assertEquals('', $actual);
    }

    private function initData() {
        $this->clearStub();
        $this->saveStub();
    }

    abstract protected function saveStub();

    abstract protected function clearStub();

    abstract protected function createStub();

}