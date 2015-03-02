<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

class Create extends Controller {

    public function run() {
        $request = $this->request->getJsonRawBody();
        (new User())
            ->setName($request->name)
            ->setEmail($request->email)
            ->save();
        return $this->response();
    }

}