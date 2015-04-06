<?php

namespace App\Components;

use \Phalcon\Mvc\Model as BaseModel;

/**
 * Class Model
 * @package App\Components
 */
class Model extends BaseModel {

    /**
     * @return integer
     */
    public static function getNextId() {
        return self::maximum(['column' => 'id']) + 1;
    }

}