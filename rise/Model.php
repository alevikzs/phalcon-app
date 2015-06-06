<?php

namespace Rise;

use \Phalcon\Mvc\Model as BaseModel;

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

}