<?php

namespace App\Tasks;

use \App\Components\Task;

class MigrationTask extends Task {

    public function mainAction() {
        echo "\nMigration task\n";
    }

    /**
     * @param array $params
     */
    public function addAction(array $params) {
        $name = $this->createName(array_pop($params));
        $template = file_get_contents($this->getTemplatePath());
        $template = str_replace('#name#', $name, $template);
        file_put_contents($this->getMigrationDirectory() . $name . '.php', $template);
        echo "\nMigration $name was created\n";
    }

    public function upAction() {
        $files = scandir($this->getMigrationDirectory());
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {

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
    public function getTemplatePath() {
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
    private function getCompletedLog() {
        return $this->getTemporaryPhalconDirectory() . '.migrations';
    }

    /**
     * @return string
     */
    private function getTemporaryPhalconDirectory() {
        return getcwd() . DIRECTORY_SEPARATOR . '.phalcon' . DIRECTORY_SEPARATOR;
    }

}