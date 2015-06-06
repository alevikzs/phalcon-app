<?php

namespace Rise;

use \Phalcon\CLI\Task as BaseTask,
    \Phalcon\Db\Adapter;

/**
 * Class Task
 * @package Rise
 * @property-read Adapter $db_test
 */
class Task extends BaseTask {

    /**
     * @return Adapter
     */
    protected function getDb() {
        return $this->db;
    }

    /**
     * @return Adapter
     */
    protected function getDbTest() {
        return $this->db_test;
    }

}