<?php

namespace Rise\Controllers;

use \Rise\Controller,
    \Rise\Exception\User as UserException;

/**
 * Class Missing
 * @package Rise\Controllers
 */
class MissingController extends Controller {

    /**
     * @throws UserException
     */
    public function runAction() {
        throw new UserException('Not Found', 404);
    }

}