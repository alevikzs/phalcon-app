<?php

namespace Rise\Config\Local;

/**
 * Class Database
 * @package Rise\Config\Local
 */
class Database {

    /**
     * @var string
     */
    public $adapter;

    /**
     * @var string
     */
    public $host;

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $live;

    /**
     * @var string
     */
    public $test;

    /**
     * @return string
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * @param string $adapter
     * @return $this
     */
    public function setAdapter($adapter) {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost($host) {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param string $user
     * @return $this
     */
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getLive() {
        return $this->live;
    }

    /**
     * @param string $live
     * @return $this
     */
    public function setLive($live) {
        $this->live = $live;
        return $this;
    }

    /**
     * @return string
     */
    public function getTest() {
        return $this->test;
    }

    /**
     * @param string $test
     * @return $this
     */
    public function setTest($test) {
        $this->test = $test;
        return $this;
    }

    /**
     * @param string $user
     * @param string $live
     * @param string $test
     * @param string $password
     * @param string $adapter
     * @param string $host
     */
    public function __construct($user, $live, $test, $password = '', $adapter = 'Postgresql', $host = 'localhost') {
        $this
            ->setUser($user)
            ->setLive($live)
            ->setTest($test)
            ->setPassword($password)
            ->setAdapter($adapter)
            ->setHost($host);
    }

}