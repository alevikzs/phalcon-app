<?php

namespace Rise;

use \Phalcon\Mvc\Model as BaseModel;

/**
 * Class Model
 * @package Rise
 * @property integer $id
 */
class Model extends BaseModel {

    /**
     * @return integer
     */
    public static function getNextId() {
        return self::maximum(['column' => 'id']) + 1;
    }

    /**
     * @return $this
     */
    public function truncate() {
        $this
            ->getWriteConnection()
            ->query('TRUNCATE TABLE ' . $this->getSource() . ' RESTART IDENTITY')
            ->execute();

        return $this;
    }

    public function initialize() {
        $this->keepSnapshots(true);
    }

    /**
     * @return bool
     */
    public function isNew() {
        return is_null($this->id);
    }

}