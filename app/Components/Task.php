<?php

namespace App\Components;

use \Phalcon\CLI\Task as BaseTask,
    \Phalcon\Db\Adapter;

class Task extends BaseTask {

    /**
     * @return Adapter
     */
    public function getDb() {
        return $this->db;
    }

}