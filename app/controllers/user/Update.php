<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

class Update extends Controller {

    public function run() {
        $request = $this->request->getJsonRawBody();
        $params = $this->router->getParams();
        /** @var User $user */
        $user = User::findFirst(['id' => $params['id']]);
        $user
            ->setName($request->name)
            ->setEmail($request->email)
            ->save();
        return $this->response();
    }

}