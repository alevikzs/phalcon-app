<?php

namespace Rise;

use \Phalcon\CLI\Task as BaseTask,
    \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Console;

/**
 * Class Task
 * @package Rise
 * @property Console $application
 */
class Task extends BaseTask {

    /**
     * @return Pdo
     */
    protected function getDb() {
        return $this->db;
    }

    /**
     * @return Console
     */
    protected function getApplication() {
        return $this->application;
    }

}