<?php

namespace App\Tasks;

use \App\Components\Task,
    \App\Components\Migration;

class MigrationTask extends Task {

    public function mainAction() {
        echo "\nMigration task\n";
    }

    /**
     * @param array $params
     */
    public function addAction(array $params) {
        $name = $this->createName(array_pop($params));
        $template = file_get_contents($this->getTemplateFile());
        $template = str_replace('#name#', $name, $template);
        file_put_contents($this->getMigrationDirectory() . $name . '.php', $template);
        echo "\nMigration $name was created\n";
    }

    public function upAction() {
        $files = scandir($this->getMigrationDirectory());
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                if (!$this->isAlreadySuccess($file)) {
                    $this->run($file);
                }
            }
        }
        echo "\nMigration up\n";
    }

    public function downAction() {
        echo "\nMigration down\n";
    }

    /**
     * @return string
     */
    public function getMigrationDirectory() {
        return getcwd() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Migrations' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getTemplateFile() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'migration.tpl';
    }

    /**
     * @param string $name
     * @return string
     */
    private function createName($name) {
        return 'M_' . time() . '_' . $name;
    }

    /**
     * @return string
     */
    private function getSuccessLogFIle() {
        return $this->getPhalconDirectory() . '.migrations';
    }

    /**
     * @return string
     */
    private function getPhalconDirectory() {
        return getcwd() . DIRECTORY_SEPARATOR . '.phalcon' . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $fileName
     * @return boolean
     */
    private function isAlreadySuccess($fileName) {
        $result = false;

        if (is_file($this->getSuccessLogFIle())) {
            $successLog = file_get_contents($this->getSuccessLogFIle());
            $clearName = $this->getClearName($fileName);
            if (strpos($successLog, $clearName) !== false) {
                $result = true;
            }
        } else {
            file_put_contents($this->getSuccessLogFIle(), '');
        }

        return $result;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function getClearName($fileName) {
        $pattern = '/^(.+)\.php$/';
        preg_match($pattern, $fileName, $matches);
        return $matches[1];
    }

    /**
     * @param string $fileName
     */
    private function run($fileName) {
        $clearName = $this->getClearName($fileName);

        $class = '\\App\\Migrations\\' . $clearName;
        /** @var Migration $instance */
        $instance = new $class();
        $instance->up();

        file_put_contents($this->getSuccessLogFIle(), "$clearName\n", FILE_APPEND);
    }

}