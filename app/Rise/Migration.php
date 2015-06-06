<?php

namespace App\Rise;

/**
 * Class Migration
 * @package App\Rise
 */
abstract class Migration extends Task {

    /**
     * @param string $sql
     */
    protected function execute($sql) {
        $this->getDb()->execute($sql);
        $this->getDbTest()->execute($sql);
    }

    protected function begin() {
        $this->getDb()->begin();
        $this->getDbTest()->begin();
    }

    protected function commit() {
        $this->getDb()->commit();
        $this->getDbTest()->commit();
    }

    protected function rollback() {
        $this->getDb()->rollback();
        $this->getDbTest()->rollback();
    }

    public function safeUp() {
        $this->run('up');
    }

    public function safeDown() {
        $this->run('down');
    }

    /**
     * @param string $direction
     */
    private function run($direction) {
        $this->begin();
        try {
            $this->$direction();
            $this->commit();
        } catch (\Exception $error) {
            $this->rollback();
        }
    }

    abstract protected function up();

    abstract protected function down();

}