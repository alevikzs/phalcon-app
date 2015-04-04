<?php

namespace App\Components;

use \GuzzleHttp\Client;

/**
 * Class ApiTestCase
 * @package App\Components
 */
class ApiTestCase extends \PHPUnit_Framework_TestCase {

    /** @var  Client */
    private $http;

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

    protected final function setUp() {
        $this->setHttp(new Client('http://test.ph.com'));
    }

}