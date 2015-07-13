<?php

namespace Rise\Config;

use \Rise\Config\Local\Database,
    \Rise\Config\Local\Security,
    \Rise\TJsonSerialization;

/**
 * Class Local
 * @package Rise\Config
 */
class Local {

    use TJsonSerialization;

    /**
     * @var Security
     */
    public $security;

    /**
     * @var Database
     */
    public $database;

    /**
     * @var $this
     */
    private static $instance;

    /**
     * @return Security
     */
    public function getSecurity() {
        return $this->security;
    }

    /**
     * @param \Rise\Config\Local\Security $security
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
     * @param \Rise\Config\Local\Database $database
     * @return $this
     */
    public function setDatabase($database) {
        $this->database = $database;
        return $this;
    }

    /**
     * @param Database $database
     * @param Security $security
     */
    public function __construct(Database $database = null, Security $security = null) {
        $this->setDatabase($database)->setSecurity($security);
    }

    /**
     * @return $this
     */
    public function save() {
        file_put_contents(self::getPath(), json_encode($this));
        return $this;
    }

    /**
     * @return $this
     */
    public static function get() {
        if (is_null(self::$instance)) {
            $json = json_decode(file_get_contents(self::getPath()));
            self::$instance = static::promote($json);
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    private static function getPath() {
        return dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'local.json';
    }

}