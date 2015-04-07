<?php

namespace App\Tests;

use \App\Components\ApiTestCase;
use App\Models\User;

/**
 * Class UserTest
 * @package App\Tests
 */
class UserTest extends ApiTestCase {

    public function testCreate() {
        $id = User::getNextId();
        $name = 'userName' . $id;
        $data = [
            'name' => $name,
            'email' => $name . '@email.com'
        ];
        $response = $this->post('/user', $data);

        $this->assertEmpty($response->json());
        $this->assertEquals(200, $response->getStatusCode());

        /** @var User $user */
        $user = User::findFirst($id);
        $this->assertNotFalse($user);
        $this->assertEquals($data['name'], $user->getName());
        $this->assertEquals($data['email'], $user->getEmail());
    }

    public function testUpdate() {
        /** @var User $user */
        $user = User::findFirst();
        $newName = $this->getUniqueName('userName');
        $data = [
            'name' => $newName,
            'email' => $newName . '@email.com'
        ];
        $response = $this->put('/user/' . $user->getId(), $data);
        $this->assertEmpty($response->json());
        $this->assertEquals(200, $response->getStatusCode());

        /** @var User $user */
        $user = User::findFirst($user->getId());
        $this->assertNotFalse($user);
        $this->assertEquals($data['name'], $user->getName());
        $this->assertEquals($data['email'], $user->getEmail());
    }

    public function testView() {
    }

    public function testCollection() {
    }

    public function testDelete() {
    }

}