<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response;

/**
 * Class Simple
 * @package App\Components\Controller
 */
abstract class Simple extends Base {

    /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []) {
        return $this
            ->responseEmpty()
            ->setJsonContent($data);
    }

}