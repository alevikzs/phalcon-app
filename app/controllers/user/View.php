<?php

namespace App\Controllers\User;

use \App\Components\Controller;
use Phalcon\Http\Request;

class View extends Controller {

    public function run() {
        return $this->response();
    }

}