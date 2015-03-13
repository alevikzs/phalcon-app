<?php

namespace App\Bootstrap;

use Phalcon\DI\FactoryDefault\CLI,
    Phalcon\CLI\Console as BaseConsole,

    \App\Config\Database;

class Console extends BaseConsole {

    /**
     * @var array
     */
    private $rawArguments;

    /**
     * @var array
     */
    private $formattedArguments;

    /**
     * @return array
     */
    public function getRawArguments() {
        return $this->rawArguments;
    }

    /**
     * @param array $arguments
     * @return Console
     */
    public function setRawArguments(array $arguments) {
        $this->rawArguments = $arguments;
        return $this;
    }

    /**
     * @return array
     */
    public function getFormattedArguments() {
        return $this->formattedArguments;
    }

    /**
     * @param array $arguments
     * @return Console
     */
    public function setFormattedArguments(array $arguments) {
        $this->formattedArguments = $arguments;
        return $this;
    }

    /**
     * @param array $arguments
     */
    public function __construct (array $arguments = array()) {
        $this
            ->setRawArguments($arguments)
            ->createFormattedArguments();
    }

    protected function createFormattedArguments() {
        $formattedArguments = [];

        foreach($this->getRawArguments() as $index => $argument) {
            if($index == 1) {
                $formattedArguments['task'] = $argument;
            } elseif($index == 2) {
                $formattedArguments['action'] = $argument;
            } elseif($index >= 3) {
                $formattedArguments['params'][] = $argument;
            }
        }

        $this->setFormattedArguments($formattedArguments);
    }

    public function go() {
        $this
            ->createDependencies()
            ->handle($this->getFormattedArguments());
    }

    /**
     * @return Console
     */
    public function createDependencies() {
        $dependency = new CLI();
        $dependency->set('db', function() {
            return Database::get();
        });
        $this->setDI($dependency);
        return $this;
    }

}