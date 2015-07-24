<?php

namespace Rise;

use \Phalcon\Validation;

/**
 * Class RequestPayload
 * @package Rise
 */
abstract class RequestPayload {

    use TJsonSerialization;

    /**
     * @param Validation $validator
     * @return Validation
     */
    abstract protected function validation(Validation $validator);

    /**
     * @return array
     */
    public function validate() {
        $validator = new Validation();
        $validator = $this->validation($validator);

        return $validator->validate($this);
    }

}