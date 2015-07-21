<?php

namespace App\Models;

use \Phalcon\Security,

    \Rise\Model,
    \Rise\Auth\Session;

/**
 * Class User
 * @package App\Models
 * @method static User findFirstById(integer $id)
 * @method static User findFirstByName(string $name)
 * @method static User findFirstByEmail(string $email)
 */
class User extends Model {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource() {
        return 'users';
    }

    public function beforeSave() {
        if ($this->isNew() || $this->hasChanged('password')) {
            $hash = (new Security())->hash($this->getPassword());
            $this->setPassword($hash);
        }
    }

    /**
     * @return string
     */
    public function createToken() {
        return (new Session())->encode([
            'id' => $this->getId()
        ]);
    }

}