<?php

namespace App\Controllers\User;

use \App\Components\Controller\Base,
    \App\Models\User;

/**
 * Class Update
 * @package App\Controllers\User
 * @method int getId()
 */
class Update extends Base {

    /**
     * @return \Phalcon\Http\Response
     */
    public function run() {
        User::findFirst($this->getId())
            ->save($this->getPayload());
        return $this->responseEmpty();
    }

}