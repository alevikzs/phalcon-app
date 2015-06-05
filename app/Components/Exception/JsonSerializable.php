<?php

namespace App\Components\Exception;

use \Exception;

/**
 * Trait JsonSerializable
 * @package App\Components\Exception
 */
trait JsonSerializable {

    /**
     * @return array
     */
    public function jsonSerialize() {
        /** @var $this Exception */
        $vars = get_object_vars($this);

        $vars['trace'] = $this->getTraceAsString();
        $vars['previous'] = $this->getPrevious();
        unset($vars['xdebug_message']);

        return $vars;
    }

}