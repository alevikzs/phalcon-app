<?php

namespace App\Bootstrap;

use \Phalcon\DI\FactoryDefault\CLI,
    \Phalcon\CLI\Console as BaseConsole,

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

    public function go() {
        $this
            ->createDependencies()
            ->handle($this->getFormattedArguments());
    }

    private function createFormattedArguments() {
        $formattedArguments = [];

        if (count($this->getRawArguments()) > 1) {
            foreach($this->getRawArguments() as $index => $argument) {
                if($index == 1) {
                    $formattedArguments['task'] = $this->createHandlerName($argument);
                } elseif($index == 2) {
                    $formattedArguments['action'] = $argument;
                } elseif($index >= 3) {
                    $formattedArguments['params'][] = $argument;
                }
            }
        } else {
            $formattedArguments['task'] = $this->createHandlerName();
        }

        $this->setFormattedArguments($formattedArguments);
    }

    /**
     * @param string $argument
     * @return string
     */
    private function createHandlerName($argument = 'main') {
        $className = ucfirst($argument);

        return '\\App\\Tasks\\' . $className;
    }

    /**
     * @return Console
     */
    private function createDependencies() {
        $dependency = new CLI();
        $dependency->set('db', function() {
            return Database::get();
        });
        $this->setDI($dependency);
        return $this;
    }

}