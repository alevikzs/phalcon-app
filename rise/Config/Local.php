<?php

namespace Rise\Config;

use \Phalcon\Config\Adapter\Json,
    \Phalcon\Db\Adapter\Pdo,

    \Rise\Config\Local\Database,
    \Rise\Config\Local\Security;

/**
 * Class Local
 * @package Rise\Config
 */
class Local {

    use \Rise\JsonSerialization;

    /**
     * @var Security
     */
    public $security;

    /**
     * @var Database
     */
    public $database;

    /**
     * @return Security
     */
    public function getSecurity() {
        return $this->security;
    }

    /**
     * @param Security $security
     * @return $this
     */
    public function setSecurity($security) {
        $this->security = $security;
        return $this;
    }

    /**
     * @return Database
     */
    public function getDatabase() {
        return $this->database;
    }

    /**
     * @param Database $database
     * @return $this
     */
    public function setDatabase($database) {
        $this->database = $database;
        return $this;
    }

    /**
     * @var Pdo
     */
    private $liveDatabase;

    /**
     * @var Pdo
     */
    private $testDatabase;

    /**
     * @param Database $database
     * @param Security $security
     */
    public function __construct(Database $database, Security $security) {
//        $config = new Ini(self::getIni());

        $this->setDatabase($database)->setSecurity($security);
    }

    /**
     * @return $this
     */
    public function save() {
        file_put_contents(self::getPath(), json_encode($this));
        return $this;
    }

    public static function create() {
        $json = json_decode(file_get_contents(self::getPath()));
        return static::promote($json);
    }

    /**
     * @return string
     */
    private static function getPath() {
        return dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'local.json';
    }

    /**
     * @return string
     */
    public function getSalt() {
        return $this->getConfig()->get('salt');
    }

    /**
     * @return Pdo
     */
    public function getLiveDatabase() {
        if (!$this->liveDatabase) {
            $this->liveDatabase = $this->createDatabase();
        }

        return  $this->liveDatabase;
    }

    /**
     * @return Pdo
     */
    public function getTestDatabase() {
        if (!$this->testDatabase) {
            $this->testDatabase = $this->createDatabase(false);
        }

        return  $this->testDatabase;
    }

    /**
     * @param bool $isLive
     */
    private function createDatabase($isLive = true) {
        $adapter = $this->getConfig()->get('adapter');
        $dbName = $isLive ? $this->getConfig()->get('live') : $this->getConfig()->get('test');

        return new $adapter([
            'host' => $this->getConfig()->get('host'),
            'username' => $this->getConfig()->get('username'),
            'password' => $this->getConfig()->get('password'),
            'dbname' => $dbName
        ]);
    }

}