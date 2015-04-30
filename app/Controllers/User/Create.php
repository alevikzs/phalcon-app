<?php

namespace App\Controllers\User;

use \App\Components\Controller\Base,
    \App\Models\User;

/**
 * Class Create
 * @package App\Controllers\User
 */
class Create extends Base {

    /**
     * @return \Phalcon\Http\Response
     */
    public function run() {
        (new User())
            ->save($this->getPayload());
        return $this->responseEmpty();
    }

}