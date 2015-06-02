<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response,

    \App\Components\Response\Base\Simple as SimpleResponse;

/**
 * Class Simple
 * @package App\Components\Controller
 */
abstract class Simple extends Base {

    /**
     * @param mixed $data
     * @return Response
     */
    public function response($data = null) {
        $response = new SimpleResponse($data);

        return $this
            ->responseEmpty()
            ->setJsonContent($response);
    }

}