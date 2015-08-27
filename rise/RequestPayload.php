<?php

namespace Rise;

use \Phalcon\Validation,

    \Rise\Exception\Validation as ValidationException;

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

        $messages = [];

        foreach ($validator->validate($this) as $index => $message) {
            $messages[$index]['field'] = $message->getField();
            $messages[$index]['message'] = $message->getMessage();
            $messages[$index]['type'] = $message->getType();
        }

        return $messages;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @throws ValidationException
     */
    public function __call($name, array $arguments) {
        $field = lcfirst(substr($name, 3));

        $message = [
            'field' => $field,
            'message' => 'Unknown field',
            'type' => 'Unknown'
        ];

        throw new ValidationException([$message]);
    }

}