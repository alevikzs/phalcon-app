<?php

namespace Rise\Controllers;

use \Rise\Controller,
    \Rise\Exception\User as UserException;

/**
 * Class NotFoundController
 * @package Rise\Controllers
 */
class NotFoundController extends Controller {

    /**
     * @throws UserException
     */
    public function runAction() {
        throw new UserException('Not Found', 404);
    }

}