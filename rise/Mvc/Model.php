<?php

namespace Rise\Mvc;

use \Phalcon\Mvc\Model as BaseModel;

/**
 * Class Model
 * @package Rise\Mvc
 */
class Model extends BaseModel {

    /**
     * @return integer
     */
    public static function getNextId() {
        return self::maximum(['column' => 'id']) + 1;
    }

}