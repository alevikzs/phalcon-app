<?php

namespace App\Models;

use \Phalcon\Mvc\Model;

class User extends Model {

    /**
     * @var string
     */
    public $name;

    /**
     * @return string
     */
    public function getSource() {
        return 'users';
    }

} 