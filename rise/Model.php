<?php

namespace Rise;

use \Phalcon\Mvc\Model as BaseModel,
    \Phalcon\Mvc\Model\Query;

/**
 * Class Model
 * @package Rise
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

}